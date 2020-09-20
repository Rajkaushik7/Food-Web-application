<?php
    require 'db_connection.php';
    session_start();
    if(isset($_SESSION['restuser'])){
    if(isset($_POST['submit']))
    {   echo "Deleting......\n";
        $id=$_POST['id'];

        $sql="DELETE FROM menu WHERE menu_id = '$id'";
       
        if($conn->query($sql))
        {
            echo "Item Deleted Successfully";
            header('location:restaurant_dashboard.php');
        }
        else
            {
                echo "Couldn't Delete Item, Try again later";
            }

    }
}
?>