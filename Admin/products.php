<?php
require_once 'includes/config.php';
checkAdminAuth();

// Handle product operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $name = $_POST['name'];
                $price = $_POST['price'];
                $type = $_POST['type'];
                $description = $_POST['description'];

                // Handle image upload
                $target_dir = "../assets/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_path = "assets/" . basename($_FILES["image"]["name"]);
                    $sql = "INSERT INTO products (product_name, price, product_type, description, image_path) 
                            VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sdsss", $name, $price, $type, $description, $image_path);
                    $stmt->execute();
                }
                break;

            case 'update':
                $id = $_POST['id'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $type = $_POST['type'];
                $description = $_POST['description'];

                $sql = "UPDATE products SET product_name=?, price=?, product_type=?, description=? WHERE product_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sdssi", $name, $price, $type, $description, $id);
                $stmt->execute();
                break;

            case 'delete':
                $id = $_POST['id'];
                $sql = "DELETE FROM products WHERE product_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                break;
        }
    }
}

// Fetch all products
$sql = "SELECT * FROM products ORDER BY product_id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon-32x32.png">

</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Product Management</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="bi bi-plus-lg"></i> Add New Product
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['product_id']; ?></td>
                        <td>
                            <img src="../<?php echo $row['image_path']; ?>" alt="<?php echo $row['product_name']; ?>" 
                                 style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td>LKR <?php echo number_format($row['price'], 2); ?></td>
                        <td><?php echo ucfirst($row['product_type']); ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning edit-btn" 
                                    data-id="<?php echo $row['product_id']; ?>"
                                    data-name="<?php echo $row['product_name']; ?>"
                                    data-price="<?php echo $row['price']; ?>"
                                    data-type="<?php echo $row['product_type']; ?>"
                                    data-description="<?php echo $row['description']; ?>">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger delete-btn" 
                                    data-id="<?php echo $row['product_id']; ?>">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="add">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select class="form-control" name="type" required>
                                <option value="tshirt">T-Shirt</option>
                                <option value="pants">Pants</option>
                                <option value="hoodie">Hoodie</option>
                                <option value="shorts">Shorts</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="edit-name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" name="price" id="edit-price" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select class="form-control" name="type" id="edit-type" required>
                                <option value="tshirt">T-Shirt</option>
                                <option value="pants">Pants</option>
                                <option value="hoodie">Hoodie</option>
                                <option value="shorts">Shorts</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="edit-description" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Edit product
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', () => {
                const modal = new bootstrap.Modal(document.getElementById('editProductModal'));
                document.getElementById('edit-id').value = button.dataset.id;
                document.getElementById('edit-name').value = button.dataset.name;
                document.getElementById('edit-price').value = button.dataset.price;
                document.getElementById('edit-type').value = button.dataset.type;
                document.getElementById('edit-description').value = button.dataset.description;
                modal.show();
            });
        });

        // Delete product
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', () => {
                if (confirm('Are you sure you want to delete this product?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.innerHTML = `
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="${button.dataset.id}">
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
