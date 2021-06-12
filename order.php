<!DOCTYPE html>
<html>
<head>
	<title>訂房表單</title>
</head>
<body>
	<?php
		session_start();  // 啟用交談期
		



		//如果沒有登入Session值 或是 Session值為空

		if(!isset($_SESSION["account"]) || ($_SESSION["account"]=="")){

		//前往登入頁面

		header("Location: login.php");

		}else{

		//若使用者已經是登入狀態擁有SESSION值，則前往以下網頁
		//header("Location: index.html"); }
 
			header("Content-Type:text/html; charset=utf-8");
        		$name = $_POST["Name"];
       			$phonenumber = $_POST["PhoneNumber"];
       			$email = $_POST["email"];
       			$checkindate = $_POST["CheckinDate"];
       			$checkoutdate= $_POST["CheckoutDate"];
       			$roomtype = $_POST["RoomType"];

	
    		$link = mysqli_connect("localhost","root","","hotel")
            or die("無法開啟MySQL資料庫連接!<br/>");

   			//送出UTF8編碼的MySQL指令
    		mysqli_query($link, 'SET NAMES utf8'); 

			$sql = "INSERT INTO orderlist (訂購者姓名, 手機號碼, email, 入住日期, 退房日期, 房型)
			VALUES ('$name', '$phonenumber', '$email', '$checkindate', '$checkoutdate', '$roomtype')";

			if ($link->query($sql) === TRUE) {
	  		echo "<center><font color='black'>";
	  		echo "New record created successfully，點擊跳轉回訂房頁面<br>";
	  		echo '<a href="http://localhost/hotel/order.html" >訂房頁面</a>';
	  		//header("Location: login.html");
			} else {
	  		echo "Error: " . $sql . "<br>" . $link->error;
			}

			$link->close();
		

			}
		

?>
</body>
</html>