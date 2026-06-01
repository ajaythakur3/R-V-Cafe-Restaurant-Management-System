<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../config/db.php");

$result =
mysqli_query($conn,
"SELECT * FROM orders ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>

<head>

<title>Orders</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Customer Orders</h2>

<a href="dashboard.php"
class="btn btn-secondary mb-3">
Back
</a>

<table class="table table-bordered">

<tr>

<th>ID</th>
<th>Customer</th>
<th>Phone</th>
<th>Total</th>
<th>Status</th>
<th>Date</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['customer_name']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td>₹<?php echo $row['total_amount']; ?></td>

<td><?php echo $row['status']; ?></td>

<td><?php echo $row['order_date']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>