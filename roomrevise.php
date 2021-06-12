<!DOCTYPE html>
<html>
<head>
  <title>roomrevise.php</title>
</head>
<body>
  <?php
    session_start();
    $link = mysqli_connect("localhost","root","","hotel")
            or die("無法開啟MySQL資料庫連接!<br/>");
    mysqli_query($link, 'SET NAMES utf8'); 



  	if(!isset($_SESSION["account"]) || ($_SESSION["account"]=="")){

    //前往登入頁面

    header("Location: login.php");
    exit;

  }else{

  	$id=$_GET['id'];
    //echo "$id";
    $room=$_POST['status'];
    // echo $_SESSION['a']["$_SESSION[key]"];
    // $temp = $_SESSION['a']["$_SESSION[key]"];
    $sql = "  UPDATE room SET 房間狀態='$room' WHERE 房號=$id  " ;
  
    if ($link->query($sql) === TRUE) {
    //echo "New record created successfully，點擊跳轉回登入頁面";
    //echo '<a href="http:/localhost/login.html" >登入</a>';
    header("Location:functionpage.html");
    } else {
    echo "Error: " . $sql . "<br>" . $link->error;
   }

  $link->close();
  }

  ?>



</body>
</html>

