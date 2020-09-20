<?php

    session_start();    
    if(isset($_SESSION['restuser']))
    {   session_destroy();
    header('location:restaurant_login.php');
    }
    if(isset($_SESSION['custuser']))
    {   session_destroy();
    header('location:customer_login.php');
    }

?>