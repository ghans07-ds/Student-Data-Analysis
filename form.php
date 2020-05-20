
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
  <meta name="viewport" content="width:device-width,initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="form.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style type="text/css">
    b{
      color: red;
    }
  </style>
</head>
<body>
  <div>
  <?php
  session_start();
  if(!isset($_SESSION['user']))
  {
    header('location:index.php');
  }
  $userError= $userSuccess="";
  include 'conn.php';
  $date1=date('Y-m-d');
  date_default_timezone_set("Asia/Kolkata");
  $date_check=date("H:i:s");
  $roll_no=$_SESSION['rollNo'];
  if(isset($_POST['submit']))
  {   
      if($date_check>"20:00:00" && $date_check<"23:59:59")
      {
        $sabha=$_POST['sabha'];
        $vachan=$_POST['vachan'];
        $pranam=$_POST['pranam'];
        $slok=$_POST['slok'];
        $sevak=$_POST['sevak'];
        $arti=$_POST['arti'];
        $flag=0;
        
        $sql_check="SELECT date1,roll_no from report";
        $result_check=mysqli_query($conn,$sql_check);
       
        while($row_check=mysqli_fetch_assoc($result_check))
        {
          if($row_check['date1']==$date1 && $row_check['roll_no']==$roll_no)
          {
           $flag=1;
           break;
          } 
        }

       if($flag!=1)
       {
        $yss=$_SESSION['yss'];

        $sql="INSERT INTO report(date1,sabha,vachan,pranam,slok,sevak,arti,roll_no,YSS) values('$date1','$sabha','$vachan','$pranam','$slok','$sevak','$arti','$roll_no','$yss')";


        if(mysqli_query($conn,$sql))
        {
        $userSuccess="Successful!";
        }
        else
        {
          $userSuccess="try again!";
        }
      }
      else
      {
        $userError="already filled";
      }

    }
    else
    {
      $userError="only in 8 to 12 pm";
    }
  }
 
  
  ?>
  </div>
  
  
  <!-- <div class="photo">
    <img src="C:/Users/Galaxy/Desktop/baps.jpg" class="col-xs-10" >  
  </div> -->
  
  <form class="form-horizaontal" method="post" action="form.php">
    <div class="form-group col-xs-10">
     <div class="col-xs-8">
        <h3>YSS</h3> 
     </div>
     <div class="col-xs-2" style="margin-top: 17px;">
      <a href="logout.php" class="btn btn-danger">logout</a>
    </div>
    </div>  
    
    <div class="form-group">
      <div class="col-xs-10">
       <h4><?php echo $_SESSION['user']; ?></h4><b><?php echo $userError; ?></b>
      <b><?php echo $userSuccess; ?></b>
      </div>
    </div>
    <div class="form-group">
      <div class="col-xs-10">
        <h4>1.Yuvak Sabha</h4>
        <input type="radio" name="sabha" value="YES" required>
        <label for="sabha">YES</label><br>
        <input type="radio" name="sabha" value="NO" required>
        <label for="sabha">NO</label><br>  
      </div>
    </div>
    <div class="form-group">
      <div class="col-xs-10">
        <h4>2.Vachanamrut and Swamini vato</h4>
        <input type="radio" name="vachan" value="YES" required>
        <label for="vachan">YES</label><br>
        <input type="radio" name="vachan" value="NO" required>
        <label for="vachan">NO</label><br>  
      </div>
    </div>
    <div class="form-group">
      <div class="col-xs-10">
        <h4>3.Panchang Pranam</h4>
        <input type="radio" name="pranam" value="YES" required>
        <label for="pranam">YES</label><br>
        <input type="radio" name="pranam" value="NO"  required>
        <label for="pranam">NO</label><br>  
      </div>
    </div>
    <div class="form-group">
      <div class="col-xs-10">
        <h4>4.Bhojan Slok</h4>
        <input type="radio" name="slok" value="YES"  required>
        <label for="slok">YES</label><br>
        <input type="radio" name="slok" value="NO"  required>
        <label for="slok">NO</label><br>  
      </div>
    </div>
    <div class="form-group">
      <div class="col-xs-10">
        <h4>5.Ghar ma Swayam Sevak</h4>
        <input type="radio" name="sevak" value="YES"  required>
        <label for="sevak">YES</label><br>
        <input type="radio" name="sevak" value="NO"  required>
        <label for="sevak">NO</label><br>  
      </div>
    </div>
    <div class="form-group">
      <div class="col-xs-10">
        <h4>6.Arti</h4>
        <input type="radio" name="arti" value="Morning"  required>
        <label for="arti">Morning</label><br>
        <input type="radio" name="arti" value="Morning"  required>
        <label for="arti">Evening</label><br>
        <input type="radio" name="arti" value="Both"  required>
        <label for="arti">Both</label><br>
        <input type="radio" name="arti" value="None"  required>
        <label for="arti">None</label><br>  
      </div>
    </div>
    <div>
      <input type="submit" name="submit" value="SUBMIT" class="btn btn_sub col-xs-10" style="
      background-color: #f32013; border-color: none; color: #fff;
      font-weight: 900;font-size: 1.2em;">
    </div>
  </form>
</body>
</html>
