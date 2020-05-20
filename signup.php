<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width:device-width,initial-scale=1"> 
  <link rel="stylesheet" type="text/css" href="signup.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #00ccfe">
  <div>
  <?php
  session_start();
  include 'conn.php';
  $userError=$emailError=$rollError=$yss12Error=$pwdError=$re_pwdError="";
  $password=$re_password=$username=$email= $roll_no=$YSS12="";
  if(isset($_POST['submit']))
  {

    if(strlen($_POST['uname'])>2)
    {
       $username=$_POST['uname'];
       $count+=1;
    }
    else
    {
      $userError=" *more than 2 character";
    }
    
    if(preg_match('[gmail.com]', $_POST['email']))
    {
      $email=$_POST['email'];
      $count+=1;
    }
    else
    {
      $emailError=" *Enter Write Mail";
    }

     if(strlen($_POST['pwd'])>2)
    {
      $password=$_POST['pwd'];
      $count+=1;
    }
    else
    {
      $pwdError=" *must be greater than 2 character";
    }

    if(strlen($_POST['r_pwd'])>2)
    {
      $re_password=$_POST['r_pwd'];
      $count+=1;
    }
    else
    {
      $re_pwdError=" *must be greater than 2 character";
    }

    if(is_numeric($_POST['roll_no']) && strlen($_POST['roll_no'])==3)
    {
     $roll_no=$_POST['roll_no'];
     $count+=1;
    }
    else
    {
      $rollError=" *Enter correct roll No";
    }

    if(strtoupper($_POST['yss12'])=='YSS1' || strtoupper($_POST['yss12'])=='YSS2' || strtoupper($_POST['yss12'])==000)
    {
    $YSS12=strtoupper($_POST['yss12']);
    $count+=1;
    }
    else
    {
      $yss12Error=" *correct it";
    }
    $flag=0;



       if(!empty($username) && !empty($password) && !empty($re_password) && !empty($email) && !empty($roll_no) && !empty($YSS12))
       {
        if($password==$re_password)
        {
          $sql_check="SELECT roll_no from register";
          $result_check = mysqli_query($conn, $sql_check);
          while($row_check = mysqli_fetch_assoc($result_check))
          {
            if($row_check['roll_no']==$roll_no)
            {
              $flag=1;
            }
          }
          if($count==6)
          {
           if($flag!=1)
           {
               $sql="INSERT INTO register(username,email,password,roll_no,YSS12) values('$username','$email',
               '$password','$roll_no','$YSS12')";    
      
                     if(mysqli_query($conn,$sql))
                     {
                       header('location:index.php');
                     }
             }
             else
             {
                $userError=" *alredy exists";
           }
          }
        }
        else
        {
          $re_pwdError="Enter the correct password";
        }
       }
    }
  ?>
  </div>
<div class="container">
  <div class="header">
  <h2 align="center" style="border-color: white;">YSS-REGISTER</h2>
  </div>
  <div class="form1">
  <form class="form-horizontal" action="signup.php" method="post" >
    <div class="form-group">
     <div class="col-xs-10">
      <label for="uname">Username</label><b><?php echo $userError; ?></b>        
      <input type="text" class="form-control" id="uname"  name="uname" value="<?php echo $username;?>" autofocus required>
     </div>
    </div>
    <div class="form-group">
      <div class="col-xs-10">
      <label for="email">Email:</label><b><?php echo $emailError; ?></b> 
      <input type="email" class="form-control" id="email" name="email" required value="<?php echo $email;?>">
      </div>
    </div>
    <div class="form-group">
     <div class="col-xs-10">
      <label for="pwd">Password:</label><b><?php echo $pwdError; ?></b>        
      <input type="password" class="form-control" id="pwd" name="pwd" required value="<?php echo $password;?>">
     </div>
    </div>
    <div class="form-group">
     <div class="col-xs-10"">
      <label for="r_pwd">Confirm Password:</label><b><?php echo $re_pwdError; ?></b>         
      <input type="password" class="form-control" id="r_pwd"  name="r_pwd" required value="<?php echo $re_password;?>">
     </div>
    </div>
    <div class="form-group">
     <div class="col-xs-10">
      <label for="roll_no">Enter Roll No:</label> <b><?php echo $rollError; ?></b>         
      <input type="text" class="form-control" id="roll_no"  name="roll_no"  required value="<?php echo $roll_no;?>">
     </div>
    </div>
    <div class="form-group">
     <div class="col-xs-10">
      <label for="yss12">YSS1/YSS2:</label><b><?php echo $yss12Error; ?></b>       
      <input type="text" class="form-control" id="yss12"  name="yss12" value="<?php echo $YSS12;?>">
     </div>
    </div>
    <div class="form-group">        
      <div class="col-xs-10">
        <button type="submit" class="btn btn-primary btn-block mt-lg-4"  style="background-color: #ff4444;" name="submit">SignUp</button>
        <p>alredy have an account?<a href="index.php">Login</a></p>
      </div>
    </div>
  </form>
</div>
</div>

</body>
</html>