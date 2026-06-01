<?php

session_start();
include("config/db.php");

$name = $_POST['name'];
$phone = $_POST['phone'];

$total = 0;

if(isset($_SESSION['cart']))
{
    foreach($_SESSION['cart'] as $id=>$qty)
    {
        $query = mysqli_query(
        $conn,
        "SELECT * FROM menu_items WHERE id='$id'"
        );

        $food = mysqli_fetch_assoc($query);

        $total += ($food['price'] * $qty);
    }
}

mysqli_query(
$conn,
"INSERT INTO orders
(customer_name,phone,address,total_amount,status)
VALUES
('$name','$phone','WhatsApp Order','$total','Pending')"
);

$_SESSION['cart'] = [];

echo "success";

?>