<?php

    require 'db_connection.php';
    session_start();
    ?>
<html>
   <head>
      <title>FoodShala</title>
      <link rel="stylesheet" href="menu.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   </head>
   <body>
      
   <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/foodshala">FoodShala</a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="/foodshala">Home</a></li>
     
    </ul>
    <ul class="nav navbar-nav">
      <li class="active"><a href="menu.php">Menu</a></li>
     
    </ul>
    <?php
         if(isset($_SESSION['custuser']))
         {  $_SESSION['menu']=true; ?>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="mycart.php"><span class="glyphicon glyphicon-shopping-cart"></span>Cart</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
      <li><a href="customer_dashboard.php"><span class="glyphicon glyphicon-user"></span>Dashboard</a></li>
</ul>
<ul>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> LogOut</a></li>
    </ul>
         <?php }?>
  </div>
</nav>   
        
      
      <div class="custmenu"> 
 
         Discover your taste and order now!</div>
     
      <div class="container">
         <?php 
           
            $sql="SELECT * FROM menu m,restaurant r where m.rest_Id=r.rest_id";
            $result=$conn->query($sql);
            
            while($row = $result->fetch_assoc())
            { ?>
         <span class="foodcard">
            <div class="dishname"><strong><?php echo ucfirst($row['dish_name'])?></strong></div>
            <div class="foodimg">
                <img height="250px" width="250px" src=<?php echo "\"uploads/".$row['rest_id'].$row['timest'].".jpg\""; ?> />
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