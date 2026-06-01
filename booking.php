<?php

include("config/db.php");

$message = "";

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['guests'];
    $msg = $_POST['message'];

    $sql = "INSERT INTO bookings
    (customer_name,email,phone,booking_date,booking_time,guests,message)
    VALUES
    ('$name','$email','$phone','$date','$time','$guests','$msg')";

    if(mysqli_query($conn,$sql))
    {
        $message = "Table booked successfully!";
    }
}

include("includes/header.php");

?>

<div class="container py-5">

<h2 class="text-center mb-4">Reserve a Table</h2>

<?php if($message!="") { ?>

<div class="alert alert-success">
<?php echo $message; ?>
</div>

<?php } ?>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">
<input type="text"
name="name"
class="form-control"
placeholder="Full Name"
required>
</div>

<div class="col-md-6 mb-3">
<input type="email"
name="email"
class="form-control"
placeholder="Email"
required>
</div>

<div class="col-md-6 mb-3">
<input type="text"
name="phone"
class="form-control"
placeholder="Phone Number"
required>
</div>

<div class="col-md-6 mb-3">
<input type="number"
name="guests"
class="form-control"
placeholder="Number of Guests"
required>
</div>

<div class="col-md-6 mb-3">
<input type="date"
name="date"
class="form-control"
required>
</div>

<div class="col-md-6 mb-3">
<input type="time"
name="time"
class="form-control"
required>
</div>

<div class="col-12 mb-3">
<textarea
name="message"
class="form-control"
rows="4"
placeholder="Special Request"></textarea>
</div>

<div class="col-12">
<button type="submit"
name="submit"
class="btn btn-primary">
Book Table
</button>
</div>

</div>

</form>

</div>

<?php include("includes/footer.php"); ?>