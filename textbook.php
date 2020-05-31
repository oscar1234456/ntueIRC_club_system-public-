<?php
session_start();
$title_name = "國北資研·課程附件" ;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	  
    <link rel="stylesheet" href="css/e_w3.css">
    <link rel="stylesheet" href="css/movepic.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="open-iconic-master/font/css/open-iconic-bootstrap.css" rel="stylesheet">  
    <title><?php print $title_name?></title>
  </head>
  <script>
  
  
  </script>
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
<div id="sidebar">
    <div id="content">
    <?php if(isset($_SESSION['username'])){?>
          <div class="title">課程附件</div>      
          <div class="learn">
          <br>
          <p><mark>第一次社課(108/9/26)</mark></p>
      
          python: <a href="textbook/第一次社課.pptx" download>第一次社課.ppt</a>
          <br>
          資訊課題1: <a href="textbook/國北教資訊社社課專題討論-為什麼我的電腦很慢.pptm" download>國北教資訊社社課專題討論-為什麼我的電腦很慢.pptm</a>
          <br>
          資訊課題2: <a href="textbook/snowslide.bat" download>snowslide.bat</a>
          <br>
          <br>
          <br>
          <p><mark>第二次社課(108/10/3)</mark></p>
      
          python: <a href="textbook/第二次社課.pptx" download >第二次社課.ppt</a>
          <br>
          <br>
          <br>
          <p><mark>第三次社課(108/10/9)</mark></p>
          python: <a href="textbook/第三次社課.pptx" download >第三次社課.ppt</a>
          <br>
          <br>
          <p><mark>第四次社課(108/10/17)</mark></p>
          python: <a href="textbook/第四次社課.pptx" download >第四次社課.ppt</a>
          <br>
          資訊課題 : <a href="https://drive.google.com/file/d/1hfoMOeGES447rptaCcgmgoaWNHYvFiu-/view?fbclid=IwAR3gYbu83emu_Q03cG6uTox6IyfV2KD1_3VF4eH0WVb3Ker7HQoMsjAzs3I">雜湊</a>
          <br>
          <br>
          <p><mark>第五次社課(108/10/24)</mark></p>
          python: <a href="textbook/第五次社課.pptx" download >第五次社課.ppt</a>
          <br>
          資訊課題 : <a href="https://drive.google.com/file/d/15yR4G7xwYCGP8HuJEpAfdxdGNsbQ9z27/view?usp=sharing">流程圖與循序圖.pptx</a>
          <br>
          <br>
          <p><mark>第六次社課(108/11/21)</mark></p>
          python: <a href="textbook/第六次社課.pptx" download >第六次社課.ppt</a>
          <br>
          資訊課題 : <a href="https://drive.google.com/file/d/1Pq725d8zfFuyjSMKVtIoMdGGNY7usOJD/view?fbclid=IwAR1_I7Ay1z2Sd6oLPfSBmTSd_zmUfP4QM3W0ykrqOaD4gWeQim7vr_aLg0o">需求評估.pptx</a>
          <br>
         <br>
          <p><mark>第七次社課(108/11/28)</mark></p>
          python: <a href="textbook/第七次社課.pptx" download >第七次社課.ppt</a>
          <br>
          資訊課題 : <a href="https://drive.google.com/file/d/1tuEDtmUQQTjbJybf5gThp3n86vW8Dxe3/view?fbclid=IwAR03Fw2uqXOiEu1A8NctvOUVt_3RVmAOrQxEvk7FmhedgCSFXqQrHR8gdC8">專案架構.pptx</a>
          <br><br>
          <p><mark>第十次社課兼第二次社員大會(108/12/19)</mark></p>
          python: <a href="textbook/第十次社課兼社員大會.pptx" download >第十次社課兼社員大會.ppt</a>
          <br>
          <br>
          <p><mark>第十一次社課兼第三次社員大會(109/3/6)</mark></p>
          python: <a href="https://drive.google.com/file/d/11A03KmjMf9jCbRI017Ireu8Al2-TCCyX/view?usp=sharing" target="_blank">第十一次社課兼第三次社員大會.ppt</a>
          <br>
          課程影片1:<a href="https://youtu.be/RhRgum87oRw" target="_blank">10802第十一次社課暨第三次社員大會-python</a>
          <br>
          課程影片2:<a href="https://youtu.be/E-CYvnTgtGc" target="_blank">10802第十一次社課暨第三次社員大會-進階</a>
          <br>
          課程影片(補充):<a href="https://www.youtube.com/watch?v=pKO9UjSeLew" target="_blank">if programming was an anime</a>
          <br>
          <br>
          <p><mark>第十二次社課(109/3/13)</mark></p>
          python: <a href="https://drive.google.com/file/d/12r6vCo3YcVInmNal-SoWOmTOpzckpFrN/view?usp=sharing" target="_blank">第十二次社課.ppt</a>
          <br>
          課程影片1-1:<a href="https://youtu.be/8oE8_VGpEEo" target="_blank">10802第十二次社課-python 1</a>
          <br>
          課程影片1-2:<a href="https://youtu.be/6CCM5iU0lAQ" target="_blank">10802第十二次社課-python 2</a>
          <br>
          課程影片2-1:<a href="https://youtu.be/1itZ2AWWZks" target="_blank">10802第十二次社課-進階1</a>
          <br>
          課程影片2-2:<a href="https://youtu.be/8fB-VfFDhf0" target="_blank">10802第十二次社課-進階2</a>
          <br>
          <br>
          <p><mark>第十三次社課(109/3/20)</mark></p>
          python: <a href="https://drive.google.com/file/d/19D8B1JGqr-TcQJUYYLwbjdKSKXesA3_u/view?usp=sharing" target="_blank">第十三次社課.ppt</a>
          <br>
          課程影片1-1:<a href="https://youtu.be/lqEJ40c5daQ" target="_blank">10802第十三次社課-python 1</a>
          <br>
          課程影片1-2:<a href="https://youtu.be/9WbHrDXGsiU" target="_blank">10802第十三次社課-python 2</a>
          <br>
          課程影片2-1:<a href="https://youtu.be/XG6LjgIZCxs" target="_blank">10802第十三次社課-進階1</a>
          <br>
          課程影片2-2:<a href="https://youtu.be/2wO7XyH8N3I" target="_blank">10802第十三次社課-進階2</a>
          <br>
         <br>
         <p><mark>第十四次社課(109/3/27)</mark></p>
          python: <a href="https://drive.google.com/file/d/1uKG-LLRkA-pDRNTuwpDVFzcF1umLXkWM/view?usp=sharing" target="_blank">第十四次社課.ppt</a>
          <br>
          該堂於圖書館臨時上課，未有影片
          <br>
          幹部志願單:<a href="https://drive.google.com/open?id=1JYRlmhyHD0_Ogf0kiE7HBZBAJ2pMkrf5" target="_blank">幹部志願單</a>
          <br>
         <br>
         <p><mark>第十五次社課(109/4/1)</mark></p>
          python: <a href="https://drive.google.com/open?id=1pv3beHM2cPkh0wuWCUDFQzBU_msAA-KV" target="_blank">第十五次社課.ppt</a>
          <br>
          課程影片1-1:
          <br>
          課程影片1-2:
          <br>
          課程影片2-1:
          <br>
          課程影片2-2:
          
          <br>
          <br>
          <p><mark>第十七次社課(109/5/1)</mark></p>
          python: <a href="https://drive.google.com/file/d/1gh26BGd-kp10lxvp6yrR6BWJJNqUmU72/view?usp=sharing" target="_blank">第十七次社課.ppt</a>
          <br>
          課程影片1-1:
          <br>
          課程影片1-2:
          <br>
          課程影片2-1:
          <br>
          課程影片2-2:
          <br>
          <br>
          <p><mark>第十八次社課(109/5/8)</mark></p>
          python: <a href="https://drive.google.com/file/d/1VBgrZ_3OBQnbPg2sC41YgE0AuVH-luVm/view?usp=sharing" target="_blank">第十八次社課.ppt</a>
          <br>
          <br>
          <p><mark>第十九次社課(109/5/22)</mark></p>
          python: <a href="https://drive.google.com/file/d/191EUVE9h9PnuS1gx29EjjljVf3puMIFZ/view?usp=sharing" target="_blank">第十九次社課.ppt</a>
        
          <br>
          <br>
          <p><mark>第二十次社課(109/5/29)</mark></p>
          python: <a href="https://drive.google.com/file/d/1Q2ILwB1G3NG-HdctGicYPlPLrf-R7Z1_/view?usp=sharing" target="_blank">第二十次社課.ppt</a>
          
          </div>
          </div>
          
    <?php }else{ ?>
      <div class="title">課程附件</div>      
          <div class="learn">
          
          <p>您未登入！ 請登入後再試！</p>
          <p>即將重新導向至登入畫面</p>
          <script type="text/javascript"> setTimeout("window.location.href='login.php'",3000); </script>
          </div>
          </div>
        

    <?php }?>

          </div>
       
      <div id="footer">ntueIRC社團系統</div>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </div>
  </body>
</html>