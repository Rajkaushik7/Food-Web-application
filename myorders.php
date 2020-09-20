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
    <title></title>
    <title>FoodShala</title>
      <link rel="stylesheet" href="mycart.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
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
    <div class="container">
   
<table class="table">
  <caption><?php echo "Logged in as: ".$_SESSION['restuser']['restuser']?></caption>
  <thead>
    <tr>
      
      <th scope="col">Customer Name</th>
      <th scope="col">Item Ordered</th>
      <th scope="col">Quantity</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $restid=$_SESSION['restuser']['rest_Id'];
        $sql="SELECT cust_name,dish_name,num,order_time FROM menu m,orders o,customer c where m.menu_id = o.menu_id and m.rest_id= '$restid' and o.cust_id=c.cust_id";
        $result=$conn->query($sql);
        
        $total=0;
        while($row= $result->fetch_assoc())
        {  
        
    ?>
    <tr>
      
      <td><?php echo ucfirst($row['cust_name'])?></td>
      <td><?php echo $row['dish_name']?></td>
      <td><?php  echo $lt=$row['num'] ?></td>
      <td><?php  echo $lt=$row['order_time'] ?> </td>
    </tr>
        <?php }?>
  </tbody>
</table>
    </div>
    
    <footer style="position:fixed;bottom:0;display:block;width:100%;background-color:black;color:white" class="page-footer font-small dark">

      
      <div class="footer-copyright text-center py-3">@ Developed by:
        <a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSGKZZzmFqnsdwsSNVWmLQxkbkkZMhCbWqMbGTBLQtQqNCmppDFDbWgzHrmwtQjtFmQJjXnC"><em>Raj Kaushik</em></a>
      </div>
    
    
    </footer>
</body>
</html>
