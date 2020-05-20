
<?php
         session_start();
        if(!isset($_SESSION['email']))
         {
           header('location:index.php');
         }
         include 'conn.php';
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
    <style type="text/css">
       body {
       position: relative; 
            }  
  

      #section0 {padding-top:50px;height:625px;color: #fff; background-color: #00;}
      #section1 {padding-top:50px;height:625px;color: #fff; background-color: #00;}
      #section2 {padding-top:50px;height:625px;color: #fff; background-color: #00;}
      #section3 {padding-top:50px;height:625px;color: #fff; background-color: #00;}
      #section4 {padding-top:50px;height:625px;color: #fff; background-color: #00;}
      #section5 {padding-top:50px;height:625px;color: #fff; background-color: #00;}
      #section6 {padding-top:50px;height:625px;color: #fff; background-color: #00;}
      #section7 {padding-top:50px;height:625px;color: #fff; background-color: #00;}

      #logout{
        margin-top: 7px;
        margin-left: 180px;
      }
      
      #stackchart{
          padding-top: 10px;
          padding-left: 10px; 
          padding-right: 10px;
          padding-bottom: 10px;
          /*background-color: red;*/
          margin-left: 40px;
          margin-top: 10px;
          width: 1100px;
          height: 550px;
      }
      #myNavbar ul li a:active,
      #myNavbar a:hover{
        background-color: red;
      }
      #piechart_sabha,#piechart_vachan,#piechart_arti,#piechart_slok,#piechart_sevak,#piechart_pranam{
        margin-top: 20px;
        margin-right: 20px;
        margin-left: 30px;
        width: 500px;
        height: 500px;
        background-color: skyblue;
        border-radius: 25px;
      }

      #barchart_sabha,#barchart_vachan,#barchart_arti,#barchart_slok,#barchart_sevak,#barchart_pranam{
        width: 500px;
        height: 500px;
        margin-top: 20px;
        margin-right: 20px;
      }
       #select{
        width: 550px;
        height: 550px;
        margin-top: 20px;
        margin-right: 20px;
        padding: 150px;
        padding-top: 100px;
      }
      #vis{
        margin-top: 20px;
        margin-right: 20px;
        margin-left: 50px;
        width: 550px;
        height: 550px;
      }
      #img1
      {
        width: 570px;
        height: 520px;
        padding-right: 20px;
        padding-top: 20px;
      }
      .details{
        background-color: #10CDEE;
        padding: 20px;
      }

    </style>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar','corechart']});
      google.charts.setOnLoadCallback(drawSabha);
      google.charts.setOnLoadCallback(drawVachan);
      google.charts.setOnLoadCallback(drawArti);
      google.charts.setOnLoadCallback(drawSlok);
      google.charts.setOnLoadCallback(drawSevak);
      google.charts.setOnLoadCallback(drawPranam);


      function drawSabha(){

        var data1 = google.visualization.arrayToDataTable([
          ['Sabha', 'Count'],
            <?php
              if(isset($_POST['submit'])){
                  $start =  $_POST['start'];
                  $end =  $_POST['end'];
                  $roll_no =  strtoupper($_POST['roll_no']);

                  if($roll_no == 'YSS1' || $roll_no == 'YSS2'){
                      $sql_sabha = "SELECT sabha, COUNT(sabha) as count from (SELECT * FROM report WHERE date1 BETWEEN '$start' AND '$end') as new WHERE YSS = '$roll_no' GROUP BY sabha;";

                      $result_S = mysqli_query($conn, $sql_sabha);
                      if(mysqli_num_rows($result_S) > 0){
                          while ($row = mysqli_fetch_assoc($result_S)) {
                              echo "['".$row['sabha']."',".$row['count']."],"; 
                          }
                      }
                      else{
                        header('location:yss_report.php');
                      } 
                  }
                  else{
                      $sql_sabha = "SELECT sabha, COUNT(sabha) as count from (SELECT * FROM report WHERE date1 BETWEEN '$start' AND '$end') as new WHERE roll_no = $roll_no GROUP BY sabha;";

                      $result_S = mysqli_query($conn, $sql_sabha); 
                      if(mysqli_num_rows($result_S) > 0){
                          while ($row = mysqli_fetch_assoc($result_S)) {
                              echo "['".$row['sabha']."',".$row['count']."],"; 
                          }
                      }
                      else{
                        header('location:yss_report.php');
                      } 
                  }

              }
            ?>
        ]);

         var options1 = {
          title: 'Sabha',
        };

        var options2 = {
          title: 'Sabha',
          legend: { position: 'none' },
          chart: { title: 'Sabha Performance',
                   subtitle: 'popularity by percentage' },
          bars: 'vertical', 
          axes: {
            x: {
              0: { side: 'top', label: 'Count'} 
            }
          },
          bar: { groupWidth: "10%" }

        };

         var chart1 = new google.visualization.PieChart(document.getElementById('piechart_sabha'));
         chart1.draw(data1, options1);
         var chart2 = new google.charts.Bar(document.getElementById('barchart_sabha'));
         chart2.draw(data1, options2);
      };

       function drawVachan(){

        var data1 = google.visualization.arrayToDataTable([
          ['Vachan', 'Count'],
          <?php
          if(isset($_POST['submit'])){
                  $start =  $_POST['start'];
                  $end =  $_POST['end'];
                  $roll_no =  strtoupper($_POST['roll_no']);

                  if($roll_no == 'YSS1' || $roll_no == 'YSS2'){
                      $sql_vachan = "SELECT vachan, COUNT(vachan) as count from (SELECT * FROM report WHERE date1 BETWEEN '$start' AND '$end') as new WHERE YSS = '$roll_no' GROUP BY vachan;";

                      $result_V = mysqli_query($conn, $sql_vachan);
                      if(mysqli_num_rows($result_V) > 0){
                          while ($row = mysqli_fetch_assoc($result_V)) {
                              echo "['".$row['vachan']."',".$row['count']."],"; 
                          }
                      }
                      else{
                        header('location:yss_report.php');
                      } 
                  }
                  else{
                      $sql_vachan = "SELECT vachan, COUNT(vachan) as count from (SELECT * FROM report WHERE date1 BETWEEN '$start' AND '$end') as new WHERE roll_no = '$roll_no' GROUP BY vachan;";

                      $result_V = mysqli_query($conn, $sql_vachan); 
                      if(mysqli_num_rows($result_V) > 0){
                          while ($row = mysqli_fetch_assoc($result_V)) {
                              echo "['".$row['vachan']."',".$row['count']."],"; 
                          }
                      }
                      else{
                        header('location:yss_report.php');
                      } 
                  }
            }
          ?>
        ]);

         var options1 = {
          title: 'Daily Vachanamrut Reading',
        };

        var options2 = {
          title: 'Daily Vachanamrut Reading',
          legend: { position: 'none' },
          chart: { title: 'Daily Vachanamrut Reading',
                   subtitle: 'popularity by percentage' },
          bars: 'vertical', 
          axes: {
            x: {
              0: { side: 'top', label: 'Count'} 
            }
          },
          bar: { groupWidth: "10%" }

        };

         var chart1 = new google.visualization.PieChart(document.getElementById('piechart_vachan'));
         chart1.draw(data1, options1);
         var chart2 = new google.charts.Bar(document.getElementById('barchart_vachan'));
         chart2.draw(data1, options2);
      };

      function drawArti(){

        var data1 = google.visualization.arrayToDataTable([
          ['Arti', 'Count'],
          <?php
              if(isset($_POST['submit'])){
                  $start =  $_POST['start'];
                  $end =  $_POST['end'];
                  $roll_no =  strtoupper($_POST['roll_no']);

                  if($roll_no == 'YSS1' || $roll_no == 'YSS2'){
                      $sql_arti = "SELECT arti, COUNT(arti) as count from (SELECT * FROM report WHERE date1 BETWEEN '$start' AND '$end') as new WHERE YSS = '$roll_no' GROUP BY arti;";

                      $result_A = mysqli_query($conn, $sql_arti);
                      if(mysqli_num_rows($result_A) > 0){
                          while ($row = mysqli_fetch_assoc($result_A)) {
                              echo "['".$row['arti']."',".$row['count']."],"; 
                          }
                      }
                      else{
                        header('location:yss_report.php');
                      } 
                  }
                  else{
                       $sql_arti = "SELECT arti, COUNT(arti) as count from (SELECT * FROM report WHERE date1 BETWEEN '$start' AND '$end') as new WHERE roll_no = '$roll_no' GROUP BY arti;";

                       $result_A = mysqli_query($conn, $sql_arti);
                      if(mysqli_num_rows($result_A) > 0){
                          while ($row = mysqli_fetch_assoc($result_A)) {
                              echo "['".$row['arti']."',".$row['count']."],"; 
                          }
                      }
                      else{
                        header('location:yss_report.php');
                      } 
                  }

              }
            ?>
        ]);

         var options1 = {
          title: 'Regularity in Arti',
        };

        var options2 = {
          title: 'Regularity in Arti',
          legend: { position: 'none' },
          chart: { title: 'Regularity in Arti',
                   subtitle: 'popularity by percentage' },
          bars: 'vertical', 
          axes: {
            x: {
              0: { side: 'top', label: 'Count'} 
            }
          },
          bar: { groupWidth: "10%" }

        };

         var chart1 = new google.visualization.PieChart(document.getElementById('piechart_arti'));
         chart1.draw(data1, options1);
         var chart2 = new google.charts.Bar(document.getElementById('barchart_arti'));
         chart2.draw(data1, options2);
      };

      function drawSlok(){

        var data1 = google.visualization.arrayToDataTable([
          ['Slok', 'Count'],
          <?php
              if(isset($_POST['submit'])){
                  $start =  $_POST['start'];
                  $end =  $_POST['end'];
                  $roll_no =  strtoupper($_POST['roll_no']);

                  if($roll_no == 'YSS1' || $roll_no == 'YSS2'){
                      $sql_slok = "SELECT slok, COUNT(slok) as count from (SELECT * FROM report WHERE date1 BETWEEN '$start' AND '$end') as new WHERE YSS = '$roll_no' GROUP BY slok;";

                      $result_SL = mysqli_query($conn, $sql_slok);
                      if(mysqli_num_rows($result_SL) > 0){
                          while ($row = mysqli_fetch_assoc($result_SL)) {
                              echo "['".$row['slok']."',".$row['count']."],"; 
                          }
                      }
                      else{
                        header('location:yss_report.php');
                      } 
                  }
                  else{
                       $sql_slok = "SELECT slok, COUNT(slok) as count from (SELECT * FROM report WHERE date1 BETWEEN '$start' AND '$end') as new WHERE roll_no = '$roll_no' GROUP BY slok;";

                       $result_SL = mysqli_query($conn, $sql_slok);
                      if(mysqli_num_rows($result_SL) > 0){
                          while ($row = mysqli_fetch_assoc($result_SL)) {
                              echo "['".$row['slok']."',".$row['count']."],"; 
                          }
                      }
                      else{
                        header('location:yss_report.php');
                      } 
                  }

              }
            ?>
        ]);

         var options1 = {
          title: 'Shlok Before Bhojan',
        };

        var options2 = {
          title: 'Shlok Before Bhojan',
          legend: { position: 'none' },
          chart: { title: 'Shlok Before Bhojan',
                   subtitle: 'popularity by percentage' },
          bars: 'vertical', 
          axes: {
            x: {
              0: { side: 'top', label: 'Count'} 
            }
          },
          bar: { groupWidth: "10%" }

        };

         var chart1 = new google.visualization.PieChart(document.getElementById('piechart_slok'));
         chart1.draw(data1, options1);
         var chart2 = new google.charts.Bar(document.getElementById('barchart_slok'));
         chart2.draw(data1, options2);
      };

      function drawSevak(){

        var data1 = google.visualization.arrayToDataTable([
          ['Sevak', 'Count'],
          <?php
              if(isset($_POST['submit'])){
                  $start =  $_POST['start'];
                  $end =  $_POST['end'];
                  $roll_no =  strtoupper($_POST['roll_no']);

                  if($roll_no == 'YSS1' || $roll_no == 'YSS2'){
                      $sql_sevak = "SELECT sevak, COUNT(sevak) as count from (SELECT * FROM report WHERE date1 BETWEEN '$start' AND '$end') as new WHERE YSS = '$roll_no' GROUP BY sevak;";

                      $result_Se = mysqli_query($conn, $sql_sevak);
                      if(mysqli_num_rows($result_Se) > 0){
                          while ($row = mysqli_fetch_assoc($result_Se)) {
                              echo "['".$row['sevak']."',".$row['count']."],"; 
                          }
                      }
                      else{
                        header('location:yss_report.php');
                      } 
                  }
                  else{
                     $sql_sevak = "SELECT sevak, COUNT(sevak) as count from (SELECT * FROM report WHERE date1 BETWEEN '$start' AND '$end') as new WHERE roll_no = '$roll_no' GROUP BY sevak;";

                       $result_Se = mysqli_query($conn, $sql_sevak);
                      if(mysqli_num_rows($result_Se) > 0){
                          while ($row = mysqli_fetch_assoc($result_Se)) {
                              echo "['".$row['sevak']."',".$row['count']."],"; 
                          }
                      }
                      else{
                        header('location:yss_report.php');
                      } 
                  }

              }
            ?>
        ]);

         var options1 = {
          title: 'SwayamSevak',
        };

        var options2 = {
          title: 'SwayamSevak',
          legend: { position: 'none' },
          chart: { title: 'SwayamSevak ',
                   subtitle: 'popularity by percentage' },
          bars: 'vertical', 
          axes: {
            x: {
              0: { side: 'top', label: 'Count'} 
            }
          },
          bar: { groupWidth: "10%" }

        };

         var chart1 = new google.visualization.PieChart(document.getElementById('piechart_sevak'));
         chart1.draw(data1, options1);
         var chart2 = new google.charts.Bar(document.getElementById('barchart_sevak'));
         chart2.draw(data1, options2);
      };

      function drawPranam(){

        var data1 = google.visualization.arrayToDataTable([
          ['Pranam', 'Count'],
          <?php
              if(isset($_POST['submit'])){
                  $start =  $_POST['start'];
                  $end =  $_POST['end'];
                  $roll_no =  strtoupper($_POST['roll_no']);

                  if($roll_no == 'YSS1' || $roll_no == 'YSS2'){


                      $sql_pranam = "SELECT pranam, COUNT(pranam) as count from (SELECT * FROM report WHERE date1 BETWEEN '$start' AND '$end') as new WHERE YSS = '$roll_no' GROUP BY pranam;";

                      $result_pr = mysqli_query($conn, $sql_pranam);
                      if(mysqli_num_rows($result_pr) > 0){
                          while ($row = mysqli_fetch_assoc($result_pr)) {
                              echo "['".$row['pranam']."',".$row['count']."],"; 
                          }
                      }
                      else{
                        header('location:yss_report.php');
                      } 
                  }
                  else{
                     $sql_pranam = "SELECT pranam, COUNT(pranam) as count from (SELECT * FROM report WHERE date1 BETWEEN '$start' AND '$end') as new WHERE roll_no = $roll_no GROUP BY pranam;";

                       $result_pr = mysqli_query($conn, $sql_pranam);
                      if(mysqli_num_rows($result_pr) > 0){
                          while ($row = mysqli_fetch_assoc($result_pr)) {
                              echo "['".$row['pranam']."',".$row['count']."],"; 
                          }
                      }
                      else{
                        header('location:yss_report.php');
                      } 
                  }

              }
            ?>
        ]);

         var options1 = {
          title: 'Panchag-Pranam',
        };

        var options2 = {
          title: 'Panchag-Pranam',
          legend: { position: 'none' },
          chart: { title: 'Regularity in Panchag-Pranam',
                   subtitle: 'popularity by percentage' },
          bars: 'vertical', 
          axes: {
            x: {
              0: { side: 'top', label: 'Count'} 
            }
          },
          bar: { groupWidth: "10%" }

        };

         var chart1 = new google.visualization.PieChart(document.getElementById('piechart_pranam'));
         chart1.draw(data1, options1);
         var chart2 = new google.charts.Bar(document.getElementById('barchart_pranam'));
         chart2.draw(data1, options2);
      };

    </script>
  </head>
  <body>
