<?php
  
  require 'db_connection.php';
  session_start();
  $price=$name=$desc=$category="";  
  if(isset($_SESSION['restuser']))
  {
        if(isset($_POST['submit']))
        {   
           
            $time=htmlspecialchars(date("d-m-y-h-i-s-ms"));
            $price=htmlspecialchars($_POST['price']);
            $name=htmlspecialchars($_POST['name']);
            $category=isset($_POST['veg'])?"veg":"non-veg";
            $desc=htmlspecialchars($_POST['desc']);
            $restid=htmlspecialchars($_SESSION['restuser']['rest_Id']);
            $sql="INSERT INTO menu (dish_name,detail,price,category,rest_id,timest) values ('$name','$desc','$price','$category','$restid','$time')";
            $conn->query($sql);
            $path="uploads/".$_SESSION['restuser']['rest_Id'].$time.".jpg";
            $curloc=$_FILES['image']['tmp_name'];
            move_uploaded_file($curloc,$path);
            header('location:restaurant_dashboard.php');
        
        }
    }
  else
  {
      header('location:restaurant_login.php');
  }
  
?>
<html>
    <head>
        <title>FoodShala</title>
        <link rel="stylesheet" href="additem.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body class="additembody">
    <nav  class="navbar navbar-expand-md navbar-dark">
            <a class="navbar-brand" href="/foodshala">Food Shala</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon"></span>
            </button>
        <div  style="background:none;float:right;" class="collapse navbar-collapse" id="collapsibleNavbar">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="/foodshala">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="menu.php">Menu</a>
                </li> 
                <li class="nav-item">
                  <a class="nav-link" href="restaurant_dashboard.php">Dashboard</a>
                </li>
              </ul>
            </div>  
          </nav>
    <div class="cver">
       
          <div class="myform">
           
            <form action="additem.php" method="POST" enctype="multipart/form-data" >
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Name of Item</label>
                  <input required name="name" maxlength="25"  type="text" class="form-control" id="inputEmail4"   >
                </div>
                <div class="form-group col-md-3">
                  <label for="inputPassword4">Veg</label>
                  <input  name="veg" type="checkbox" class="form-control" id="inputPassword4"   >
                </div>
                <div class="form-group col-md-3">
                <label for="inputPassword4">Non-Veg</label>
                  <input  name="non-veg" value="non-veg" type="checkbox" class="form-control" id="inputPassword4"   >

            </div>
                </div>

                <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Price ($)</label>
                  <input required  name="price"  maxlength="5" type="number" class="form-control" id="inputPassword4" >
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Image of Dish</label>
                  <input style="padding:3px;" required name="image"  type="file" class="form-control" id="inputPassword4" >
                </div>
              </div>             
              
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputCity">Description</label>
                  <input required name="desc"  maxlength="150" type="textarea" class="form-control" id="inputCity">
                </div>
             
              </div>
              <button type="submit" name="submit" class="btn btn-primary">Add Item</button>
             
            </form>
          </div>
          
    <footer style="background-color:black;color:white" class="page-footer font-small dark">

      
<div class="footer-copyright text-center py-3">@ Developed by:
  <a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSGKZZzmFqnsdwsSNVWmLQxkbkkZMhCbWqMbGTBLQtQqNCmppDFDbWgzHrmwtQjtFmQJjXnC"><em>Raj Kaushik</em></a>
</div>


</footer>
</body>
</html>