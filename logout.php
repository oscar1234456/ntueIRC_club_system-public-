<?php
    session_start();
    header("Refresh:3;url=login.php");
?>
<html>
<head><title>logout</title></head>
<body>
<?php   
 unset($_SESSION['username']);
 unset($_SESSION['Carde']);
 unset($_SESSION['userId']);
?>
    您已登出！即將返回首頁!
</body>
</html>