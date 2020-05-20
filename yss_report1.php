
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
      
      #stackchart_arti,#stackchart_sabha,#stackchart_vachan,#stackchart_slok,
        #stackchart_sevak,#stackchart_pranam{
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
      // google.charts.setOnLoadCallback(drawStuff);
      // google.charts.setOnLoadCallback(drawSabha);
      google.charts.setOnLoadCallback(allVachan);
      google.charts.setOnLoadCallback(allArti);
      google.charts.setOnLoadCallback(allSlok);
      google.charts.setOnLoadCallback(allSevak);
      google.charts.setOnLoadCallback(allPranam);
      google.charts.setOnLoadCallback(allSabha);
      function allArti() {

        var data = google.visualization.arrayToDataTable([
        ['RollNo','Morning','Evening','Both','None'],
        <?php

         if(isset($_POST['submit_all']))
         {
                 
         $sql="SELECT roll_no,
                max(case when arti='Morning' then count end) as Morning,
                max(case when arti='Evening' then count end) as Evening,
                max(case when arti='Both' then count end) as Both1,
                max(case when arti='None' then count end) as None
                from (SELECT roll_no,arti,COUNT(arti) as count from report GROUP BY roll_no,arti ORDER BY roll_no,arti) as new group by roll_no;";
          $result=mysqli_query($conn,$sql);

          if (mysqli_num_rows($result) > 0) {
          
          while($row = mysqli_fetch_assoc($result)) {

              if($row['Evening']==NULL)
              {
                $row['Evening']=0;
              }
              if ($row['Morning']==NULL) {
                $row['Morning']=0;
              }
              if ($row['Both1']==NULL) {
                $row['Both1']=0;
              }
               if ($row['None']==NULL) {
                $row['None']=0;
              }

              echo "['".$row['roll_no']."',".$row['Morning'].",".$row['Evening'].",".$row['Both1'].",".$row['None']."],"; 
        }
        }
       }
        ?>

      ]);

      var options = {
        title:"Arti",
        legend: { position: 'top', maxLines: 2 },
        bar: { groupWidth: '75%' },
        isStacked: true,
         hAxis: {
       slantedText: true,  /* Enable slantedText for horizontal axis */
       slantedTextAngle: 90 /* Define slant Angle */
                }
      };

     var chart = new google.visualization.ColumnChart(document.getElementById("stackchart_arti"));
      chart.draw(data, options);
      };

       function allSabha() {

        var data = google.visualization.arrayToDataTable([
        ['RollNo','Yes','No'],
        <?php
                 $start =  $_POST['start'];
                  $end =  $_POST['end'];
                  $roll_no =  strtoupper($_POST['roll_no']);

         if(isset($_POST['submit_all']))
         {           
         $sql="SELECT roll_no,
                max(case when sabha='YES' then count end) as YES,
                max(case when sabha='NO' then count end) as NO
                from (SELECT roll_no,sabha,COUNT(sabha) as count from report WHERE date1 BETWEEN '$start' AND '$end' GROUP BY roll_no,sabha ORDER BY roll_no,sabha) as new group by roll_no;";
          $result=mysqli_query($conn,$sql);

          if (mysqli_num_rows($result) > 0) {
          
          while($row = mysqli_fetch_assoc($result)) {

              if($row['YES']==NULL)
              {
                $row['YES']=0;
              }
              if ($row['NO']==NULL) {
                $row['NO']=0;
              }

              echo "['".$row['roll_no']."',".$row['YES'].",".$row['NO']."],"; 
            }
          }
        }
     ?>
        
      ]);

      var options = {
        title:"Sabha",
        width:1200,
        height:500,
        legend: { position: 'top', maxLines: 2 },
        bar: { groupWidth: '75%' },
        isStacked: true,
         hAxis: {
       slantedText: true,  /* Enable slantedText for horizontal axis */
       slantedTextAngle: 90 /* Define slant Angle */
                }
      };

     var chart = new google.visualization.ColumnChart(document.getElementById("stackchart_sabha"));
      chart.draw(data, options);
      };

     

       function allVachan() {

        var data = google.visualization.arrayToDataTable([
        ['RollNo','Yes','No'],
        <?php

                 $start =  $_POST['start'];
                  $end =  $_POST['end'];
                  $roll_no =  strtoupper($_POST['roll_no']);

         if(isset($_POST['submit_all']))
         {           
         $sql="SELECT roll_no,
                max(case when vachan='YES' then count end) as YES,
                max(case when vachan='NO' then count end) as NO
                from (SELECT roll_no,vachan,COUNT(vachan) as count from report WHERE date1 BETWEEN '$start' AND '$end' GROUP BY roll_no,vachan ORDER BY roll_no,vachan) as new group by roll_no;";
          $result=mysqli_query($conn,$sql);

          if (mysqli_num_rows($result) > 0) {
          
          while($row = mysqli_fetch_assoc($result)) {

              if($row['YES']==NULL)
              {
                $row['YES']=0;
              }
              if ($row['NO']==NULL) {
                $row['NO']=0;
              }

              echo "['".$row['roll_no']."',".$row['YES'].",".$row['NO']."],"; 
        }
        }
       }
        ?>

      ]);

      var options = {
        title:"Daily Vachanamrut ",
        width:1200,
        height:500,
        legend: { position: 'top', maxLines: 2 },
        bar: { groupWidth: '75%' },
        isStacked: true,
           hAxis: {
       slantedText: true,  /* Enable slantedText for horizontal axis */
       slantedTextAngle: 90 /* Define slant Angle */
                }
      };

     var chart = new google.visualization.ColumnChart(document.getElementById("stackchart_vachan"));
      chart.draw(data, options);
      };


       function allSlok() {

        var data = google.visualization.arrayToDataTable([
        ['RollNo','Yes','No'],
        <?php

                 $start =  $_POST['start'];
                  $end =  $_POST['end'];
                  $roll_no =  strtoupper($_POST['roll_no']);

         if(isset($_POST['submit_all']))
         {           
         $sql="SELECT roll_no,
                max(case when slok='YES' then count end) as YES,
                max(case when slok='NO' then count end) as NO
                from (SELECT roll_no,slok,COUNT(slok) as count from report WHERE date1 BETWEEN '$start' AND '$end' GROUP BY roll_no,slok ORDER BY roll_no,slok) as new group by roll_no;";
          $result=mysqli_query($conn,$sql);

          if (mysqli_num_rows($result) > 0) {
          
          while($row = mysqli_fetch_assoc($result)) {

              if($row['YES']==NULL)
              {
                $row['YES']=0;
              }
              if ($row['NO']==NULL) {
                $row['NO']=0;
              }

              echo "['".$row['roll_no']."',".$row['YES'].",".$row['NO']."],"; 
        }
        }
       }
        ?>

      ]);

      var options = {
        title:"Slok",
        width:1200,
        height:500,
        legend: { position: 'top', maxLines: 2 },
        bar: { groupWidth: '75%' },
        isStacked: true,
           hAxis: {
       slantedText: true,  /* Enable slantedText for horizontal axis */
       slantedTextAngle: 90 /* Define slant Angle */
                }
      };

     var chart = new google.visualization.ColumnChart(document.getElementById("stackchart_slok"));
      chart.draw(data, options);
      };
       function allSevak() {

        var data = google.visualization.arrayToDataTable([
        ['RollNo','Yes','No'],
        <?php

                 $start =  $_POST['start'];
                  $end =  $_POST['end'];
                  $roll_no =  strtoupper($_POST['roll_no']);

         if(isset($_POST['submit_all']))
         {           
         $sql="SELECT roll_no,
                max(case when sevak='YES' then count end) as YES,
                max(case when sevak='NO' then count end) as NO
                from (SELECT roll_no,sevak,COUNT(sevak) as count from report WHERE date1 BETWEEN '$start' AND '$end' GROUP BY roll_no,sevak ORDER BY roll_no,sevak) as new group by roll_no;";
          $result=mysqli_query($conn,$sql);

          if (mysqli_num_rows($result) > 0) {
          
          while($row = mysqli_fetch_assoc($result)) {

              if($row['YES']==NULL)
              {
                $row['YES']=0;
              }
              if ($row['NO']==NULL) {
                $row['NO']=0;
              }

              echo "['".$row['roll_no']."',".$row['YES'].",".$row['NO']."],"; 
        }
        }
       }
        ?>

      ]);

      var options = {
        title:"SwayamSevak",
        width:1200,
        height:500,
        legend: { position: 'top', maxLines: 2 },
        bar: { groupWidth: '75%' },
        isStacked: true,
           hAxis: {
       slantedText: true,  /* Enable slantedText for horizontal axis */
       slantedTextAngle: 90 /* Define slant Angle */
                }
      };

     var chart = new google.visualization.ColumnChart(document.getElementById("stackchart_sevak"));
      chart.draw(data, options);
      };
       function allPranam() {

        var data = google.visualization.arrayToDataTable([
        ['RollNo','Yes','No'],
        <?php

                 $start =  $_POST['start'];
                  $end =  $_POST['end'];
                  $roll_no =  strtoupper($_POST['roll_no']);

         if(isset($_POST['submit_all']))
         {           
         $sql="SELECT roll_no,
                max(case when pranam='YES' then count end) as YES,
                max(case when pranam='NO' then count end) as NO
                from (SELECT roll_no,pranam,COUNT(pranam) as count from report WHERE date1 BETWEEN '$start' AND '$end' GROUP BY roll_no,pranam ORDER BY roll_no,pranam) as new group by roll_no;";
          $result=mysqli_query($conn,$sql);

          if (mysqli_num_rows($result) > 0) {
          
          while($row = mysqli_fetch_assoc($result)) {

              if($row['YES']==NULL)
              {
                $row['YES']=0;
              }
              if ($row['NO']==NULL) {
                $row['NO']=0;
              }

              echo "['".$row['roll_no']."',".$row['YES'].",".$row['NO']."],"; 
        }
        }
       }
        ?>

      ]);

      var options = {
        title:"Pranam",
        width:1200,
        height:500,
        legend: { position: 'top', maxLines: 2 },
        bar: { groupWidth: '75%' },
        isStacked: true,
           hAxis: {
       slantedText: true,  /* Enable slantedText for horizontal axis */
       slantedTextAngle: 90 /* Define slant Angle */
                }
      };

     var chart = new google.visualization.ColumnChart(document.getElementById("stackchart_pranam"));
      chart.draw(data, options);
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
          <li><a href="#section6" style="color:white; font-size: 17px;">Panchag Pranam</a></li> 
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
            <form class="details" action="yss_report1.php" method="post">
             <div class="form-group">
                <label for="roll_no" style="color:white;">YSS:</label>
                <input type="text" id="roll" class="form-control"  aria-describedby="emailHelp" placeholder="Enter " name="roll_no" required>
            </div>
            <div class="form-group">
                <label for="from" style="color:white;">From:</label>
                <input type="date" class="form-control" id="from" aria-describedby="emailHelp" placeholder="from" name="start"  required>
            </div>
            <div class="form-group">
                <label for="to" style="color:white;">To:</label>
                <input type="date" class="form-control" id="to"  aria-describedby="emailHelp" placeholder="to" name="end"  required>
            </div>
            <button name="submit_all" class="btn btn-primary btn-sm" >submit</button>
             
          </form>
          </div>
        </td>
      </tr>
    </table>
</div>
<div id="section1" class="container-fluid">
  <div id="stackchart_arti"></div>
</div>
<div id="section2" class="container-fluid">
 <div id="stackchart_sabha"></div>
</div>
<div id="section3" class="container-fluid">
  <div id="stackchart_vachan"></div>
</div>
<div id="section4" class="container-fluid">
  <div id="stackchart_slok"></div>
</div>
  
<div id="section5" class="container-fluid">
  <div id="stackchart_sevak"></div>
</div> 
<div id="section6" class="container-fluid">
  <div id="stackchart_pranam"></div>
</div>
  </body>
</html>

