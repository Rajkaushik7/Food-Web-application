<?php
  
  require 'db_connection.php';
  session_start();
  if(isset($_SESSION['custuser']))
  {
    header('location:customer_dashboard.php');
    exit();
  }
  $email=$pass="";
     if(isset($_POST['submit'])){
        echo"logging...";
        $email=$_POST['email'];
        $pass=md5($_POST['pass']);
        $sql="SELECT * FROM customer WHERE cust_email = '$email' and cust_pass = '$pass'";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
      
        if($result->num_rows>0)
            {   
                
                $_SESSION['custuser']=$row;
                header('location:customer_dashboard.php');
                exit();

                
            }
        else    
        {
            $_SESSION['logged']=FALSE;
        }

       

    }

  
?>
<html>
    <head>
        <title>FoodShala</title>
        <link rel="stylesheet" href="register.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
<body>
    <div class="cver">
        <nav  class="navbar navbar-expand-md navbar-dark">
            <a class="navbar-brand" href="#">Food Shala</a>
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
                   
                
              </ul>
            </div>  
          </nav>

        <?php
          if(isset($_SESSION['logged']))
            {
         

                 if( $_SESSION['logged']==false)
                {   $_SESSION['logged']=null;
                  ?>
                  <div class="alert alert-danger" role="alert">
                   Invalid Username and Password.
                  </div>
                  <?php
            }
          }
            ?>
          <div class="myform">
           <h3>Customer Login</h3>
            <form action="customer_login.php" method="POST" >
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputEmail4">Email</label>
                  <input required name="email"   type="text" class="form-control" id="inputEmail4"   >
                </div>
                </div>
                <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputPassword4">Password</label>
                  <input required  name="pass"  type="password" class="form-control" id="inputPassword4" >
                </div>
                
              </div>
              <div class="form-group">
                <div class="form-check">
                  <input checked required class="form-check-input" type="checkbox" id="gridCheck">
                  <label class="form-check-label" for="gridCheck">
                    Agree to the <a href="#">terms and Conditions.</a>
                  </label>
                </div>
              </div>
              <button type="submit" name="submit" class="btn btn-primary">Log In</button>
              <a class="btn btn-secondary" href="customer_register.php">Sign Up</a>
             
            </form>
          </div>
          
    <footer style="position:fixed;bottom:0;display:block;width:100%;background-color:black;color:white" class="page-footer font-small dark">

      
<div class="footer-copyright text-center py-3">@ Developed by:
  <a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSGKZZzmFqnsdwsSNVWmLQxkbkkZMhCbWqMbGTBLQtQqNCmppDFDbWgzHrmwtQjtFmQJjXnC"><em>Raj Kaushik</em></a>
</div>


</footer>
</body>
</html>