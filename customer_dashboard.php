<?php
   require 'db_connection.php';
   session_start();
       if(!isset($_SESSION['custuser']))
       {
               header('location:customer_login.php');
   
       }     
   
     unset($_SESSION['menu']);
   
   ?>
<html>
   <head>
      <title>FoodShala</title>
      <link rel="stylesheet" href="customer_dashboard.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
   <body>
      <div class="cover">
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
                     <a class="nav-link" href="mycart.php">Cart</a>
                  </li>
                  <li style="width:auto" class="nav-item">
                     <a class="nav-link" href="logout.php">Log out</a>
                  </li>
               </ul>
            </div>
         </nav>
         <div class="title">
            <h1 style="font-style:italic;">Welcome, <?php echo ucfirst($_SESSION['custuser']['cust_name'])?></h1>
            <p style="font-style:italic;">Get your food delivered in minutes.</p>
         </div>
      </div>
      <h3 class="h3"><a href="mycart.php" class="btn btn-primary">MY Cart</a> </h3>

      <div class="custmenu">Discover your taste and order now!</div>
      <div class="container">
         <?php 
            $fav=$_SESSION['custuser']['fav'];
            if($fav=="veg")
            $sql="SELECT * FROM menu m,restaurant r where r.rest_Id = m.rest_id and m.category = 'veg'";
            else
            $sql="SELECT * FROM menu m,restaurant r where r.rest_Id = m.rest_id";
            $result=$conn->query($sql);
            
            while($row = $result->fetch_assoc())
            { ?>
         <span class="foodcard">
            <div class="dishname"><strong><?php echo ucfirst($row['dish_name'])?></strong></div>
            <div class="foodimg">
                <img height="250px" width="250px" src=<?php echo "\"uploads/".$row['rest_Id'].$row['timest'].".jpg\""; ?> />
            </div>
            <div class="descrip">
               <p><?php echo ucfirst($row['detail'])?></p>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <p class="from"><i class="fa fa-map-marker" style="font-size:12px"><?php echo " ".ucfirst($row['restuser']).",".ucfirst($row['city'])   ?></i></p>
               </div>
               <div class="col-md-6">
                  <p class="amount"><?php echo "$".($row['price'])?></p>
               </div>
            </div>
            <div class="add">
               <form action="cart.php" method="POST">
                  <input type="hidden" name="menu_id" value=<?php echo ($row['menu_id']) ?> />
                  <input class="add" name="submit" type="submit" value="Add to Cart"/>
               </form>
            </div>
            </span>
            <?php };?>
      </div>
      
    <footer style="background-color:black;color:white" class="page-footer font-small dark">

      
<div class="footer-copyright text-center py-3">@ Developed by:
  <a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSGKZZzmFqnsdwsSNVWmLQxkbkkZMhCbWqMbGTBLQtQqNCmppDFDbWgzHrmwtQjtFmQJjXnC"><em>Raj Kaushik</em></a>
</div>


</footer>
   </body>
</html>