<div id="topheader">
 <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #10CDEE;">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#" style="color:white; font-size: 17px;"><b>Y</b>uva<b>S</b>evak<b>S</b>abha</a>
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="#section0" style="color:white; font-size: 17px;">Home</a></li>
          <li><a href="#section1" style="color:white; font-size: 17px;">Arti</a></li>
          <li><a href="#section2" style="color:white; font-size: 17px;">Sabha</a></li>
          <li><a href="#section3" style="color:white; font-size: 17px;">Vachanamrut</a></li>
          <li><a href="#section4" style="color:white; font-size: 17px;">Slok</a></li>
          <li><a href="#section5" style="color:white; font-size: 17px;">SwayamSevak</a></li>
          <li ><a href="#section6" style="color:white; font-size: 17px;">Panchag Pranam</a></li> 
          <li><a href="yss_report1.php" style="color:white; font-size: 17px;">All</a></li> 

           <a href="logout.php" class="btn btn-danger" id="logout">logout</a>
        </ul>
        
      </div>
    </div>
  </div>
</nav> 
</div>   
<div id="section0" class="container-fluid">
  <table>
      <tr>
        <td>
          <div id="vis">
            <img src="vis.jpg" id="img1" >
          </div>
        </td>
        <td>
          <div id="select">
            <form class="details" action="yss_report.php" method="post">
             <div class="form-group">
                <label for="roll_no" style="color:white;">RollNo:</label>
                <input type="text" id="roll" class="form-control"  aria-describedby="emailHelp" placeholder="Enter " name="roll_no" required>
            </div>
            <div class="form-group">
                <label for="from" style="color:white;">From:</label>
                <input type="date" class="form-control" id="from" aria-describedby="emailHelp" placeholder="from" name="start"  required>
            </div>
            <div class="form-group">
                <label for="to" style="color:white;">To:</label>
                <input type="date" class="form-control" id="to" aria-describedby="emailHelp" placeholder="to" name="end"  required>
            </div>
            <button name="submit" class="btn btn-primary btn-sm" >Submit</button>
             
          </form>
          </div>
        </td>
      </tr>
    </table>
