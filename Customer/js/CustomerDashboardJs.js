const PRODUCT_API_URL = 'https://localhost:7048/api/Product';
const CATEGORY_API_URL = 'https://localhost:7048/api/Category';
const ORDER_API_URL = 'https://localhost:7048/api/Order';

let cart = [];
let allProducts = [];
let allCategories = [];
let currentUserId = null;

// Load on page load
document.addEventListener('DOMContentLoaded', function() {
    // Get userId from sessionStorage
    currentUserId = sessionStorage.getItem("userId");
    const fullName = sessionStorage.getItem("fullName");
    const role = sessionStorage.getItem("role");
    
    // Security check
    if (!currentUserId || role !== "Customer") {
        alert("Session expired or access unauthorized. Please log in.");
        window.location.href = "../login.html";
        return;
    }

    loadCategories();
    loadProducts();
});

// Load all categories
async function loadCategories() {
    try {
        const response = await fetch(CATEGORY_API_URL);
        if (response.ok) {
            allCategories = await response.json();
            populateCategoryFilters();
        }
    } catch (error) {
        console.error('Error loading categories:', error);
    }
}

// Populate category dropdown
function populateCategoryFilters() {
    const categoryFilter = document.getElementById('categoryFilter');
    categoryFilter.innerHTML = '<option value="">All Categories</option>';
    
    allCategories.forEach(category => {
        const option = document.createElement('option');
        option.value = category.categoryID || category.CategoryID;
        option.textContent = category.categoryName || category.CategoryName;
        categoryFilter.appendChild(option);
    });
}

// Load all products from API
async function loadProducts() {
    try {
        document.getElementById('loadingSpinner').style.display = 'block';
        document.getElementById('productGrid').innerHTML = '';
        document.getElementById('noResults').style.display = 'none';

        const response = await fetch(PRODUCT_API_URL);
        
        if (!response.ok) {
            throw new Error('Failed to fetch products');
        }

        allProducts = await response.json();
        displayProducts(allProducts);
        
    } catch (error) {
        console.error('Error loading products:', error);
        document.getElementById('loadingSpinner').innerHTML = 
            '<i class="fas fa-exclamation-triangle" style="color: #dc3545;"></i><p style="color: #dc3545;">Failed to load products. Please check your API connection.</p>';
    } finally {
        document.getElementById('loadingSpinner').style.display = 'none';
    }
}

// Get category name from CategoryID
function getCategoryName(categoryID) {
    const category = allCategories.find(cat => 
        (cat.categoryID || cat.CategoryID) === categoryID
    );
    return category ? (category.categoryName || category.CategoryName) : 'Uncategorized';
}

// Display products in gallery view
function displayProducts(products) {
    const galleryGrid = document.getElementById('productGrid');
    galleryGrid.innerHTML = '';

    if (!products || products.length === 0) {
        document.getElementById('noResults').style.display = 'block';
        return;
    }

    document.getElementById('noResults').style.display = 'none';

    products.forEach(product => {
        const card = document.createElement('div');
        card.className = 'product-card';
        
        // Handle image
        const imageBase64 = product.imageBase64 || product.ImageBase64;
        let imageHTML;
        if (imageBase64) {
            const imageSource = imageBase64.startsWith('data:') 
                ? imageBase64 
                : `data:image/jpeg;base64,${imageBase64}`;
            imageHTML = `<img src="${imageSource}" alt="${product.productName || product.ProductName}">`;
        } else {
            imageHTML = '<i class="fas fa-image"></i>';
        }

        // Handle properties
        const productId = product.productID || product.ProductID;
        const productName = product.productName || product.ProductName || 'Unnamed Product';
        const productCode = product.productCode || product.ProductCode || 'N/A';
        const description = product.description || product.Description || 'No description available';
        const categoryID = product.categoryID || product.CategoryID;
        const categoryName = product.category?.categoryName || 
                           product.Category?.CategoryName || 
                           getCategoryName(categoryID);

        // Format date
        const createdAt = product.createdAt || product.CreatedAt;
        const createdDate = createdAt ? new Date(createdAt).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        }) : '';

        // Escape strings for onclick
        const safeName = productName.replace(/'/g, "\\'").replace(/"/g, '&quot;');
        const safeCode = productCode.replace(/'/g, "\\'").replace(/"/g, '&quot;');
        const safeImage = (imageBase64 || '').replace(/'/g, "\\'").replace(/"/g, '&quot;');
        
        card.innerHTML = `
            <div class="product-image">${imageHTML}</div>
            <div class="product-info">
                <span class="product-category">${categoryName}</span>
                <div class="product-name">${productName}</div>
                <div class="product-code">Code: ${productCode}</div>
                <div class="product-description">${description}</div>
                ${createdDate ? `<div class="product-date">Added: ${createdDate}</div>` : ''}
                <button class="add-to-cart-btn" onclick="addToCart(${productId}, '${safeName}', '${safeCode}', '${safeImage}')">
                    <i class="fas fa-cart-plus"></i> Add to Cart
                </button>
            </div>
        `;
        
        galleryGrid.appendChild(card);
    });
}

