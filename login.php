<?php
session_start();
$title_name = "ntueIRC資研社系統" ;
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
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color:#355772;"><a class="navbar-brand" href="naviTest.php"> <img class="d-inline-block align-top" src="images/phy_icon.png" width="30" height="30" alt="">   &nbsp;&nbsp;   ntueIRC社團系統</a>
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
    
<div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card mx-auto mt-5">
                    <div class="card-header">
                        <h3 align="center">國北資訊研究社社員系統</h3>
                        <h5 align="center">NTUE IRC Member System</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="lo_test.php">
                            <div class="form-group">
                                <label for="student_id">學號 Student ID</label>
                                <input type="text" class="form-control" name="username" placeholder="學號 Student ID" required>
                            </div>
                            <div class="form-group">
                                <label for="password">密碼 Password</label>
                                <input type="password" class="form-control" name="password" placeholder="密碼 Password" required>
                                <br>
                                <p class="text-muted">密碼預設為學號。<br>Student ID is your default password.</p>
                            </div>
                            <!--<p style="text-align: right;"><a href="/Member/login/forget_pwd.php"><i class="fa fa-refresh fa-fw"></i>忘記密碼 Forgot Password</a></p>-->

                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-sign-in fa-fw"></i>登入 Login</button>
                        </form>
                    </div>
                </div>
                <br>
                                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    請先登入。<br>Login required.
                </div>
                            </div>

        
      </div>
     
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </div>
  </body>
</html>