<?php
session_start();
?>
<html>
<head><title>login</title></head>
<body>
<?php
if(@!is_null($_SESSION['username'])){
    print "<h1>您已登入！</h1>";
}else if(@is_null($_POST['user'])&&@is_null($_POST['pass'])){
    $_SESSION['uptime'] = $_SERVER['HTTP_REFERER'];
?>
<form action="login.php" method="post">
    username:<input type="text" name="user">
    password: <input type="text" name="pass"> 
    <input type="submit" value="確認">
</form>
<?php
}else{
    $_SESSION['username'] = $_POST['user'];
    //print $GLOBALS['uptime'];
    print "已登入完成，";
    /*print '按<a href="naviTest.php">此處</a>';
    print "重返首頁！";*/?>
    <script type="text/javascript"> setTimeout("window.location.href='<?php print $_SESSION['uptime']?>'",3000); </script>
<?php    
}    
?>
</body>
</html>


