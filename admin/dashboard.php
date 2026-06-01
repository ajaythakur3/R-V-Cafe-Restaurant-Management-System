<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../config/db.php");
$booking_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM bookings"));
$menu_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM menu_items"));
$order_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM orders"));

$revenue_query = mysqli_query(
$conn,
"SELECT SUM(total_amount) AS total FROM orders"
);

$revenue = mysqli_fetch_assoc($revenue_query);
$totalRevenue = $revenue['total'] ?? 0;

$booking_count =
mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM bookings")
);

$menu_count =
mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM menu_items")
);
$order_count =
mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM orders")
);

$revenue =
mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT SUM(total_amount) as total FROM orders"
)
);

$totalRevenue = $revenue['total'];

if($totalRevenue == "")
{
    $totalRevenue = 0;
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-dark bg-dark">

<div class="container">

<span class="navbar-brand">
R V Cafe Admin
</span>

<a href="logout.php"
class="btn btn-danger">
Logout
</a>

</div>

</nav>

<div class="container mt-5">

<h2 class="mb-4">
Dashboard
</h2>

<div class="row">

<div class="col-md-3">
<div class="card text-center">
<div class="card-body">
<h3><?php echo $booking_count; ?></h3>
<p>Total Bookings</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-center">
<div class="card-body">
<h3><?php echo $menu_count; ?></h3>
<p>Menu Items</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-center">
<div class="card-body">
<h3><?php echo $order_count; ?></h3>
<p>Total Orders</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-center">
<div class="card-body">
<h3>₹<?php echo $totalRevenue; ?></h3>
<p>Revenue</p>
</div>
</div>
</div>

</div>
<div class="mt-4">

<a href="bookings.php" class="btn btn-primary">
Manage Bookings
</a>

<a href="menu.php" class="btn btn-success">
Manage Menu
</a>

<a href="orders.php" class="btn btn-warning">
Manage Orders
</a>

</div>


</div>

</div>

</body>

</html>