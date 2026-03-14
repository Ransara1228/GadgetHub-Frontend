// Initialize dashboard with user data
document.addEventListener('DOMContentLoaded', function() {
    const fullName = 'Admin User';
    const role = 'Admin';
    
    if (fullName) {
        document.getElementById('welcomeText').textContent = `Welcome, ${fullName}`;
        document.getElementById('profileAvatar').textContent = fullName.charAt(0).toUpperCase();
    }
});

// Toggle mobile menu
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenu.classList.toggle('active');
}

// Toggle mobile category submenu with arrow rotation
function toggleMobileCategorySubmenu(event) {
    event.preventDefault();
    event.stopPropagation();
    const submenu = document.getElementById('mobileCategorySubmenu');
    const categoryLink = event.currentTarget;
    
    submenu.classList.toggle('active');
    categoryLink.classList.toggle('expanded');
}

// Toggle category dropdown on click (Desktop)
function toggleCategoryDropdown(event) {
    event.stopPropagation();
    const dropdown = document.getElementById('categoryDropdownContent');
    dropdown.classList.toggle('active');
}

// Logout function
function logout() {
    if (confirm('Are you sure you want to logout?')) {
        alert('Logged out successfully!');
        // window.location.href = '../login.php';
    }
}

// Close mobile menu and category dropdown when clicking outside
document.addEventListener('click', function(event) {
    const mobileMenu = document.getElementById('mobileMenu');
    const navContainer = document.querySelector('.nav-container');
    const categoryDropdown = document.getElementById('categoryDropdownContent');
    
    // Close mobile menu if clicking outside
    if (!navContainer.contains(event.target)) {
        mobileMenu.classList.remove('active');
        const submenu = document.getElementById('mobileCategorySubmenu');
        if (submenu) {
            submenu.classList.remove('active');
        }
        const categoryLinks = document.querySelectorAll('.mobile-menu > a[onclick*="toggleMobileCategorySubmenu"]');
        categoryLinks.forEach(link => link.classList.remove('expanded'));
    }
    
    // Close category dropdown if clicking outside (desktop)
    if (categoryDropdown && !event.target.closest('.category-dropdown')) {
        categoryDropdown.classList.remove('active');
    }
});

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

// Open and Close Product Modal
async function openProductModal() {
    const modal = document.getElementById('productModal');
    if (modal) {
        // Load categories before opening modal
        await loadCategories();
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.remove('active');
    }
}

// Load categories from API
async function loadCategories() {
    try {
        const response = await fetch('https://localhost:7048/api/category');
        if (response.ok) {
            const categories = await response.json();
            const categorySelect = document.getElementById('productCategory');
            
            // Clear existing options except the first one
            categorySelect.innerHTML = '<option value="">Select a category</option>';
            
            // Populate dropdown with categories
            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category.categoryName;
                option.textContent = category.categoryName;
                categorySelect.appendChild(option);
            });
        } else {
            console.error('Failed to load categories');
        }
    } catch (error) {
        console.error('Error loading categories:', error);
        alert('Failed to load categories. Please try again.');
    }
}

function closeProductModal() {
    const modal = document.getElementById('productModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

// Close modal when clicking outside
window.onclick = function(event) {
    const categoryModal = document.getElementById('categoryModal');
    const productModal = document.getElementById('productModal');
    
    if (event.target === categoryModal) {
        closeCategoryModal();
    }
    if (event.target === productModal) {
        closeProductModal();
    }
}

// Handle Category Form Submission
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
            const response = await fetch('https://localhost:7048/api/category', {
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

// Handle Product Form Submission
document.getElementById('productForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const productName = document.getElementById('productName').value.trim();
    const productCode = document.getElementById('productCode').value.trim();
    const description = document.getElementById('description').value.trim();
    const category = document.getElementById('productCategory').value.trim();
    const imageInput = document.getElementById('productImage').files[0];

    if (!productName || !category) {
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

    const submitProduct = async (base64Image) => {
        try {
            const response = await fetch('https://localhost:7048/api/product', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    productCode: productCode || undefined,
                    productName: productName,
                    description: description || undefined,
                    category: category,
                    imageBase64: base64Image || undefined
                })
            });

            if (response.ok) {
                alert('Product added successfully!');
                document.getElementById('productForm').reset();
                closeProductModal();
            } else {
                const errorData = await response.json();
                alert(`Failed to add product: ${errorData.message || 'Unknown error'}`);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while adding the product. Please try again.');
        }
    };

    if (imageInput) {
        const reader = new FileReader();
        reader.onload = async function () {
            const base64Image = reader.result.split(',')[1];
            await submitProduct(base64Image);
        };
        reader.onerror = function() {
            alert('Error reading file. Please try again.');
        };
        reader.readAsDataURL(imageInput);
    } else {
        await submitProduct(null);
    }
});