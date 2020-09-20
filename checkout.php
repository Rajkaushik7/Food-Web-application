<?php
    require 'db_connection.php';
    session_start();

    if(!isset($_SESSION['custuser']))
    {
        header('location:customer_login.php');
    }
    else
    {
        if(isset($_POST['submit']))
        {
            $custid=$_SESSION['custuser']['cust_id'];
            
            $sql="SELECT * from cart where cust_id = '$custid'";
            $res=$conn->query($sql);
            while($row= $res->fetch_assoc())
            {   $menu=$row['menu_id'];
                $num=$row['num'];
              
            $sql="INSERT INTO orders (cust_id,menu_id,num) VALUES ('$custid','$menu','$num')";
            $conn->query($sql);

            }
            $sql="DELETE from cart where cust_id = '$custid'";
            $conn->query($sql);
            $_SESSION['placed']=true;
            header('location:mycart.php');

        }
    }

?>