</div>
<div id="section1" class="container-fluid">
  <table>
      <tr>
        <td>
          <div id="piechart_arti"></div>
        </td>
        <td>
          <div id="barchart_arti"></div>
        </td>
      </tr>
    </table>
</div>
<div id="section2" class="container-fluid">
  <table>
      <tr>
        <td>
          <div id="piechart_sabha"></div>
        </td>
        <td>
          <div id="barchart_sabha"></div>
        </td>
      </tr>
    </table>
</div>
<div id="section3" class="container-fluid">
  <table>
      <tr>
        <td>
          <div id="piechart_vachan"></div>
        </td>
        <td>
          <div id="barchart_vachan"></div>
        </td>
      </tr>
    </table>
</div>
<div id="section4" class="container-fluid">
  <table>
      <tr>
        <td>
          <div id="piechart_slok"></div>
        </td>
        <td>
          <div id="barchart_slok"></div>
        </td>
      </tr>
    </table>
</div>
  
<div id="section5" class="container-fluid">
  <table>
      <tr>
        <td>
          <div id="piechart_sevak"></div>
        </td>
        <td>
          <div id="barchart_sevak"></div>
        </td>
      </tr>
    </table>
</div> 
<div id="section6" class="container-fluid">
  <table id="t1">
      <tr>
        <td>
          <div id="piechart_pranam"></div>
        </td>
        <td>
          <div id="barchart_pranam"></div>
        </td>
      </tr>
    </table>
</div>
</body>
</html>


