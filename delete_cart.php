<?php
    require 'db_connection.php';
    session_start();

    if(isset($_SESSION['custuser']))
    {
        if(isset($_POST['submit']))
        {
            $cartid=$_POST['cart_id'];
            $sql="DELETE FROM cart where kart_id = '$cartid'";
            $conn->query($sql);

            header('location:mycart.php');
            exit();
        }
    }

    header('location:customer_login.php');

?>