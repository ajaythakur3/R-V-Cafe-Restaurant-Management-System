<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../config/db.php");

if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    mysqli_query($conn,
    "DELETE FROM bookings WHERE id='$id'");
}

$result =
mysqli_query($conn,
"SELECT * FROM bookings ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>
<head>

<title>Manage Bookings</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Manage Bookings</h2>

<a href="dashboard.php"
class="btn btn-secondary mb-3">
Back
</a>

<table class="table table-bordered">

<tr>

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Date</th>
<th>Time</th>
<th>Guests</th>
<th>Status</th>
<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['customer_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['booking_date']; ?></td>

<td><?php echo $row['booking_time']; ?></td>

<td><?php echo $row['guests']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>

<a href="?delete=<?php echo $row['id']; ?>"
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