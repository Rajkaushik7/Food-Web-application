<?php
    require 'db_connection.php';
    session_start();
    if(isset($_SESSION['custuser']))
    {   
        if(isset($_POST['submit'])){
            echo "Adding it to cart";
            $menuid=$_POST['menu_id'];
            $custid=$_SESSION['custuser']['cust_id'];
            $sql="SELECT * FROM cart where cust_id = '$custid' and menu_id = '$menuid'";
            $res=$conn->query($sql);
           
            if($res->num_rows==0)
            {$sql="INSERT INTO cart (cust_id,menu_id,num) values ('$custid','$menuid','1')";
            echo $conn->query($sql);
            }
            else{
                $menuid=$_POST['menu_id'];
                $custid=$_SESSION['custuser']['cust_id'];
                $res=$res->fetch_assoc();
                $cnt=$res['num']+1;
                $sql="UPDATE cart SET num ='$cnt' where cust_id = '$custid' and menu_id = '$menuid'";
                $conn->query($sql);
                
            }
        }

    }
        if(isset($_SESSION['menu']))
        {   unset($_SESSION['menu']);
            header('location:menu.php');
            exit();
        }
    header('location:customer_dashboard.php');

?>