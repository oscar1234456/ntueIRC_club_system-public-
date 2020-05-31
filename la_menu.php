<?php
session_start();
$title_name = "陳泰元・線性代數" ;
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
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color:#355772;"><a class="navbar-brand" href="index.html"> <img class="d-inline-block align-top" src="images/phy_icon.png" width="30" height="30" alt="">   &nbsp;&nbsp;   *泰元'S 科學筆記*</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <!--導覽列生成位置-->
        <?php //此處增加判別使用者是誰 導覽列會不一樣
            foreach(file('nav.txt') as $line){
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
          ?><span class= "important">您好， <?php print $_SESSION['username']?></span>
          <span class="important"> <a href="logout.php">  登出</a></span>
          <?php
        }else{?>
          <span class= "important"><a href="login.php">登入</a></span>
      <?php } ?>
    </nav>
    <div id="container">
<div id="sidebar">
    <div id="content">
          <div class="title">應用電子學（一）（二）及 實驗筆記</div>      
          <div class="learn">
            <p><br>
              <br>
            </p>
            <p><a href="e_w1.html">與車車的第一次見面  </a><span class="badge badge-danger">HOT</span></p>
			  <br>	
			<p><a href="e_w2.html">第一次實作初體驗</a></p>
            <p><br>
            <a href="e_w3.html">呼吸燈程式</a></p>
            <p>&nbsp;</p>
            <p><a href="e_w4.html">搖桿搖起來</a></p>
            <p>&nbsp;</p>
            <p><a href="e_w5.html">控制機器車</a></p>
            <p>&nbsp;</p>
            <p><a href="e_w6.html">紅外線距離測試</a></p>
            <p>&nbsp;</p>
			<p><a href="e_8266.html">ESP8266 Wifi網卡  </a></p>
			<p>&nbsp;</p>
			<p><a href="e_sound.html">我是作曲家-揚聲器</a></p>
			<p>&nbsp;</p>
			<p><a href="http://gundambox.github.io/2015/10/30/C%E8%AA%9E%E8%A8%80-struct%E3%80%81union%E3%80%81enum/" target="_blank">struct &amp; Union</a></p>
			<p>&nbsp;</p>
			<p><a href="https://drive.google.com/drive/folders/1QX2YtY0gCORO-aXjcq5DDKRIlqS56ivZ?usp=sharing" target="_blank">wifi搖桿車程式</a></p>
			<p>&nbsp;</p>
			<p><a href="e_light.html">各種裝飾燈(可定址LED)</a></p>
			<p>&nbsp;</p>
			<p><a href="e_oled.html">OLED的應用</a> <span class="badge badge-info">New</span><span class="badge badge-secondary">最後更新日期：2019/5/22(三)</span></p>
            <blockquote>&nbsp;</blockquote>
            <div class="jumbotron">
              <h1 class="display-4">謝謝您的支持！！</h1><br>          
              <p class="lead">您的意見    是我改進的原動力</p>          
              <p class="lead">歡迎您將閱讀後的心得告訴我    讓我可以更加進步～～</p>          
              <hr class="my-4">          
              <p><img class="img-fluid" src="images/emil_icon.png" width="30px" alt="">   chen.oscar@hotmail.com</p>          
              <p>資訊科學系   二年甲班   陳泰元  </p>
            </div>
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