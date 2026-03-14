<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            color: #333;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
        }

        .back-btn:hover {
            background: rgba(255,255,255,0.3);
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        /* Search Bar */
        .search-container {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }

        .search-box {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-box input {
            flex: 1;
            min-width: 250px;
            padding: 0.8rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .search-box input:focus {
            outline: none;
            border-color: #667eea;
        }

        .search-box select {
            padding: 0.8rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: border-color 0.3s;
        }

        .search-box select:focus {
            outline: none;
            border-color: #667eea;
        }

        .search-box button {
            padding: 0.8rem 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: transform 0.2s;
        }

        .search-box button:hover {
            transform: translateY(-2px);
        }

        /* Loading Spinner */
        .loading {
            text-align: center;
            padding: 3rem;
            font-size: 1.2rem;
            color: #667eea;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 2rem auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        .product-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: #f0f0f0;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .product-code {
            font-size: 0.85rem;
            color: #667eea;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .product-category {
            display: inline-block;
            background: #e8f0fe;
            color: #667eea;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
        }

        .product-description {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-date {
            font-size: 0.8rem;
            color: #999;
            margin-bottom: 1rem;
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            flex: 1;
            padding: 0.6rem 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-edit {
            background: #4facfe;
            color: white;
        }

        .btn-edit:hover {
            background: #3a8fd9;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: #f44336;
            color: white;
        }

        .btn-delete:hover {
            background: #d32f2f;
            transform: translateY(-2px);
        }

        /* No Results */
        .no-results {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .no-results h2 {
            color: #667eea;
            margin-bottom: 1rem;
        }

        .no-results p {
            color: #666;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s;
            overflow-y: auto;
        }

        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            animation: slideUp 0.3s;
            margin: 2rem auto;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .close {
            position: absolute;
            right: 20px;
            top: 15px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            color: #999;
            transition: color 0.2s;
        }

        .close:hover {
            color: #f44336;
        }

        .modal-content h2 {
            margin-bottom: 1.5rem;
            color: #333;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .form-group input[type="text"],
        .form-group textarea,
        .form-group select,
        .form-group input[type="file"] {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
            font-family: inherit;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }

        .image-preview {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            border-radius: 8px;
            margin-top: 1rem;
            display: none;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .modal-actions button {
            flex: 1;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .btn-save {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-save:hover {
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: #e0e0e0;
            color: #333;
        }

        .btn-cancel:hover {
            background: #d0d0d0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1rem;
            }

            .container {
                padding: 0 1rem;
            }

            .search-box {
                flex-direction: column;
            }

            .search-box input,
            .search-box select {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <h1>📦 Manage Products</h1>
            <a href="admindashboard.php" class="back-btn">← Back to Dashboard</a>
        </div>
    </header>

    <!-- Container -->
    <div class="container">
        <!-- Search Bar -->
        <div class="search-container">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search products by name or code..." onkeyup="searchProducts()">
                <select id="categoryFilter" onchange="searchProducts()">
                    <option value="">All Categories</option>
                </select>
                <button onclick="searchProducts()">🔍 Search</button>
                 <button onclick="openProductModal()" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">➕ Add Product</button>
            </div>
        </div>

        <!-- Loading Spinner -->
        <div id="loadingSpinner" class="loading">
            <div class="spinner"></div>
            <p>Loading products...</p>
        </div>

        <!-- Gallery Grid -->
        <div id="galleryGrid" class="gallery-grid"></div>

        <!-- No Results -->
        <div id="noResults" class="no-results" style="display: none;">
            <h2>No Products Found</h2>
            <p>Try adjusting your search or add new products.</p>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Edit Product</h2>
            <form id="editForm" onsubmit="updateProduct(event)">
                <input type="hidden" id="editProductId">
                
                <div class="form-group">
                    <label for="editProductCode">Product Code:</label>
                    <input type="text" id="editProductCode" placeholder="Leave empty for auto-generation">
                </div>

                <div class="form-group">
                    <label for="editProductName">Product Name: *</label>
                    <input type="text" id="editProductName" required>
                </div>

                <div class="form-group">
                    <label for="editDescription">Description:</label>
                    <textarea id="editDescription" placeholder="Enter product description"></textarea>
                </div>

                <div class="form-group">
                    <label for="editCategory">Category: *</label>
                    <select id="editCategory" required>
                        <option value="">Select a category</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="editPhoto">Change Image (Optional):</label>
                    <input type="file" id="editPhoto" accept="image/*" onchange="previewImage(event)">
                    <img id="imagePreview" class="image-preview" alt="Preview">
                </div>

                <div class="form-group">
                    <label>Current Image:</label>
                    <img id="currentPhoto" style="width: 100%; max-height: 200px; object-fit: contain; border-radius: 8px;">
                </div>

                <div class="modal-actions">
                    <button type="submit" class="btn-save">💾 Save Changes</button>
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Product Modal -->
<div id="addProductModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAddProductModal()">&times;</span>
        <h2>Add New Product</h2>
        <form id="addProductForm">
            <div class="form-group">
                <label for="addProductCode">Product Code (Optional)</label>
                <input type="text" id="addProductCode" placeholder="Leave empty for auto-generation">
            </div>

            <div class="form-group">
                <label for="addProductName">Product Name *</label>
                <input type="text" id="addProductName" placeholder="Enter product name" required>
            </div>

            <div class="form-group">
                <label for="addDescription">Description</label>
                <textarea id="addDescription" placeholder="Enter product description"></textarea>
            </div>

            <div class="form-group">
                <label for="addProductCategory">Category *</label>
                <select id="addProductCategory" required>
                    <option value="">Select a category</option>
                </select>
            </div>

            <div class="form-group">
                <label for="addProductImage">Product Image</label>
                <input type="file" id="addProductImage" accept="image/*" onchange="previewAddProductImage(event)">
                <img id="addProductImagePreview" class="image-preview" alt="Preview">
            </div>

            <div class="modal-actions">
                <button type="submit" class="btn-save">➕ Add Product</button>
                <button type="button" class="btn-cancel" onclick="closeAddProductModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

    <script>
const PRODUCT_API_URL = 'https://localhost:7048/api/product';
const CATEGORY_API_URL = 'https://localhost:7048/api/category';
let allProducts = [];
let allCategories = [];

// Load products and categories on page load
document.addEventListener('DOMContentLoaded', function() {
    loadCategories();
    loadProducts();
});

// ✅ Load all categories ONCE and cache them
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

// ✅ Populate category filters and dropdowns (using CategoryID as value)
function populateCategoryFilters() {
    const categoryFilter = document.getElementById('categoryFilter');
    const editCategory = document.getElementById('editCategory');
    const addProductCategory = document.getElementById('addProductCategory');
    
    // Populate filter dropdown (using CategoryID for filtering)
    categoryFilter.innerHTML = '<option value="">All Categories</option>';
    allCategories.forEach(category => {
        const option = document.createElement('option');
        option.value = category.categoryID;
        option.textContent = category.categoryName;
        categoryFilter.appendChild(option);
    });

    // Populate edit dropdown (using CategoryID as value)
    editCategory.innerHTML = '<option value="">Select a category</option>';
    allCategories.forEach(category => {
        const option = document.createElement('option');
        option.value = category.categoryID;
        option.textContent = category.categoryName;
        editCategory.appendChild(option);
    });

    // Populate add product dropdown (using CategoryID as value) - ONLY ONCE
    if (addProductCategory) {
        addProductCategory.innerHTML = '<option value="">Select a category</option>';
        allCategories.forEach(category => {
            const option = document.createElement('option');
            option.value = category.categoryID;
            option.textContent = category.categoryName;
            addProductCategory.appendChild(option);
        });
    }
}

// ✅ Load all products from API
async function loadProducts() {
    try {
        document.getElementById('loadingSpinner').style.display = 'block';
        document.getElementById('galleryGrid').innerHTML = '';
        document.getElementById('noResults').style.display = 'none';

        const response = await fetch(PRODUCT_API_URL);
        
        if (!response.ok) {
            throw new Error('Failed to fetch products');
        }

        allProducts = await response.json();
        displayProducts(allProducts);
        
    } catch (error) {
        console.error('Error loading products:', error);
        alert('Failed to load products. Please check your API connection.');
    } finally {
        document.getElementById('loadingSpinner').style.display = 'none';
    }
}

// ✅ Get category name from CategoryID
function getCategoryName(categoryID) {
    const category = allCategories.find(cat => cat.categoryID === categoryID);
    return category ? category.categoryName : 'Uncategorized';
}

// ✅ Display products in gallery view
function displayProducts(products) {
    const galleryGrid = document.getElementById('galleryGrid');
    galleryGrid.innerHTML = '';

    if (products.length === 0) {
        document.getElementById('noResults').style.display = 'block';
        return;
    }

    document.getElementById('noResults').style.display = 'none';

    products.forEach(product => {
        const card = document.createElement('div');
        card.className = 'product-card';
        
        // Handle image
        let imageSource = 'https://via.placeholder.com/300x220?text=No+Image';
        if (product.imageBase64) {
            imageSource = product.imageBase64.startsWith('data:') 
                ? product.imageBase64 
                : `data:image/jpeg;base64,${product.imageBase64}`;
        }

        // Format date
        const createdDate = new Date(product.createdAt).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });

        // Get category name from CategoryID
        const categoryName = product.category?.categoryName || getCategoryName(product.categoryID);

        card.innerHTML = `
            <img src="${imageSource}" alt="${product.productName}" class="product-image" onerror="this.src='https://via.placeholder.com/300x220?text=No+Image'">
            <div class="product-info">
                <div class="product-name">${product.productName}</div>
                <div class="product-code">Code: ${product.productCode || 'N/A'}</div>
                <span class="product-category">${categoryName}</span>
                <div class="product-description">${product.description || 'No description available'}</div>
                <div class="product-date">Added: ${createdDate}</div>
                <div class="product-actions">
                    <button class="btn btn-edit" onclick="openEditModal(${product.productID})">✏️ Edit</button>
                    <button class="btn btn-delete" onclick="deleteProduct(${product.productID}, '${product.productName}')">🗑️ Delete</button>
                </div>
            </div>
        `;
        
        galleryGrid.appendChild(card);
    });
}

// ✅ Search products (updated to filter by CategoryID)
function searchProducts() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const categoryFilterValue = document.getElementById('categoryFilter').value;
    
    const filteredProducts = allProducts.filter(product => {
        const matchesSearch = product.productName.toLowerCase().includes(searchTerm) ||
                            (product.productCode && product.productCode.toLowerCase().includes(searchTerm));
        
        // Filter by CategoryID instead of category name
        const matchesCategory = !categoryFilterValue || product.categoryID === parseInt(categoryFilterValue);
        
        return matchesSearch && matchesCategory;
    });
    
    displayProducts(filteredProducts);
}

// ✅ Open add product modal - NO API CALL, uses cached categories
function openProductModal() {
    document.getElementById('addProductModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

// ✅ Close add product modal
function closeAddProductModal() {
    document.getElementById('addProductModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    document.getElementById('addProductForm').reset();
    document.getElementById('addProductImagePreview').style.display = 'none';
}

// ✅ Preview add product image
function previewAddProductImage(event) {
    const preview = document.getElementById('addProductImagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
}

// ✅ Open edit modal
async function openEditModal(productId) {
    try {
        const response = await fetch(`${PRODUCT_API_URL}/${productId}`);
        
        if (!response.ok) {
            throw new Error('Failed to fetch product details');
        }

        const product = await response.json();
        
        document.getElementById('editProductId').value = product.productID;
        document.getElementById('editProductCode').value = product.productCode || '';
        document.getElementById('editProductName').value = product.productName;
        document.getElementById('editDescription').value = product.description || '';
        
        // Set the CategoryID in the dropdown
        document.getElementById('editCategory').value = product.categoryID || '';
        
        // Display current image
        if (product.imageBase64) {
            const imageSource = product.imageBase64.startsWith('data:') 
                ? product.imageBase64 
                : `data:image/jpeg;base64,${product.imageBase64}`;
            document.getElementById('currentPhoto').src = imageSource;
        } else {
            document.getElementById('currentPhoto').src = 'https://via.placeholder.com/300x200?text=No+Image';
        }
        
        // Reset file input and preview
        document.getElementById('editPhoto').value = '';
        document.getElementById('imagePreview').style.display = 'none';
        
        document.getElementById('editModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
        
    } catch (error) {
        console.error('Error loading product:', error);
        alert('Failed to load product details.');
    }
}

// ✅ Close edit modal
function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// ✅ Preview image before upload
function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
}

// ✅ Convert file to base64
function convertToBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = () => {
            const base64 = reader.result.split(',')[1];
            resolve(base64);
        };
        reader.onerror = reject;
        reader.readAsDataURL(file);
    });
}

// ✅ Handle Add Product Form Submission
document.getElementById('addProductForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const productName = document.getElementById('addProductName').value.trim();
    const productCode = document.getElementById('addProductCode').value.trim();
    const description = document.getElementById('addDescription').value.trim();
    const categoryID = parseInt(document.getElementById('addProductCategory').value);
    const imageInput = document.getElementById('addProductImage').files[0];

    if (!productName || !categoryID) {
        alert('Please fill all required fields.');
        return;
    }

    if (imageInput) {
        if (imageInput.size > 5 * 1024 * 1024) {
            alert('File size should not exceed 5MB');
            return;
        }

        if (!imageInput.type.startsWith('image/')) {
            alert('Please upload a valid image file');
            return;
        }
    }

    try {
        let imageBase64 = null;

        if (imageInput) {
            imageBase64 = await convertToBase64(imageInput);
        }

        const response = await fetch(PRODUCT_API_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                productCode: productCode || undefined,
                productName: productName,
                description: description || undefined,
                categoryID: categoryID,
                imageBase64: imageBase64 || undefined
            })
        });

        if (response.ok) {
            alert('Product added successfully!');
            document.getElementById('addProductForm').reset();
            closeAddProductModal();
            loadProducts();
        } else {
            const errorData = await response.json();
            alert(`Failed to add product: ${errorData.message || 'Unknown error'}`);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred while adding the product. Please try again.');
    }
});

// ✅ Update product (now sends CategoryID)
async function updateProduct(event) {
    event.preventDefault();
    
    const productId = document.getElementById('editProductId').value;
    const productCode = document.getElementById('editProductCode').value.trim();
    const productName = document.getElementById('editProductName').value.trim();
    const description = document.getElementById('editDescription').value.trim();
    const categoryID = parseInt(document.getElementById('editCategory').value);
    const photoInput = document.getElementById('editPhoto').files[0];
    
    if (!productName || !categoryID) {
        alert('Please fill all required fields.');
        return;
    }

    try {
        let imageBase64 = null;
        
        // If new photo selected, convert to base64
        if (photoInput) {
            if (photoInput.size > 5 * 1024 * 1024) {
                alert('File size should not exceed 5MB');
                return;
            }
            
            if (!photoInput.type.startsWith('image/')) {
                alert('Please upload a valid image file');
                return;
            }
            
            imageBase64 = await convertToBase64(photoInput);
        } else {
            // Keep existing image
            const response = await fetch(`${PRODUCT_API_URL}/${productId}`);
            const currentProduct = await response.json();
            imageBase64 = currentProduct.imageBase64;
        }

        const updateResponse = await fetch(`${PRODUCT_API_URL}/${productId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                productID: parseInt(productId),
                productCode: productCode || undefined,
                productName: productName,
                description: description || undefined,
                categoryID: categoryID,
                imageBase64: imageBase64
            })
        });

        if (updateResponse.ok) {
            alert('Product updated successfully!');
            closeEditModal();
            loadProducts();
        } else {
            const errorData = await updateResponse.json();
            alert(`Failed to update product: ${errorData.message || 'Unknown error'}`);
        }
        
    } catch (error) {
        console.error('Error updating product:', error);
        alert('An error occurred while updating the product.');
    }
}

// ✅ Delete product
async function deleteProduct(productId, productName) {
    if (!confirm(`Are you sure you want to delete "${productName}"?`)) {
        return;
    }

    try {
        const response = await fetch(`${PRODUCT_API_URL}/${productId}`, {
            method: 'DELETE'
        });

        if (response.ok) {
            alert('Product deleted successfully!');
            loadProducts();
        } else {
            alert('Failed to delete product.');
        }
        
    } catch (error) {
        console.error('Error deleting product:', error);
        alert('An error occurred while deleting the product.');
    }
}

// ✅ Close modal when clicking outside
window.onclick = function(event) {
    const editModal = document.getElementById('editModal');
    const addProductModal = document.getElementById('addProductModal');
    
    if (event.target === editModal) {
        closeEditModal();
    }
    if (event.target === addProductModal) {
        closeAddProductModal();
    }
}
    </script>
</body>
</html>