
<!DOCTYPE html>
<html>
<head>
	<title>revise.php</title>
</head>
<body>
  <?php
  	session_start();


  if(!isset($_SESSION["account"]) || ($_SESSION["account"]=="")){

    //前往登入頁面

    header("Location: login.php");
    exit;

  }else{


    header("Content-Type:text/html; charset=utf-8");
    //取得表單欄位值
  	//if ( isset($_POST["username"]))
    //$account = $_POST["username"];
  	//if ( isset($_POST["password"]))
    //$password = $_POST["password"];
    	  $orderid = $_POST["orderid"]; 
        $name = $_POST["name"];
        $phonenumber = $_POST["phonenumber"];
        $email = $_POST["email"];
        $checkindate = $_POST["checkindate"];
        $checkoutdate = $_POST["checkoutdate"];
        $roomtype = $_POST["roomtype"];

  session_start();  // 啟用交談期
    $link = mysqli_connect("localhost","root","","hotel")
            or die("無法開啟MySQL資料庫連接!<br/>");

    //送出UTF8編碼的MySQL指令
    mysqli_query($link, 'SET NAMES utf8'); 

  $sql = "UPDATE orderlist SET 訂購者姓名='$name', 手機號碼='$phonenumber', email='$email', 入住日期='$checkindate', 退房日期='$checkoutdate', 房型='$roomtype' WHERE 訂單編號='$orderid'";
  
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