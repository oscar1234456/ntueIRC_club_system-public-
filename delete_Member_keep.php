<?php
session_start();
$title_name = "ntueIRC管理系統・刪除社員" ;
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
      var sure = window.confirm('確定要刪除此社員？');
      if (!sure) return;
        form1.action = "delete_Member_keep2.php";
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
        <div class="title"><mark><strong>刪除社員</strong></mark>資料查詢</div>      
            <div class="learn">
            <?php
            if($_SERVER['REQUEST_METHOD'] != 'POST'){
              print "請先查詢您要的社員！";
              print "<br>即將為您轉至<strong>刪除</strong>社員頁面！";?>
              <script type="text/javascript"> setTimeout("window.location.href='delete_Member.php'",3000); </script>
            <?php 
            }else{
              try {
                $conn = new PDO("sqlsrv:server = tcp:ntueirc.database.windows.net,1433; Database = xxxxx", "xxxxx", "xxxxx");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $q = $conn ->query("select * from Member where SId =".$_POST['choose_Member'].";");
                $rows = $q->fetchAll();
                $rows_count = count($rows);
                $q2 =  $conn ->query("select DNumber,DName from Department,Member where Dno = DNumber AND SId = ".$_POST['choose_Member'].";");
                $rows2 = $q2->fetchAll();
                $rows_count2 = count($rows2);
             }
              catch (PDOException $e) {
                  print("Error connecting to SQL Server.");
                  die(print_r($e));
              }
              
              
              ?>

<form name = 'form1'>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>學號</label>
      <input type="text" class="form-control" id="inputEmail4" name ="choose_Member" value ="<?php print $rows[0][0];?>" readonly>
      <input type="hidden" name="SId_ori" value ="<?php print $rows[0][0];?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">密碼</label>
      <input type="password" class="form-control" id="inputPassword4" name ="passwords"placeholder="Password" value="<?php print $rows[0][9];?>" readonly required>
      <input type="hidden" name="passwords_ori" value="<?php print $rows[0][9];?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputName">姓名</label>
      <input type="text" class="form-control" id="inputName" name ="M_Name" placeholder="王小明"  value="<?php print $rows[0][1];?>" readonly required>
      <input type="hidden" name="M_Name_ori" value="<?php print $rows[0][1];?>">
    </div>
    <div class="form-group col-md-6">
    <label for="inputBDate">生日</label>
    <input type="date" class="form-control" name ="B_date"id="inputBDate" value="<?php print $rows[0][8];?>" readonly required >
    <input type="hidden" name="B_date_ori" value="<?php print $rows[0][8];?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputDepartment">科系</label>
        <input type="text" class="form-control" id="inputName"  value="<?php print $rows2[0][0]; print $rows2[0][1];?>" readonly required>
        <input type="hidden" name="Dno_ori" value="<?php print $rows[0][13];?>">
    </div>
    <div class="form-group col-md-3">
        <label for="inputDegree">部別</label>
        <input type="text" class="form-control" id="inputName"  value="<?php print $rows[0][6];?>" readonly required>
       <!-- <input type="hidden" name="degree_ori" value="<?php print $rows[0][9];?>">-->
    </div>
    <div class="form-group col-md-3">
        <label for="inputGrade">年級</label>
        <input type="text" class="form-control" id="inputName"  value="<?php print $rows[0][10];?>" readonly required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputFBName">FBName</label>
    <input type="text" class="form-control" id="inputFBName"name ="FBname" value="<?php print $rows[0][2];?>"placeholder="FB name" readonly>
    <input type="hidden" name="fbName_ori" value="<?php print $rows[0][2];?>">
  </div>
  <div class="form-group">
    <label for="inputLineID">LineID</label>
    <input type="text" class="form-control" id="inputLineID" name ="LineID"value="<?php print $rows[0][3];?>" placeholder="Line ID" readonly>
    <input type="hidden" name="lineID_ori" value="<?php print $rows[0][3];?>">
  </div>
  <div class="form-group">
    <label for="inputEmail4">EMail</label>
    <input type="email" class="form-control" id="inputEmail4" name ="Email"placeholder="Email" value="<?php print $rows[0][4];?>"required readonly>
    <input type="hidden" name="email_ori" value="<?php print $rows[0][4];?>">
  </div>
  <div class="form-group">
    <label for="inputPhone">手機號碼</label>
    <input type="text" class="form-control" id="inputPhone" name ="Phone"placeholder="手機號碼" value="<?php print $rows[0][5];?>"required readonly>
    <input type="hidden" name="phone_ori" value="<?php print $rows[0][5];?>">
  </div>
  <div class="form-row">
    
    <div class="form-group col-md-4">
      <label for="inputSex">性別</label>
      <input type="text" class="form-control"  value="<?php if($rows[0][7]==0){print "男";}else{print "女";}?>"required readonly>
    </div>
    <div class="form-group col-md-4">
      <label for="inputStatus">在籍狀況</label>
      <input type="text" class="form-control"  value="<?php if($rows[0][12]==1){print "在籍";}else{print "未在籍";}?>"required readonly>
    </div>
    <div class="form-group col-md-4">
    <label for="inputDate">入社日期</label>
    <input type="date" class="form-control" id="inputDate" value="<?php print $rows[0][11];?>"name ="Enter_date" required readonly>
    <input type="hidden" name="Enter_date_ori" value="<?php print $rows[0][11];?>">
   </div>
  </div>
   <div class="form-group">
   <button class="btn btn-primary" type="button" onclick='doubleCheck()' >刪除社員資料</button>
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