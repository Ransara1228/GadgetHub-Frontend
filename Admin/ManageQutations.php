<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quotation Management System</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --primary: #2563eb;
      --primary-dark: #1e40af;
      --secondary: #10b981;
      --secondary-dark: #059669;
      --danger: #ef4444;
      --warning: #f59e0b;
      --gray-50: #f9fafb;
      --gray-100: #f3f4f6;
      --gray-200: #e5e7eb;
      --gray-300: #d1d5db;
      --gray-600: #4b5563;
      --gray-700: #374151;
      --gray-900: #111827;
      --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
      --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
      --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
      --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
      --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      padding: 0;
      color: var(--gray-900);
    }

    .header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 1.5rem 2rem;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      margin-bottom: 32px;
    }

    .header-content {
      max-width: 1400px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .header h1 {
      font-size: 1.8rem;
      font-weight: 700;
      margin: 0;
    }

    .back-btn {
      background: rgba(255,255,255,0.2);
      color: white;
      padding: 0.6rem 1.5rem;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      text-decoration: none;
      transition: background 0.3s;
      font-size: 1rem;
      font-weight: 600;
    }

    .back-btn:hover {
      background: rgba(255,255,255,0.3);
    }

    .stats-bar {
      max-width: 1400px;
      margin: 0 auto 24px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 16px;
    }

    .stat-card {
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: var(--shadow-lg);
      display: flex;
      align-items: center;
      gap: 16px;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
      transform: translateY(-2px);
      box-shadow: var(--shadow-xl);
    }

    .stat-icon {
      width: 48px;
      height: 48px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
    }

    .stat-icon.orders { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .stat-icon.quotations { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .stat-icon.products { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    .stat-icon.selected { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }

    .stat-content h3 {
      font-size: 0.875rem;
      color: var(--gray-600);
      font-weight: 500;
      margin-bottom: 4px;
    }

    .stat-content p {
      font-size: 1.75rem;
      font-weight: 700;
      color: var(--gray-900);
    }

    .list-container {
      max-width: 1400px;
      margin: 0 auto;
      display: grid;
      gap: 24px;
    }

    .order-card {
      background: white;
      border-radius: 16px;
      box-shadow: var(--shadow-lg);
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .order-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-xl);
    }

    .card-header {
      display: flex;
      gap: 20px;
      padding: 24px;
      border-bottom: 1px solid var(--gray-200);
    }

    .product-image-wrapper {
      flex-shrink: 0;
      position: relative;
    }

    .product-img {
      width: 140px;
      height: 140px;
      border-radius: 12px;
      object-fit: cover;
      border: 2px solid var(--gray-200);
      box-shadow: var(--shadow-md);
    }

    .card-details {
      flex: 1;
      min-width: 0;
    }

    .card-title-row {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 12px;
      gap: 16px;
    }

    .card-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--gray-900);
      line-height: 1.3;
    }

    .status-badge {
      padding: 6px 16px;
      border-radius: 20px;
      font-size: 0.875rem;
      font-weight: 600;
      white-space: nowrap;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .status-badge.pending { 
      background: #fef3c7; 
      color: #92400e;
    }
    
    .status-badge.completed { 
      background: #d1fae5; 
      color: #065f46;
    }
    
    .status-badge.canceled { 
      background: #fee2e2; 
      color: #991b1b;
    }

    .product-description {
      color: var(--gray-600);
      line-height: 1.6;
      margin-bottom: 16px;
      font-size: 0.95rem;
    }

    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 12px;
    }

    .info-item {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .info-label {
      font-size: 0.75rem;
      font-weight: 600;
      color: var(--gray-600);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .info-value {
      font-size: 1rem;
      font-weight: 600;
      color: var(--gray-900);
    }

    .order-actions-section {
      padding: 16px 24px;
      background: var(--gray-50);
      border-bottom: 1px solid var(--gray-200);
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
      align-items: center;
    }

    .status-message {
      padding: 12px 16px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      gap: 8px;
      flex: 1;
      min-width: 250px;
    }

    .status-message.canceled {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
      border: 2px solid #fca5a5;
    }

    .distributors-section {
      padding: 24px;
      background: var(--gray-50);
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .section-title {
      font-size: 1.125rem;
      font-weight: 700;
      color: var(--gray-900);
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .count-badge {
      background: var(--primary);
      color: white;
      padding: 4px 12px;
      border-radius: 12px;
      font-size: 0.875rem;
      font-weight: 700;
    }

    .distributor-grid {
      display: grid;
      gap: 12px;
    }

    .distributor-card {
      background: white;
      border-radius: 12px;
      padding: 16px;
      border: 2px solid var(--gray-200);
      transition: all 0.3s;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 16px;
    }

    .distributor-card:hover {
      border-color: var(--primary);
      box-shadow: var(--shadow-md);
    }

    .distributor-card.selected {
      border-color: var(--secondary);
      background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
    }

    .distributor-info {
      flex: 1;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
      gap: 12px;
      align-items: center;
    }

    .dist-field {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .dist-label {
      font-size: 0.75rem;
      font-weight: 600;
      color: var(--gray-600);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .dist-value {
      font-size: 1rem;
      font-weight: 600;
      color: var(--gray-900);
    }

    .dist-value.price {
      font-size: 1.25rem;
      color: var(--secondary);
    }

    .distributor-actions {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      gap: 8px;
    }

    .quotation-badge {
      background: var(--gray-200);
      color: var(--gray-700);
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 0.75rem;
      font-weight: 600;
    }

    .select-btn, .cancel-btn, .reassign-btn {
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      font-size: 0.875rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      box-shadow: var(--shadow-sm);
    }

    .select-btn {
      background: var(--primary);
      color: white;
    }

    .select-btn:hover:not(:disabled) {
      background: var(--primary-dark);
      transform: translateY(-1px);
      box-shadow: var(--shadow-md);
    }

    .select-btn:disabled {
      background: var(--gray-300);
      cursor: not-allowed;
      opacity: 0.6;
    }

    .select-btn.selected {
      background: var(--secondary);
    }

    .cancel-btn {
      background: var(--danger);
      color: white;
    }

    .cancel-btn:hover {
      background: #dc2626;
      transform: translateY(-1px);
      box-shadow: var(--shadow-md);
    }

    .reassign-btn {
      background: var(--warning);
      color: white;
    }

    .reassign-btn:hover {
      background: #d97706;
      transform: translateY(-1px);
      box-shadow: var(--shadow-md);
    }

    .selected-indicator {
      display: flex;
      align-items: center;
      gap: 6px;
      color: var(--secondary);
      font-weight: 700;
      font-size: 0.875rem;
    }

    .no-distributors {
      text-align: center;
      padding: 40px;
      color: var(--gray-600);
      font-style: italic;
      background: white;
      border-radius: 12px;
      border: 2px dashed var(--gray-300);
    }

    .empty-state {
      background: white;
      border-radius: 16px;
      padding: 60px 40px;
      text-align: center;
      box-shadow: var(--shadow-lg);
    }

    .empty-state-icon {
      font-size: 4rem;
      margin-bottom: 16px;
      opacity: 0.5;
    }

    .empty-state h3 {
      font-size: 1.5rem;
      color: var(--gray-900);
      margin-bottom: 8px;
    }

    .empty-state p {
      font-size: 1rem;
      color: var(--gray-600);
    }

    .tabs-container {
      max-width: 1400px;
      margin: 0 auto 24px;
    }

    .tabs {
      background: white;
      border-radius: 12px;
      padding: 8px;
      display: flex;
      gap: 8px;
      box-shadow: var(--shadow-lg);
    }

    .tab-btn {
      flex: 1;
      background: transparent;
      border: none;
      padding: 14px 24px;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      color: var(--gray-600);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .tab-btn:hover {
      background: var(--gray-100);
      color: var(--gray-900);
    }

    .tab-btn.active {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      box-shadow: var(--shadow-md);
    }

    .search-container {
      max-width: 1400px;
      margin: 0 auto 24px;
    }

    .search-wrapper {
      background: white;
      border-radius: 12px;
      padding: 8px 16px;
      box-shadow: var(--shadow-lg);
      display: flex;
      align-items: center;
      gap: 12px;
      transition: all 0.3s;
    }

    .search-wrapper:focus-within {
      box-shadow: var(--shadow-xl);
      transform: translateY(-2px);
    }

    .search-icon {
      font-size: 1.5rem;
      color: var(--gray-600);
    }

    .search-input {
      flex: 1;
      border: none;
      outline: none;
      font-size: 1rem;
      padding: 12px 8px;
      color: var(--gray-900);
      background: transparent;
    }

    .search-input::placeholder {
      color: var(--gray-400);
    }

    .clear-search {
      background: var(--gray-200);
      border: none;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      cursor: pointer;
      color: var(--gray-600);
      font-size: 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
      flex-shrink: 0;
    }

    .clear-search:hover {
      background: var(--gray-300);
      color: var(--gray-900);
    }

    @media (max-width: 768px) {
      body {
        padding: 12px;
      }

      .header h1 {
        font-size: 1.75rem;
      }

      .header p {
        font-size: 0.95rem;
      }

      .stats-bar {
        grid-template-columns: repeat(2, 1fr);
      }

      .card-header {
        flex-direction: column;
        gap: 16px;
      }

      .product-img {
        width: 100%;
        height: 200px;
      }

      .card-title-row {
        flex-direction: column;
        gap: 12px;
      }

      .info-grid {
        grid-template-columns: 1fr;
      }

      .distributor-card {
        flex-direction: column;
        align-items: stretch;
      }

      .distributor-info {
        grid-template-columns: 1fr;
      }

      .distributor-actions {
        align-items: stretch;
      }

      .select-btn, .cancel-btn, .reassign-btn {
        width: 100%;
      }

      .order-actions-section {
        flex-direction: column;
      }

      .status-message {
        width: 100%;
      }

      .search-input {
        font-size: 0.9rem;
      }
    }

    @media (max-width: 480px) {
      .stats-bar {
        grid-template-columns: 1fr;
      }

      .stat-card {
        padding: 16px;
      }

      .header-content {
        flex-direction: column;
        gap: 1rem;
      }

      .header h1 {
        font-size: 1.5rem;
      }

      .back-btn {
        width: 100%;
        text-align: center;
      }
    }
  </style>
</head>
<body>

  <header class="header">
    <div class="header-content">
      <h1>📋 Quotation Management System</h1>
      <a href="admindashboard.php" class="back-btn">← Back to Dashboard</a>
    </div>
  </header>

  <div class="stats-bar" id="statsBar">
    <div class="stat-card">
      <div class="stat-icon orders">📦</div>
      <div class="stat-content">
        <h3>Total Orders</h3>
        <p id="totalOrders">0</p>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-icon quotations">📋</div>
      <div class="stat-content">
        <h3>Quotations</h3>
        <p id="totalQuotations">0</p>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-icon products">🏷️</div>
      <div class="stat-content">
        <h3>Products</h3>
        <p id="totalProducts">0</p>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-icon selected">✓</div>
      <div class="stat-content">
        <h3>Selected</h3>
        <p id="totalSelected">0</p>
      </div>
    </div>
  </div>

  <div class="tabs-container">
    <div class="tabs">
      <button class="tab-btn active" onclick="switchTab('all')">
        <span>📋</span>
        All Orders
      </button>
      <button class="tab-btn" onclick="switchTab('selected')">
        <span>✓</span>
        Selected
      </button>
      <button class="tab-btn" onclick="switchTab('notSelected')">
        <span>⏳</span>
        Not Selected
      </button>
    </div>
  </div>

  <div class="search-container">
    <div class="search-wrapper">
      <span class="search-icon">🔍</span>
      <input 
        type="text" 
        id="searchInput" 
        class="search-input" 
        placeholder="Search by Order ID, Product Name, User ID, or Distributor ID..."
        oninput="handleSearch()"
      />
      <button class="clear-search" id="clearBtn" onclick="clearSearch()" style="display: none;">✕</button>
    </div>
  </div>

  <div id="listContainer" class="list-container"></div>

  <script>
    const baseUrl = "https://localhost:7048/api";
    const quotationUrl = `${baseUrl}/Quotation`;
    const orderUrl = `${baseUrl}/Order`;
    const productUrl = `${baseUrl}/Product`;

    let quotations = [];
    let orders = [];
    let products = [];
    let currentTab = 'all';
    let searchText = '';

    async function loadQuotationsFull() {
      try {
        const [quotationRes, orderRes, productRes] = await Promise.all([
          fetch(quotationUrl),
          fetch(orderUrl),
          fetch(productUrl)
        ]);

        if (!quotationRes.ok || !orderRes.ok || !productRes.ok) {
          throw new Error("Failed to load one or more datasets");
        }

        quotations = await quotationRes.json();
        orders = await orderRes.json();
        products = await productRes.json();

        updateStats();
        renderOrders();

      } catch (err) {
        console.error("Error loading data:", err);
        alert("Unable to load data. Please check your backend or API URLs.");
      }
    }

    function switchTab(tab) {
      currentTab = tab;
      
      document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
      });
      event.target.closest('.tab-btn').classList.add('active');
      
      renderOrders();
    }

    function handleSearch() {
      searchText = document.getElementById('searchInput').value.toLowerCase();
      document.getElementById('clearBtn').style.display = searchText ? 'flex' : 'none';
      renderOrders();
    }

    function clearSearch() {
      searchText = '';
      document.getElementById('searchInput').value = '';
      document.getElementById('clearBtn').style.display = 'none';
      renderOrders();
    }

    function renderOrders() {
      const container = document.getElementById("listContainer");
      container.innerHTML = "";

      const orderMap = {};
      quotations.forEach(q => {
        if (!orderMap[q.orderID]) {
          orderMap[q.orderID] = [];
        }
        orderMap[q.orderID].push(q);
      });

      let filteredOrderIds = Object.keys(orderMap);
      
      if (currentTab === 'selected') {
        filteredOrderIds = filteredOrderIds.filter(orderId => {
          return orderMap[orderId].some(q => q.isSelected);
        });
      } else if (currentTab === 'notSelected') {
        filteredOrderIds = filteredOrderIds.filter(orderId => {
          return !orderMap[orderId].some(q => q.isSelected);
        });
      }

      if (searchText) {
        filteredOrderIds = filteredOrderIds.filter(orderId => {
          const orderQuotations = orderMap[orderId];
          const order = orders.find(o => o.orderID === parseInt(orderId));
          const product = order ? products.find(p => p.productID === order.productId) : null;
          
          const searchableText = `${orderId} ${product?.productName || ''} ${order?.userId || ''} ${orderQuotations.map(q => q.distributorID).join(' ')}`.toLowerCase();
          return searchableText.includes(searchText);
        });
      }

      if (filteredOrderIds.length === 0) {
        let emptyMessage = 'No orders available';
        let emptyIcon = '📋';
        
        if (currentTab === 'selected') {
          emptyMessage = 'No orders with selected distributors';
          emptyIcon = '✓';
        } else if (currentTab === 'notSelected') {
          emptyMessage = 'No orders without selected distributors';
          emptyIcon = '⏳';
        }
        
        container.innerHTML = `
          <div class="empty-state">
            <div class="empty-state-icon">${emptyIcon}</div>
            <h3>${emptyMessage}</h3>
            <p>Try switching to a different tab to view orders</p>
          </div>
        `;
        return;
      }

      filteredOrderIds.forEach(orderId => {
        const orderQuotations = orderMap[orderId];
        const order = orders.find(o => o.orderID === parseInt(orderId));
        const product = order ? products.find(p => p.productID === order.productId) : null;

        const imgSrc = product?.imageBase64
          ? `data:image/jpeg;base64,${product.imageBase64}`
          : "https://via.placeholder.com/140x140?text=No+Image";

        let statusText = order?.status || "Unknown";
        let statusClass = "pending";
        
        switch(order?.status) {
          case 0:
            statusText = "Pending";
            statusClass = "pending";
            break;
          case 1:
            statusText = "Confirmed";
            statusClass = "completed";
            break;
          case 2:
            statusText = "Cancelled";
            statusClass = "canceled";
            break;
          case 3:
            statusText = "Distributor Added";
            statusClass = "completed";
            break;
          default:
            statusText = "Unknown";
            statusClass = "pending";
        }

        const isCancelled = order?.status === 2;

        let distributorsHTML = '';
        if (orderQuotations.length > 0) {
          distributorsHTML = `
            <div class="distributor-grid">
              ${orderQuotations.map(q => `
                <div class="distributor-card ${q.isSelected ? 'selected' : ''}">
                  <div class="distributor-info">
                    <div class="dist-field">
                      <span class="dist-label">Distributor ID</span>
                      <span class="dist-value">${q.distributorID}</span>
                    </div>
                    <div class="dist-field">
                      <span class="dist-label">Quoted Price</span>
                      <span class="dist-value price">${q.quotedPrice?.toFixed(2) || "N/A"}</span>
                    </div>
                    <div class="dist-field">
                      <span class="dist-label">Quotation</span>
                      <span class="quotation-badge">Q-${q.quotationID}</span>
                    </div>
                  </div>
                  <div class="distributor-actions">
                    ${q.isSelected ? '<div class="selected-indicator">✓ Selected</div>' : ''}
                    <button class="select-btn ${q.isSelected ? 'selected' : ''}" 
                            onclick="selectDistributor(${orderId}, ${q.distributorID}, ${q.quotedPrice}, ${order?.quantity || 1}, ${q.quotationID})"
                            ${q.isSelected || isCancelled ? 'disabled' : ''}>
                      ${q.isSelected ? 'Active' : 'Select Distributor'}
                    </button>
                  </div>
                </div>
              `).join('')}
            </div>
          `;
        } else {
          distributorsHTML = '<div class="no-distributors">No distributors assigned to this order</div>';
        }

        const card = document.createElement("div");
        card.className = "order-card";
        
        let actionsHTML = '';
        if (!isCancelled) {
          actionsHTML = `
            <div class="order-actions-section">
              <button class="cancel-btn" onclick="cancelOrder(${orderId})">
                Cancel Order
              </button>
            </div>
          `;
        } else {
          actionsHTML = `
            <div class="order-actions-section">
              <div class="status-message canceled">
                ✕ Order Cancelled
              </div>
              <button class="reassign-btn" onclick="reassignOrder(${orderId})">
                Reassign Distributor
              </button>
            </div>
          `;
        }
        
        card.innerHTML = `
          <div class="card-header">
            <div class="product-image-wrapper">
              <img src="${imgSrc}" alt="Product Image" class="product-img" />
            </div>
            <div class="card-details">
              <div class="card-title-row">
                <h2 class="card-title">${product ? product.productName : "Unknown Product"}</h2>
                <span class="status-badge ${statusClass}">${statusText}</span>
              </div>
              <p class="product-description">${product?.description || "No description available"}</p>
              <div class="info-grid">
                <div class="info-item">
                  <span class="info-label">Order ID</span>
                  <span class="info-value">#${orderId}</span>
                </div>
                <div class="info-item">
                  <span class="info-label">Quantity</span>
                  <span class="info-value">${order?.quantity || "N/A"}</span>
                </div>
                <div class="info-item">
                  <span class="info-label">User ID</span>
                  <span class="info-value">${order?.userId || "N/A"}</span>
                </div>
                <div class="info-item">
                  <span class="info-label">Created</span>
                  <span class="info-value">${order ? new Date(order.createdAt).toLocaleDateString() : "N/A"}</span>
                </div>
              </div>
            </div>
          </div>
          
          ${actionsHTML}
          
          <div class="distributors-section">
            <div class="section-header">
              <h3 class="section-title">
                Assigned Distributors
                <span class="count-badge">${orderQuotations.length}</span>
              </h3>
            </div>
            ${distributorsHTML}
          </div>
        `;
        container.appendChild(card);
      });
    }

    function updateStats() {
      document.getElementById('totalOrders').textContent = orders.length;
      document.getElementById('totalQuotations').textContent = quotations.length;
      document.getElementById('totalProducts').textContent = products.length;
      document.getElementById('totalSelected').textContent = quotations.filter(q => q.isSelected).length;
    }

    async function selectDistributor(orderId, distributorId, unitPrice, quantity, quotationId) {
      try {
        const totalPrice = unitPrice * quantity;

        const pricingResponse = await fetch(`${baseUrl}/Order/${orderId}/pricing`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            unitPrice: unitPrice,
            totalPrice: totalPrice,
            distributorId: distributorId
          })
        });

        if (!pricingResponse.ok) {
          throw new Error('Failed to update order pricing');
        }

        const quotationResponse = await fetch(`${baseUrl}/Quotation/select/${quotationId}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          }
        });

        if (!quotationResponse.ok) {
          throw new Error('Failed to select quotation');
        }

        const statusResponse = await fetch(`${baseUrl}/Order/${orderId}/status`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(1)
        });

        if (!statusResponse.ok) {
          throw new Error('Failed to update order status');
        }

        alert(`✓ Distributor selected successfully!\n\nOrder ID: ${orderId}\nDistributor ID: ${distributorId}\nUnit Price: ${unitPrice.toFixed(2)}\nQuantity: ${quantity}\nTotal Price: ${totalPrice.toFixed(2)}\n\n✓ Order Confirmed`);
        
        loadQuotationsFull();

      } catch (error) {
        console.error('Error selecting distributor:', error);
        alert('Error selecting distributor. Please try again.');
      }
    }

    async function cancelOrder(orderId) {
      const confirmCancel = confirm(`Are you sure you want to cancel Order #${orderId}?`);
      
      if (!confirmCancel) return;

      try {
        const response = await fetch(`${baseUrl}/Order/${orderId}/status`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(2)
        });

        if (!response.ok) {
          throw new Error('Failed to cancel order');
        }

        alert(`✓ Order #${orderId} has been cancelled successfully`);
        loadQuotationsFull();

      } catch (error) {
        console.error('Error canceling order:', error);
        alert('Error canceling order. Please try again.');
      }
    }

    async function reassignOrder(orderId) {
      const confirmReassign = confirm(`Are you sure you want to reassign distributor for Order #${orderId}? This will reset the order to Pending status.`);
      
      if (!confirmReassign) return;

      try {
        const response = await fetch(`${baseUrl}/Order/${orderId}/status`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(0)
        });

        if (!response.ok) {
          throw new Error('Failed to reassign order');
        }

        alert(`✓ Order #${orderId} has been reset to Pending status. You can now select a new distributor.`);
        loadQuotationsFull();

      } catch (error) {
        console.error('Error reassigning order:', error);
        alert('Error reassigning order. Please try again.');
      }
    }

    loadQuotationsFull();
  </script>
</body>
</html>