<?php
session_start();
$title_name = "ntueIRC管理系統・刪除教師資料" ;
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
  <script language="javascript">
   function doubleCheck(){
      var sure = window.confirm('確定要刪除此教師？');
      if (!sure) return;
        form1.action = "teacher_delete_keep2.php";
        form1.method = "post";
        form1.submit();
        
   }
  </script>
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

    <?php
      try {
        $conn = new PDO("sqlsrv:server = tcp:ntueirc.database.windows.net,1433; Database = xxxxx", "xxxx", "xxxx");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        /*$q = $conn ->query("select SId,M_Name from Member");
        $rows = $q->fetchAll();
        $rows_count = count($rows);*/
        $q2 = $conn ->query("select Teach_Id,Teacher_Name from Teacher;");
        $rows2 = $q2->fetchAll();
        $rows_count2 = count($rows2);
       }
      catch (PDOException $e) {
          print("Error connecting to SQL Server.");
          die(print_r($e));
      }
    ?>
    <div id="container">
<div id="sidebar">
    <div id="content">
        <div class="title">刪除教師資料</div>      
            <div class="learn">
            <br>
            <h4>請選擇您要<strong><mark>刪除</mark></strong>的教師:</h4>
            <form name ="form1" action="teacher_delete_keep.php" method="post">
              <div class="form-row">
                <div class="form-group col-md-8">
                  <select class="custom-select" name = "choose_Member" required>
                    <option value="">選擇教師......</option>
                    <?php
                        for($i=0;$i<$rows_count2;$i++){
                          
                            print "<option value=".$rows2[$i][0].">".$rows2[$i][0]." ".$rows2[$i][1]."</option>";
                            

                          }
                      ?>
                        
                  </select>
                  <div class="invalid-feedback">Example invalid custom select feedback</div>
                </div>
                <div class="form-group col-md-4">
                  <button class="btn btn-primary" type="submit">查詢</button>
                  <button class="btn btn-warning" type="button" onclick="doubleCheck()"><strong>直接刪除</strong></button>
                </div>
              </div>
            </form>  
            <p>非必要，請不要刪除教師資料！</p>
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