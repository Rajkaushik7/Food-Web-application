<?php
require 'db_connection.php';
session_start();
    if(!isset($_SESSION['custuser']))
    {
        header('location:customer_login.php');
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
                  <a class="nav-link" href="customer_dashboard.php">Dashboard</a>
                </li>
              </ul>
            </div>  
          </nav>
    <div class="container">

    <?php
               
               if(isset($_SESSION['placed']))
               {     if($_SESSION['placed']==false)
                 ?>
                 <div class="alert alert-success" role="alert">
                  Your order have been placed Successfully. <a href="menu.php">Continue Ordering</a>
                 </div>
                 <?php
           };
           unset($_SESSION['placed']);
         
           ?>
   
<table class="table">
  <caption><?php echo "Logged in as: ".$_SESSION['custuser']['cust_name']?></caption>
  <thead>
    <tr>
      
      <th scope="col">Item Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Amount</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php
        $custid=$_SESSION['custuser']['cust_id'];
        $sql="SELECT * FROM menu m,cart c where m.menu_id = c.menu_id and c.cust_id= '$custid'";
        $result=$conn->query($sql);
        $total=0;
        while($row= $result->fetch_assoc())
        {  
        
    ?>
    <tr>
      
      <td><?php echo ucfirst($row['dish_name'])?></td>
      <td><?php echo $row['num']?></td>
      <td><?php  $lt=$row['num']*$row['price']; echo $lt;  $total+=$lt; ?></td>
      <td><form action="delete_cart.php" method="POST">
            <input type="hidden" value=<?php echo $row['kart_id'] ?> name="cart_id" />
            <input type="submit" name="submit" value="Remove" class="btn btn-danger"/>
            </form>
        </td>
    </tr>
    <tr>
        <?php };?>
      <td>TOTAL</td>
      <td></td>
      <td><?php echo $total?></td>
      <td><form action="checkout.php" method="POST">
          <div class="form-row">
            <div class="form-group col-md-6">
            <input type="text" placeholder="Delivery Address" required/>
        </div>
        <div class="form-group col-md-4">
            <input <?php echo ($total==0)?"Disabled":"";?> type="submit" name="submit" value="Checkout" class="btn btn-primary"/>
        </div>
        </div>  
          </form>
        </td>
    </tr>
  </tbody>
</table>
    </div>
    
    <footer style="background-color:black;color:white" class="page-footer font-small dark">

      
      <div class="footer-copyright text-center py-3">@ Developed by:
        <a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSGKZZzmFqnsdwsSNVWmLQxkbkkZMhCbWqMbGTBLQtQqNCmppDFDbWgzHrmwtQjtFmQJjXnC"><em>Raj Kaushik</em></a>
      </div>
    
    
    </footer>
</body>
</html>
