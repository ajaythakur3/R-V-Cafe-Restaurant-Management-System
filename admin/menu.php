<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../config/db.php");

if(isset($_POST['add_food']))
{
    $food_name = $_POST['food_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file(
        $tmp,
        "../assets/images/foods/".$image
    );

    mysqli_query(
    $conn,
    "INSERT INTO menu_items
    (food_name,category,price,description,image)
    VALUES
    ('$food_name','$category','$price','$description','$image')");
}

if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    mysqli_query($conn,
    "DELETE FROM menu_items WHERE id='$id'");
}

$result =
mysqli_query($conn,
"SELECT * FROM menu_items ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>

<head>

<title>Manage Menu</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Menu Management</h2>

<a href="dashboard.php"
class="btn btn-secondary mb-3">
Back
</a>

<div class="card p-4 mb-4">

<h4>Add New Food</h4>

<form method="POST" enctype="multipart/form-data">

<input
type="text"
name="food_name"
class="form-control mb-2"
placeholder="Food Name"
required>

<input
type="text"
name="category"
class="form-control mb-2"
placeholder="Category"
required>

<input
type="number"
step="0.01"
name="price"
class="form-control mb-2"
placeholder="Price"
required>

<input
type="file"
name="image"
class="form-control mb-2"
required>

<textarea
name="description"
class="form-control mb-2"
placeholder="Description">
</textarea>

<button
type="submit"
name="add_food"
class="btn btn-success">
Add Food
</button>

</form>

</div>

<table class="table table-bordered">

<tr>

<th>ID</th>
<th>Image</th>
<th>Name</th>
<th>Category</th>
<th>Price</th>
<th>Description</th>
<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td>
<img
src="../assets/images/foods/<?php echo $row['image']; ?>"
width="80"
height="60">
</td>

<td><?php echo $row['food_name']; ?></td>

<td><?php echo $row['category']; ?></td>

<td>₹<?php echo $row['price']; ?></td>

<td><?php echo $row['description']; ?></td>

<td>

<a
href="?delete=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>