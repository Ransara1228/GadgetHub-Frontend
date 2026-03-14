const ORDER_API_URL = 'https://localhost:7048/api/Order';
const PRODUCT_API_URL = 'https://localhost:7048/api/Product';
const CUSTOMER_API_URL = 'https://localhost:7048/api/User';
const QUOTATION_API_URL = 'https://localhost:7048/api/Quotation';

let allOrders = [];
let allProducts = {};
let allCustomers = {};
let allQuotations = []; // Cache all quotations
let currentOrderData = null;
let currentDistributorId = null;

document.addEventListener('DOMContentLoaded', function() {
    currentDistributorId = sessionStorage.getItem("distributorId");
    
    if (!currentDistributorId) {
        alert('Session expired. Please login again.');
        window.location.href = 'login.php';
        return;
    }

    loadAllData();
});

async function loadQuotations() {
    try {
        const response = await fetch(QUOTATION_API_URL);
        if (!response.ok) throw new Error('Failed to fetch quotations');
        allQuotations = await response.json();
    } catch (error) {
        console.error('Error loading quotations:', error);
        allQuotations = [];
    }
}

function getDistributorQuotations() {
    return allQuotations.filter(
        q => q.distributorID === parseInt(currentDistributorId)
    );
}

function hasDistributorQuotedOrder(orderId) {
    return allQuotations.some(
        q => q.orderID === orderId && q.distributorID === parseInt(currentDistributorId)
    );
}

async function loadAllData() {
    try {
        document.getElementById('loadingSpinner').style.display = 'block';
        document.getElementById('ordersContainer').style.display = 'none';
        document.getElementById('noResults').style.display = 'none';
        document.getElementById('orderCount').style.display = 'none';

        await Promise.all([
            loadOrders(),
            loadProducts(),
            loadCustomers(),
            loadQuotations()
        ]);

        displayOrders(allOrders);

    } catch (error) {
        console.error('Error loading data:', error);
        alert('Failed to load data. Please check your API connections.');
    } finally {
        document.getElementById('loadingSpinner').style.display = 'none';
    }
}

async function loadOrders() {
    try {
        const response = await fetch(ORDER_API_URL);
        if (!response.ok) throw new Error('Failed to fetch orders');
        allOrders = await response.json();
    } catch (error) {
        console.error('Error loading orders:', error);
        throw error;
    }
}

async function loadProducts() {
    try {
        const response = await fetch(PRODUCT_API_URL);
        if (!response.ok) throw new Error('Failed to fetch products');
        const products = await response.json();
        products.forEach(p => {
            allProducts[p.productID] = p;
        });
    } catch (error) {
        console.error('Error loading products:', error);
    }
}

async function loadCustomers() {
    try {
        const response = await fetch(CUSTOMER_API_URL);
        if (!response.ok) throw new Error('Failed to fetch customers');
        const customers = await response.json();
        customers.forEach(c => {
            allCustomers[c.customerID] = c;
        });
    } catch (error) {
        console.error('Error loading customers:', error);
    }
}

function getStatusInfo(status) {
    switch(status) {
        case 0:
            return { text: 'Pending', class: 'status-pending' };
        case 1:
            return { text: 'Completed', class: 'status-completed' };
        case 2:
            return { text: 'Cancelled', class: 'status-cancelled' };
        case 3:
            return { text: 'Quotation Sent', class: 'status-send' };
        default:
            return { text: 'Unknown', class: 'status-pending' };
    }
}

function displayOrders(orders) {
    const container = document.getElementById('ordersContainer');
    const countDiv = document.getElementById('orderCount');
    const noResults = document.getElementById('noResults');

    container.innerHTML = '';

    if (orders.length === 0) {
        container.style.display = 'none';
        countDiv.style.display = 'none';
        noResults.style.display = 'block';
        return;
    }

    container.style.display = 'grid';
    countDiv.style.display = 'block';
    noResults.style.display = 'none';

    countDiv.textContent = `Showing ${orders.length} Order${orders.length !== 1 ? 's' : ''}`;

    orders.forEach(order => {
        const product = allProducts[order.productId] || {};
        const customer = allCustomers[order.customerID] || {};
        const statusInfo = getStatusInfo(order.status);
        const createdDate = new Date(order.createdAt).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });

        let productImageHtml = '';
        if (product.imageBase64) {
            productImageHtml = `<div class="product-image"><img src="data:image/png;base64,${product.imageBase64}" alt="Product"></div>`;
        } else {
            productImageHtml = `<div class="product-image no-image">📦</div>`;
        }

        const card = document.createElement('div');
        card.className = 'order-card';
        card.innerHTML = `
            ${productImageHtml}
            <div class="card-content">
                <div class="order-header">
                    <span class="order-code">${order.orderCode}</span>
                    <span class="status-badge ${statusInfo.class}">${statusInfo.text}</span>
                </div>

                <div class="product-name">${product.productName || 'N/A'}</div>
                <div class="customer-name">Customer: <strong>${customer.fullName || 'N/A'}</strong></div>

                <div class="order-details">
                    <div class="detail-row">
                        <span class="detail-label">Quantity:</span>
                        <span class="detail-value">${order.quantity}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Unit Price:</span>
                        <span class="detail-value">$${order.unitPrice.toFixed(2)}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Total Price:</span>
                        <span class="detail-value">$${order.totalPrice.toFixed(2)}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Order ID:</span>
                        <span class="detail-value">#${order.orderID}</span>
                    </div>
                </div>

                <div class="created-at">${createdDate}</div>

                <div class="action-buttons">
                    <button class="btn-action btn-quotation" onclick="openQuotationModal(${order.orderID}, '${order.orderCode}')" ${order.status !== 0 ? 'disabled' : ''}>📧 Quotation</button>
                </div>
            </div>
        `;

        container.appendChild(card);
    });
}

