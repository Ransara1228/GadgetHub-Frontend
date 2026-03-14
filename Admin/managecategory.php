<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
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
        }

        .search-box input {
            flex: 1;
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
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .category-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        .category-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: #f0f0f0;
        }

        .category-info {
            padding: 1.5rem;
        }

        .category-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .category-id {
            font-size: 0.9rem;
            color: #999;
            margin-bottom: 1rem;
        }

        .category-actions {
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
        }

        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            position: relative;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            animation: slideUp 0.3s;
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
        .form-group input[type="file"] {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
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
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1rem;
            }

            .container {
                padding: 0 1rem;
            }
        }

           /* Modal Styles */
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
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            position: relative;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            animation: slideUp 0.3s;
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

        #categoryForm, #productForm {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        #categoryForm label, #productForm label {
            font-weight: 600;
            color: #555;
            margin-bottom: 0.25rem;
        }

        #categoryForm input[type="text"],
        #categoryForm input[type="file"],
        #productForm input[type="text"],
        #productForm input[type="file"],
        #productForm select {
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        #categoryForm input[type="text"]:focus,
        #productForm input[type="text"]:focus,
        #productForm select:focus {
            outline: none;
            border-color: #667eea;
        }

        #categoryForm button[type="submit"],
        #productForm button[type="submit"] {
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 1rem;
        }

        #categoryForm button[type="submit"]:hover,
        #productForm button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <h1>📁 Manage Categories</h1>
            <a href="admindashboard.php" class="back-btn">← Back to Dashboard</a>
        </div>
    </header>

    <!-- Container -->
    <div class="container">
        <!-- Search Bar -->
        <div class="search-container">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search categories by name..." onkeyup="searchCategories()">
                <button onclick="searchCategories()">🔍 Search</button>
                <button onclick="openCategoryModal()" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">➕ Add Category</button>
            </div>
        </div>

        <!-- Loading Spinner -->
        <div id="loadingSpinner" class="loading">
            <div class="spinner"></div>
            <p>Loading categories...</p>
        </div>

        <!-- Gallery Grid -->
        <div id="galleryGrid" class="gallery-grid"></div>

        <!-- No Results -->
        <div id="noResults" class="no-results" style="display: none;">
            <h2>No Categories Found</h2>
            <p>Try adjusting your search or add new categories.</p>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Edit Category</h2>
            <form id="editForm" onsubmit="updateCategory(event)">
                <input type="hidden" id="editCategoryId">
                
                <div class="form-group">
                    <label for="editCategoryName">Category Name:</label>
                    <input type="text" id="editCategoryName" required>
                </div>

                <div class="form-group">
                    <label for="editPhoto">Change Photo (Optional):</label>
                    <input type="file" id="editPhoto" accept="image/*" onchange="previewImage(event)">
                    <img id="imagePreview" class="image-preview" alt="Preview">
                </div>

                <div class="form-group">
                    <label>Current Photo:</label>
                    <img id="currentPhoto" style="width: 100%; max-height: 200px; object-fit: contain; border-radius: 8px;">
                </div>

                <div class="modal-actions">
                    <button type="submit" class="btn-save">💾 Save Changes</button>
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Category Modal -->
    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeCategoryModal()">&times;</span>
            <h2>Add New Category</h2>
            <form id="categoryForm">
                <label for="categoryName">Category Name *</label>
                <input type="text" id="categoryName" placeholder="Enter category name" required>
                
                <label for="photo">Photo *</label>
                <input type="file" id="photo" accept="image/*" required>
                
                <button type="submit">Add Category</button>
            </form>
        </div>
    </div>


    <script>
        const API_BASE_URL = 'https://localhost:7048/api/category';
        let allCategories = [];

        // Load categories on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadCategories();
        });

        // Load all categories from API
        async function loadCategories() {
            try {
                document.getElementById('loadingSpinner').style.display = 'block';
                document.getElementById('galleryGrid').innerHTML = '';
                document.getElementById('noResults').style.display = 'none';

                const response = await fetch(API_BASE_URL);
                
                if (!response.ok) {
                    throw new Error('Failed to fetch categories');
                }

                allCategories = await response.json();
                displayCategories(allCategories);
                
            } catch (error) {
                console.error('Error loading categories:', error);
                alert('Failed to load categories. Please check your API connection.');
            } finally {
                document.getElementById('loadingSpinner').style.display = 'none';
            }
        }

        // Display categories in gallery view
        function displayCategories(categories) {
            const galleryGrid = document.getElementById('galleryGrid');
            galleryGrid.innerHTML = '';

            if (categories.length === 0) {
                document.getElementById('noResults').style.display = 'block';
                return;
            }

            document.getElementById('noResults').style.display = 'none';

            categories.forEach(category => {
                const card = document.createElement('div');
                card.className = 'category-card';
                
                // Decode base64 image
                const imageSource = category.photo.startsWith('data:') 
                    ? category.photo 
                    : `data:image/jpeg;base64,${category.photo}`;

                card.innerHTML = `
                    <img src="${imageSource}" alt="${category.categoryName}" class="category-image" onerror="this.src='https://via.placeholder.com/280x200?text=No+Image'">
                    <div class="category-info">
                        <div class="category-name">${category.categoryName}</div>
                        <div class="category-id">ID: ${category.categoryID}</div>
                        <div class="category-actions">
                            <button class="btn btn-edit" onclick="openEditModal(${category.categoryID})">✏️ Edit</button>
                            <button class="btn btn-delete" onclick="deleteCategory(${category.categoryID}, '${category.categoryName}')">🗑️ Delete</button>
                        </div>
                    </div>
                `;
                
                galleryGrid.appendChild(card);
            });
        }

        // Search categories
        function searchCategories() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            
            const filteredCategories = allCategories.filter(category => 
                category.categoryName.toLowerCase().includes(searchTerm)
            );
            
            displayCategories(filteredCategories);
        }

        // Open edit modal
        async function openEditModal(categoryId) {
            try {
                const response = await fetch(`${API_BASE_URL}/${categoryId}`);
                
                if (!response.ok) {
                    throw new Error('Failed to fetch category details');
                }

                const category = await response.json();
                
                document.getElementById('editCategoryId').value = category.categoryID;
                document.getElementById('editCategoryName').value = category.categoryName;
                
                // Display current photo
                const imageSource = category.photo.startsWith('data:') 
                    ? category.photo 
                    : `data:image/jpeg;base64,${category.photo}`;
                document.getElementById('currentPhoto').src = imageSource;
                
                // Reset file input and preview
                document.getElementById('editPhoto').value = '';
                document.getElementById('imagePreview').style.display = 'none';
                
                document.getElementById('editModal').style.display = 'flex';
                document.body.style.overflow = 'hidden';
                
            } catch (error) {
                console.error('Error loading category:', error);
                alert('Failed to load category details.');
            }
        }

        // Close edit modal
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Preview image before upload
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

        // Update category
        async function updateCategory(event) {
            event.preventDefault();
            
            const categoryId = document.getElementById('editCategoryId').value;
            const categoryName = document.getElementById('editCategoryName').value.trim();
            const photoInput = document.getElementById('editPhoto').files[0];
            
            if (!categoryName) {
                alert('Please enter a category name.');
                return;
            }

            try {
                let photoBase64 = null;
                
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
                    
                    photoBase64 = await convertToBase64(photoInput);
                } else {
                    // Keep existing photo
                    const response = await fetch(`${API_BASE_URL}/${categoryId}`);
                    const currentCategory = await response.json();
                    photoBase64 = currentCategory.photo;
                }

                const updateResponse = await fetch(`${API_BASE_URL}/${categoryId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        categoryID: parseInt(categoryId),
                        categoryName: categoryName,
                        photo: photoBase64
                    })
                });

                if (updateResponse.ok) {
                    alert('Category updated successfully!');
                    closeEditModal();
                    loadCategories();
                } else {
                    const errorData = await updateResponse.json();
                    alert(`Failed to update category: ${errorData.message || 'Unknown error'}`);
                }
                
            } catch (error) {
                console.error('Error updating category:', error);
                alert('An error occurred while updating the category.');
            }
        }

        // Delete category
        async function deleteCategory(categoryId, categoryName) {
            if (!confirm(`Are you sure you want to delete "${categoryName}"?`)) {
                return;
            }

            try {
                const response = await fetch(`${API_BASE_URL}/${categoryId}`, {
                    method: 'DELETE'
                });

                if (response.ok) {
                    alert('Category deleted successfully!');
                    loadCategories();
                } else {
                    alert('Failed to delete category.');
                }
                
            } catch (error) {
                console.error('Error deleting category:', error);
                alert('An error occurred while deleting the category.');
            }
        }

        // Convert file to base64
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

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('editModal');
            if (event.target === modal) {
                closeEditModal();
            }
        }

          // Open and Close Category Modal
        function openCategoryModal() {
            const modal = document.getElementById('categoryModal');
            if (modal) {
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
                const mobileMenu = document.getElementById('mobileMenu');
                mobileMenu.classList.remove('active');
            }
        }

        function closeCategoryModal() {
            const modal = document.getElementById('categoryModal');
            if (modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        }

        // Handle Category Form Submission (Updated for managecategory.php)
document.getElementById('categoryForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const categoryName = document.getElementById('categoryName').value.trim();
    const photoInput = document.getElementById('photo').files[0];

    if (!categoryName || !photoInput) {
        alert('Please fill all fields.');
        return;
    }

    if (photoInput.size > 5 * 1024 * 1024) {
        alert('File size should not exceed 5MB');
        return;
    }

    if (!photoInput.type.startsWith('image/')) {
        alert('Please upload a valid image file');
        return;
    }

    const reader = new FileReader();
    reader.onload = async function () {
        const base64Photo = reader.result.split(',')[1];

        try {
            const response = await fetch(API_BASE_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    categoryName: categoryName,
                    photo: base64Photo
                })
            });

            if (response.ok) {
                alert('Category added successfully!');
                document.getElementById('categoryForm').reset();
                closeCategoryModal();
                loadCategories(); // Reload categories to show the new one
            } else {
                const errorData = await response.json();
                alert(`Failed to add category: ${errorData.message || 'Unknown error'}`);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while adding the category. Please try again.');
        }
    };

    reader.onerror = function() {
        alert('Error reading file. Please try again.');
    };

    reader.readAsDataURL(photoInput);
});

// Update window.onclick to handle both modals
window.onclick = function(event) {
    const editModal = document.getElementById('editModal');
    const categoryModal = document.getElementById('categoryModal');
    
    if (event.target === editModal) {
        closeEditModal();
    }
    if (event.target === categoryModal) {
        closeCategoryModal();
    }
}

    </script>
</body>
</html>