<!-- <?php

?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
   
    <!-- <link rel="stylesheet" href="login.css"> -->
    <style type="text/css">
            body{
                background-color: #00ccfe;
            }
            b{
                color: red;
            }
            .title_pag{
                font-size: 3.2rem;
                font-family: sans-serif;
            }
            
            .form_login{
                margin-top: 15%;
                position: absolute;
                display: block;
                left: 50%;
                right: 50%;
                transform: translate(-50%,-50%);
            }
            
            input,button{
                outline: none;
            }
            label,.a_link {
                font-size: 1.2rem;
            }
            
            @media only screen and (max-width: 800px){
                .form_login {
                    margin-top: 25%;
                }
            } 
            
            @media only screen and (max-width: 424px) {
                .form_login {
                    margin-top: 35% !important;
                }
            }
            
            @media only screen and (max-width: 320px) {
                .form_login {
                    margin-top: 50% !important;
                }
                button{
                    margin-top: 10% !important;
                }
                .a_link{
                    margin-top: 5% !important;
                }
            }
    </style>
    <title>Login</title>
</head>
<body>
<div>
    <?php
     session_start();
  include 'conn.php';

  $loginErr="";
  if(isset($_POST['submit']))
  {
    $email=$_POST['email'];
    $password=$_POST['pwd'];

   $sql=" SELECT * FROM register";
   $result=mysqli_query($conn,$sql);

     if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {
        if($row['email']==$email && $row['password']==$password)
        {
          if($email=='admin@gmail.com')
          {
            $_SESSION['email']=$email;
            header('location:yss_report.php');
            exit();
          }
          else
          {
            $_SESSION['user']=$row['username'];
            $_SESSION['rollNo']=$row['roll_no'];
            $_SESSION['yss']=$row['YSS12'];
            header('location:form.php');
            exit();
          }
        }
        else
        {
            $loginErr="*Email or Password is wrong";
        }
    }
   }
  }
   
    ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="title_pag mt-lg-5 col-md-12 col-xs-12">
                <center><span>YSS login</span></center>
            </div>
            <div class="row container">
                <div class="form_login col-lg-4 col-md-8 col-sm-12 col-xs-12">
                    <form action="index.php" method="post">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password</label>
                            <input type="password" class="form-control" name="pwd" required>
                        </div>
                        <div><b><?php echo $loginErr; ?></b></div>
                        <button type="submit" class="btn btn-primary btn-block mt-lg-4"  name="submit">Login</button>
                        <p class="mt-lg-3 text-center a_link">Not have an account yet? <a href="signup.php">Signup</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>   
</body>
</html>