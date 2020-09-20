<?php
   require 'db_connection.php';
   session_start();
       if(!isset($_SESSION['restuser']))
       {
               header('location:restaurant_login.php');
   
       }     
   
      
   
   ?>
<html>
   <head>
      <title>FoodShala</title>
      <link rel="stylesheet" href="rest.css">
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
                     <a class="nav-link" href="myorders.php">Orders</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="additem.php">Add Item</a>
                  </li>
                  <li style="width:auto" class="nav-item">
                     <a class="nav-link" href="logout.php">Log out</a>
                  </li>
               </ul>
            </div>
         </nav>
         <div class="title">
            <h1 style="font-style:italic;">Welcome, <?php echo $_SESSION['restuser']['restuser']?></h1>
            <p style="font-style:italic;">Serve your best food & beverages.</p>
         </div>
      </div>
      <h3 class="h3">Our Menu   <a href="additem.php" class="btn btn-primary">Add Item</a> <a class="btn btn-primary" href="myorders.php">View Orders</a></h3>
      <div class="container">
         <?php 
            $restid=$_SESSION['restuser']['rest_Id'];
            $sql="SELECT distinct * FROM menu r,restaurant m where r.rest_id = m.rest_Id and m.rest_ID = '$restid'";
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
                  <p class="from"><i class="fa fa-map-marker" style="font-size:24px"></i><?php echo $row['restuser']?></p>
               </div>
               <div class="col-md-6">
                  <p class="amount"><?php echo "$".($row['price'])?></p>
               </div>
            </div>
            <div class="add">
               <form action="delete_item.php" method="POST">
                  <input type="hidden" name="id" value=<?php echo ($row['menu_id']) ?> />
                  <input class="add" name="submit" type="submit" value="DELETE"/>
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