async function openQuotationModal(orderId, orderCode) {
    // CHECK BEFORE OPENING MODAL - Reload quotations first
    await loadQuotations();
    
    if (hasDistributorQuotedOrder(orderId)) {
        alert('You have already submitted a quotation for this order!');
        await loadAllData(); // Refresh the display
        return;
    }

    const order = allOrders.find(o => o.orderID === orderId);
    if (!order) {
        alert('Order not found');
        return;
    }

    const product = allProducts[order.productId] || {};
    const customer = allCustomers[order.customerID] || {};

    currentOrderData = order;

    document.getElementById('modalOrderCode').value = orderCode;
    document.getElementById('modalProduct').value = product.productName || 'N/A';
    document.getElementById('modalCustomer').value = customer.fullName || 'N/A';
    document.getElementById('modalQuantity').value = order.quantity;
    document.getElementById('modalUnitPrice').value = order.unitPrice.toFixed(2);
    document.getElementById('modalQuotedPrice').value = '';
    document.getElementById('priceCalculation').style.display = 'none';

    document.getElementById('quotationModal').style.display = 'block';
}

function closeQuotationModal() {
    document.getElementById('quotationModal').style.display = 'none';
    currentOrderData = null;
}

function calculateTotal() {
    const quotedPrice = parseFloat(document.getElementById('modalQuotedPrice').value);
    const quantity = parseInt(document.getElementById('modalQuantity').value);

    if (!isNaN(quotedPrice) && quotedPrice > 0 && !isNaN(quantity)) {
        const total = quotedPrice * quantity;
        
        document.getElementById('calcUnitPrice').textContent = `$${quotedPrice.toFixed(2)}`;
        document.getElementById('calcQuantity').textContent = quantity;
        document.getElementById('calcTotal').textContent = `$${total.toFixed(2)}`;
        document.getElementById('priceCalculation').style.display = 'block';
    } else {
        document.getElementById('priceCalculation').style.display = 'none';
    }
}

async function submitQuotation() {
    const quotedPrice = document.getElementById('modalQuotedPrice').value;

    if (!quotedPrice) {
        alert('Please enter a quoted price per item');
        return;
    }

    if (isNaN(quotedPrice) || quotedPrice <= 0) {
        alert('Please enter a valid quoted price');
        return;
    }

    try {
        // CRITICAL: Reload quotations from server before submitting
        await loadQuotations();
        
        // Double-check if quotation already exists
        if (hasDistributorQuotedOrder(currentOrderData.orderID)) {
            alert('You have already submitted a quotation for this order!');
            closeQuotationModal();
            await loadAllData();
            return;
        }

        // Submit the quotation
        const quotationResponse = await fetch(`${QUOTATION_API_URL}/add`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                orderID: currentOrderData.orderID,
                distributorID: parseInt(currentDistributorId),
                quotedPrice: parseFloat(quotedPrice)
            })
        });

        if (quotationResponse.ok) {
            alert('Quotation sent successfully! This order will now be hidden from your list.');
            closeQuotationModal();
            await loadAllData();
        } else {
            const errorData = await quotationResponse.json();
            alert(`Failed to send quotation: ${errorData.message || 'Unknown error'}`);
        }
    } catch (error) {
        console.error('Error submitting quotation:', error);
        alert('An error occurred while sending the quotation.');
    }
}

window.onclick = function(event) {
    const modal = document.getElementById('quotationModal');
    if (event.target == modal) {
        closeQuotationModal();
    }
}