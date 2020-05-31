<?php
session_start();
$title_name = "ntueIRC管理系統・新增教師資料" ;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	  
    <link rel="stylesheet" href="css/e_w3.css">
    <link rel="stylesheet" href="css/movepic.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="open-iconic-master/font/css/open-iconic-bootstrap.css" rel="stylesheet">  
    <title><?php print $title_name?></title>
  </head>
  <body>
    <div class="takeup"><a href="#"><span class="oi oi-arrow-thick-top"> </span></a></div>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color:#355772;"><a class="navbar-brand" href="naviTest.php"> <img class="d-inline-block align-top" src="images/phy_icon.png" width="30" height="30" alt="">   &nbsp;&nbsp;  ntueIRC社團系統</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <!--導覽列生成位置-->
        <?php 
          if(isset($_SESSION['Carde'])){
            $carde = $_SESSION['Carde'];
            if($carde == "社長"){
              $temp_Nav_file = file('nav_leader.txt');
            }else if($carde == "副社長"){
              $temp_Nav_file = file('nav_leader2.txt');
            }else if($carde == "資訊管理"){
              $temp_Nav_file = file('nav_mis.txt');
            }else if($carde == "總務"){
              $temp_Nav_file = file('nav_general.txt');
            }else if($carde == "文書"){
              $temp_Nav_file = file('nav_secretary.txt');
            }else if($carde == "教師"){
              $temp_Nav_file = file('nav_teacher.txt');
            }else{
              $temp_Nav_file = file('nav_mem.txt');
            }
          }else{
            $temp_Nav_file = file('nav_outside.txt');
          }
            foreach($temp_Nav_file as $line){
                $line = trim($line);
                $info = explode('|',$line);
                print '<li class="nanav-item';
                if($info[0]==substr($_SERVER['PHP_SELF'],13)){  //辨別目前網頁 如果相同則啟動導覽標記
                    print ' active';
                }
                print '"><a class="nav-link" href="'.$info[0].'">'.$info[1].'</a><span class="sr-only">(current)</span></li>';
            }
        ?>
        </ul>
      </div>
      <?php
        if(isset($_SESSION['username'])){
          ?><span class= "important">您好， <?php print $_SESSION['Carde']." ".$_SESSION['username']?></span>
          <span class="important"> <a href="logout.php">  登出</a></span>
          <?php
        }else{?>
          <span class= "important"><a href="login.php">登入</a></span>
      <?php } ?>
      
    </nav>
    <div id="container">
<div id="sidebar">
    <div id="content">
        <div class="title">新增教師資料</div>      
            <div class="learn">
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              try {
                $conn = new PDO("sqlsrv:server = tcp:ntueirc.database.windows.net,1433; Database = xxxxx", "xxxx", "xxxx");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $q = $conn ->prepare("insert into Teacher values(?,?,?,?)");
                $q ->execute(array($_POST['Teach_Id'],$_POST['Teacher_Name'],$_POST['Teach_Start_date'],$_POST['Teach_End_date']));
                  print "已完成新增教師 ".$_POST['Teacher_Name'];
                  print "<br>即將返回教師管理畫面！";
                  ?>
              <script type="text/javascript"> setTimeout("window.location.href='teacher_menu.php'",3000); </script>
             <?php }
              catch (PDOException $e) {
                  print("Error connecting to SQL Server.");
                  die(print_r($e));
              }
              //print $_POST['SId']." ".$_POST['M_Name']." ".$_POST['FBname']." ".$_POST['LineID']." ".$_POST['Email']." ".$_POST['Phone']." ".$_POST['Degree']." ".$_POST['Sex']." ".$_POST['B_date']." ".$_POST['passwords']." ".$_POST['Grade']." ".$_POST['Enter_date']." ".$_POST['Being']." ".$_POST['Dno'];
            }else{
              try {
                $conn = new PDO("sqlsrv:server = tcp:ntueirc.database.windows.net,1433; Database = xxxxx", "xxxx", "xxxx");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $q = $conn ->query("select DNumber,DName from Department;");
                $rows = $q -> fetchAll();
                $rows_count = count($rows);
               }
              catch (PDOException $e) {
                  print("Error connecting to SQL Server.");
                  die(print_r($e));
              }
              ?>

<form action="<?php $_SERVER['PHP_SELF']?>" method = "post" >
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>教師編號</label>
      <input type="text" class="form-control" id="inputEmail4" name ="Teach_Id"placeholder="屆數2碼＋序號3碼" required>
    </div>
   
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputName">姓名</label>
      <input type="text" class="form-control" id="inputName" name ="Teacher_Name" placeholder="王小明" required>
    </div>
   
  </div>
  
  
  <div class="form-row">
    
   
    <div class="form-group col-md-6">
    <label for="inputDate">開始任職日</label>
    <input type="date" class="form-control" id="inputDate" name ="Teach_Start_date" required>
    </div>
    <div class="form-group col-md-6">
    <label for="inputDate">結束任職日</label>
    <input type="date" class="form-control" id="inputDate" name ="Teach_End_date" required>
    </div>
  </div>
   <div class="form-group">
   <button class="btn btn-primary" type="submit">新增教師資料</button>
   <button class="btn btn-primary" type="reset">清除表單</button>
   </div>
</form>
    <?php
}?>
   
           
            </div>
    </div>
</div>
      <div id="footer">ntueIRC社團系統</div>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </div>
  </body>
</html>