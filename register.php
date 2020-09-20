<?php
  
  require 'db_connection.php';
  $email=$name=$pass=$city="";
  
  if(isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['name'])
      && isset($_POST['cpass']) && isset($_POST['city']))
      {   $email=htmlspecialchars($_POST['email']);
          $name=htmlspecialchars($_POST['name']);
          $pass=$_POST['pass'];
          $cpass=$_POST['cpass'];
          $city=htmlspecialchars($_POST['city']);
          
          if(!(strlen($name)>0 && strlen($pass)>=6 && strlen($city)>0))
          {
            $_SESSION['wrong']=true;
          }
          else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email))
          {
              $_SESSION['inemail']=true;
          }
          else if($cpass!=$pass)
          {
            $_SESSION['badmatch']=true;
            
          }
          else{
            $pass=md5($pass);
          $sql="SELECT * FROM restaurant where email = '$email'";
          $res=$conn->query($sql)->num_rows;
            if($res==0)
            {$sql="INSERT INTO restaurant (restuser,email,pass,city) values ('$name','$email','$pass','$city')";
            echo $conn->query($sql);
            $_SESSION['registered']=true;
            }
            else{
              $_SESSION['registered']=false;
                          }
    }
  }else if(isset($_POST['submit']))
  {
    $_SESSION['wrong']=true;
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
                
              </ul>
            </div>  
          </nav>

        <?php
        if(isset($_SESSION['wrong']))
        { if($_SESSION['wrong']==true){
          ?>
                    <div class="alert alert-danger" role="alert">
                    Something went wrong.
                    </div>

          <?php
          unset( $_SESSION['wrong']);
        }
      }
        if(isset($_SESSION['inemail']))
        { if($_SESSION['inemail']==true){
          ?>
                    <div class="alert alert-danger" role="alert">
                    Invalid Email.
                    </div>

          <?php
          unset( $_SESSION['inemail']);
        }
      }
        if(isset($_SESSION['badmatch']))
        { if($_SESSION['badmatch']==true){
          ?>
                    <div class="alert alert-danger" role="alert">
                    Password not matching.
                    </div>

          <?php
          unset( $_SESSION['badmatch']);
        }
      }
          if(isset($_SESSION['registered']))
            { if($_SESSION['registered']==true){
              ?>
                        <div class="alert alert-primary" role="alert">
                        Successfully Registered.<a href="restaurant_login.php" >Login to continue.</a>
                        </div>

              <?php
              
            }
                else if( $_SESSION['registered']==false)
                {
                  ?>
                  <div class="alert alert-danger" role="alert">
                   User already exists. Try with different credentials.
                  </div>
                  <?php
            }
            }
            ?>
          <div class="myform">
           <H4> Restaurant Registration</h4>
            <form action="register.php" method="POST" class="restRegister">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Name of Restaurant</label>
                  <input required name="name"  maxlength="20" type="text" class="form-control" id="inputEmail4"   value=<?php echo $name ?>>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Official Email</label>
                  <input required name="email" type="email" class="form-control" id="inputPassword4"  value=<?php echo $email ?> >
                </div>
</div>
                <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Password</label>
                  <input required  name="pass"  type="password" minlength="8" class="form-control" id="inputPassword4" >
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Confirm Password</label>
                  <input required name="cpass"  type="password" minlength="8" class="form-control" id="inputPassword4" >
                </div>
              </div>

              
              
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputCity">City</label>
                  <input required name="city"  type="text" class="form-control" id="inputCity" value=<?php echo $city ?>>
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
              <button type="submit" name='submit' class="btn btn-primary">Sign Up</button>
              <a class="btn btn-secondary" href="restaurant_login.php">Log In</a>
            </form>
           
          </div>
  
          <footer style="position:fixed;bottom:0;display:block;width:100%;background-color:black;color:white" class="page-footer font-small dark">

      
<div class="footer-copyright text-center py-3">@ Developed by:
  <a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSGKZZzmFqnsdwsSNVWmLQxkbkkZMhCbWqMbGTBLQtQqNCmppDFDbWgzHrmwtQjtFmQJjXnC"><em>Raj Kaushik</em></a>
</div>


</footer>
</body>
</html>