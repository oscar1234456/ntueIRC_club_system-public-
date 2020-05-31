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
  </head>
  <script language="javascript">
   function doubleCheck(){
      var sure = window.confirm('確定要刪除此教師？');
      if (!sure) return;
        form1.action = "teacher_delete_keep2.php";
        form1.method = "post";
        form1.submit();
   }
  </script>
  <body>
    <div class="takeup"><a href="#"><span class="oi oi-arrow-thick-top"> </span></a></div>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color:#355772;"><a class="navbar-brand" href="index.html"> <img class="d-inline-block align-top" src="images/phy_icon.png" width="30" height="30" alt="">   &nbsp;&nbsp;   *泰元'S 科學筆記*</a>
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
        <div class="title"><mark><strong>刪除教師資料</strong></mark>資料查詢</div>      
            <div class="learn">
            <?php
            if($_SERVER['REQUEST_METHOD'] != 'POST'){
              print "請先查詢您要的社員！";
              print "<br>即將為您轉至<strong>刪除</strong>社員頁面！";?>
              <script type="text/javascript"> setTimeout("window.location.href='delete_Member.php'",3000); </script>
            <?php 
            }else{
              try {
                $conn = new PDO("sqlsrv:server = tcp:ntueirc.database.windows.net,1433; Database = xxxxx", "xxxx", "xxxx");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $q = $conn ->query("select * from Teacher where Teach_Id =".$_POST['choose_Member'].";");
                $rows = $q->fetchAll();
                $rows_count = count($rows);
               
             }
              catch (PDOException $e) {
                  print("Error connecting to SQL Server.");
                  die(print_r($e));
              }
              
              
              ?>

<form name = 'form1'>
<div class="form-row">
    <div class="form-group col-md-6">
      <label>教師編號</label>
      <input type="text" class="form-control" id="inputEmail4" name ="Teach_Id" placeholder="教師編號"  value = "<?php print $rows[0][0]?>"required readonly>
      <input type="hidden" value = "<?php print $rows[0][0]?>" name="choose_Member">
    </div>
   
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputName">姓名</label>
      <input type="text" class="form-control" id="inputName" name ="Teacher_Name" placeholder="王小明" value = "<?php print $rows[0][1]?>"required readonly>
    </div>
   
  </div>
  
  
  <div class="form-row">
    
   
    <div class="form-group col-md-6">
    <label for="inputDate">開始任職日</label>
    <input type="date" class="form-control" id="inputDate" name ="Teach_Start_date" value = "<?php print $rows[0][2]?>"required readonly>
    </div>
    <div class="form-group col-md-6">
    <label for="inputDate">結束任職日</label>
    <input type="date" class="form-control" id="inputDate" name ="Teach_End_date" value = "<?php print $rows[0][3]?>"required readonly>
    </div>
  </div>
  <div class="form-group">
   <button class="btn btn-primary" type="button" onclick='doubleCheck()' >刪除教師資料</button>
   </div>
</form>
    <?php
}?>
   
           
            </div>
    </div>
</div>
      <div id="footer">陳泰元・普通物理（下）成果網頁</div>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </div>
  </body>
</html>