// Search products
function searchProducts() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const categoryFilterValue = document.getElementById('categoryFilter').value;
    
    const filteredProducts = allProducts.filter(product => {
        const productName = product.productName || product.ProductName || '';
        const productCode = product.productCode || product.ProductCode || '';
        const categoryID = product.categoryID || product.CategoryID;
        
        const matchesSearch = productName.toLowerCase().includes(searchTerm) ||
                            productCode.toLowerCase().includes(searchTerm);
        
        const matchesCategory = !categoryFilterValue || categoryID === parseInt(categoryFilterValue);
        
        return matchesSearch && matchesCategory;
    });
    
    displayProducts(filteredProducts);
}

// Add item to cart
function addToCart(id, name, code, image) {
    const existingItem = cart.find(item => item.id === id);
    
    if (existingItem) {
        existingItem.quantity++;
    } else {
        cart.push({
            id: id,
            name: name,
            code: code,
            image: image,
            quantity: 1
        });
    }
    
    updateCart();
    showNotification('Item added to cart!');
}

// Update cart display
function updateCart() {
    const cartItemsContainer = document.getElementById('cartItems');
    const cartBadge = document.getElementById('cartBadge');
    const totalItems = document.getElementById('totalItems');
    
    const totalCount = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartBadge.textContent = totalCount;
    totalItems.textContent = totalCount;
    
    if (cart.length === 0) {
        cartItemsContainer.innerHTML = `
            <div class="cart-empty">
                <i class="fas fa-shopping-basket"></i>
                <p>Your cart is empty</p>
            </div>
        `;
        return;
    }
    
    cartItemsContainer.innerHTML = cart.map(item => {
        const imageHTML = item.image 
            ? `<img src="data:image/jpeg;base64,${item.image}" alt="${item.name}">`
            : '<i class="fas fa-image"></i>';
        
        return `
            <div class="cart-item">
                <div class="cart-item-image">${imageHTML}</div>
                <div class="cart-item-details">
                    <div class="cart-item-name">${item.name}</div>
                    <div class="cart-item-code">${item.code}</div>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="updateQuantity(${item.id}, -1)">
                            <i class="fas fa-minus"></i>
                        </button>
                        <span class="quantity">${item.quantity}</span>
                        <button class="quantity-btn" onclick="updateQuantity(${item.id}, 1)">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="remove-item" onclick="removeFromCart(${item.id})">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
            </div>
        `;
    }).join('');
}

// Update item quantity
function updateQuantity(id, change) {
    const item = cart.find(item => item.id === id);
    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
            removeFromCart(id);
        } else {
            updateCart();
        }
    }
}

// Remove item from cart
function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id);
    updateCart();
}

// Toggle cart sidebar
function toggleCart() {
    const sidebar = document.getElementById('cartSidebar');
    const overlay = document.getElementById('cartOverlay');
    sidebar.classList.toggle('active');
    overlay.classList.toggle('active');
}

// Checkout function - Creates orders in database
async function checkout() {
    if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
    }

    if (!currentUserId) {
        alert('User session not found. Please log in again.');
        window.location.href = "../login.html";
        return;
    }

    const checkoutBtn = document.querySelector('.checkout-btn');
    checkoutBtn.disabled = true;
    checkoutBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';

    let successCount = 0;
    let failCount = 0;
    const errors = [];

    // Create an order for each item in cart
    for (const item of cart) {
        try {
            const orderData = {
                UserId: parseInt(currentUserId),
                ProductId: item.id,
                Quantity: item.quantity
            };

            console.log('Creating order:', orderData);

            const response = await fetch(ORDER_API_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(orderData)
            });

            if (response.ok) {
                const result = await response.json();
                console.log('Order created:', result);
                successCount++;
            } else {
                const errorData = await response.json();
                console.error('Order failed:', errorData);
                failCount++;
                errors.push(`${item.name}: ${errorData.message || 'Failed to create order'}`);
            }
        } catch (error) {
            console.error('Error creating order for item:', item.name, error);
            failCount++;
            errors.push(`${item.name}: ${error.message}`);
        }
    }

    // Re-enable checkout button
    checkoutBtn.disabled = false;
    checkoutBtn.innerHTML = '<i class="fas fa-credit-card"></i> Proceed to Checkout';

    // Show results
    if (successCount > 0 && failCount === 0) {
        showNotification(`✓ Successfully placed ${successCount} order(s)!`);
        // Clear cart after successful checkout
        cart = [];
        updateCart();
        toggleCart();
        
        // Show success message with more details
        setTimeout(() => {
            alert(`Order placed successfully!\n\nTotal orders: ${successCount}\n\nYour orders are being processed. Thank you for shopping with GadgetHub!`);
        }, 500);
    } else if (successCount > 0 && failCount > 0) {
        alert(`Partial Success:\n\n✓ ${successCount} order(s) placed successfully\n✗ ${failCount} order(s) failed\n\nFailed items:\n${errors.join('\n')}`);
        // Remove successful items from cart
        cart = cart.filter(item => 
            errors.some(err => err.startsWith(item.name))
        );
        updateCart();
    } else {
        alert(`Checkout Failed:\n\nAll ${failCount} order(s) failed to process.\n\nErrors:\n${errors.join('\n')}\n\nPlease try again or contact support.`);
    }
}

// Show notification
function showNotification(message) {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 90px;
        right: 20px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 15px 25px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        z-index: 3000;
        animation: slideIn 0.3s ease;
    `;
    notification.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 2000);
}

// Close modal when clicking outside cart
window.onclick = function(event) {
    const sidebar = document.getElementById('cartSidebar');
    const overlay = document.getElementById('cartOverlay');
    if (event.target === overlay) {
        toggleCart();
    }
}