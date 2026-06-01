<?php

session_start();
include("config/db.php");
include("includes/header.php");

$total = 0;

?>

<div class="container py-5">

<h2>Your Cart</h2>

<table class="table table-bordered">

<tr>
<th>Food</th>
<th>Price</th>
<th>Qty</th>
<th>Total</th>
<th>Action</th>
</tr>

<?php

$message = "";

if(isset($_SESSION['cart']))
{
    foreach($_SESSION['cart'] as $id=>$qty)
    {
        $query = mysqli_query(
        $conn,
        "SELECT * FROM menu_items WHERE id='$id'"
        );

        $row = mysqli_fetch_assoc($query);

        $subtotal = $row['price'] * $qty;

        $total += $subtotal;

        $message .= $row['food_name'] .
        " x " .
        $qty .
        "%0A";

?>

<tr>

<td><?php echo $row['food_name']; ?></td>

<td>₹<?php echo $row['price']; ?></td>

<td><?php echo $qty; ?></td>

<td>₹<?php echo $subtotal; ?></td>

<td>

<a href="remove_from_cart.php?id=<?php echo $id; ?>"
class="btn btn-danger btn-sm">
Remove
</a>

</td>

</tr>

<?php
    }
}
?>

</table>

<h4>Total: ₹<?php echo $total; ?></h4>

<hr>

<form>

<input
type="text"
id="customer_name"
class="form-control mb-3"
placeholder="Your Name">

<input
type="text"
id="customer_phone"
class="form-control mb-3"
placeholder="Phone Number">

<button
type="button"
class="btn btn-success"
onclick="sendWhatsApp()">

Order on WhatsApp

</button>

</form>

</div>

<script>

function sendWhatsApp()
{
    let name =
    document.getElementById("customer_name").value;

    let phone =
    document.getElementById("customer_phone").value;

    let text =
`R V Cafe Order

Name: ${name}
Phone: ${phone}

Items:

<?php echo $message; ?>

Total: ₹<?php echo $total; ?>
`;

    let url =
    "https://wa.me/916306055270?text="
    + encodeURIComponent(text);

    fetch('save_order.php',{
method:'POST',
headers:{
'Content-Type':'application/x-www-form-urlencoded'
},
body:
'name='+encodeURIComponent(name)+
'&phone='+encodeURIComponent(phone)
})
.then(()=>{
window.open(url,'_blank');
});
}

</script>

<?php include("includes/footer.php"); ?>