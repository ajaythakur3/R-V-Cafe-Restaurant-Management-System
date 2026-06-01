<?php
include("config/db.php");
include("includes/header.php");
?>

<div class="container py-5">

<h1 class="text-center mb-5">
Our Menu
</h1>

<div class="row">

<?php

$query = mysqli_query($conn,"SELECT * FROM menu_items");

while($row=mysqli_fetch_assoc($query))
{
?>

<div class="col-md-4 mb-4">

<div class="card h-100">

<img
src="assets/images/foods/<?php echo $row['image']; ?>"
class="card-img-top"
style="height:250px;object-fit:cover;">

<div class="card-body">

<h4><?php echo $row['food_name']; ?></h4>

<p>
<?php echo $row['description']; ?>
</p>

<h5 class="text-success">
₹<?php echo $row['price']; ?>
</h5>

<p class="badge bg-primary">
<?php echo $row['category']; ?>
</p>

<a href="add_to_cart.php?id=<?php echo $row['id']; ?>"
class="btn btn-warning w-100">
Add To Cart
</a>

</div>

</div>

</div>

<?php
}
?>

</div>

</div>

<?php include("includes/footer.php"); ?>