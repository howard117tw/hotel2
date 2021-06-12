<!DOCTYPE html>
<html>
<head>
  <title>登入</title>
</head>
<body>
<?php 
	session_start(); //啟用交談期
	$account = ""; $password = "";

	//取得表單欄位值
	if ( isset($_POST["username"]))
		$account = $_POST["username"];
	if ( isset($_POST["password"]))
		$password = $_POST["password"];
	
	// 檢查是否輸入使用者名稱和密碼
    if ($account != "" && $password != "") {
      // 建立MySQL的資料庫連接 
      $link = mysqli_connect("localhost","root","","hotel")
          or die("無法開啟MySQL資料庫連接!<br/>");

    	mysqli_query($link, 'SET NAMES utf8');

    // 建立SQL指令字串
    	$sql = "SELECT * FROM employee WHERE 員工id='$account'";
    	//$sql.= $password."' AND account='".$account."'";

    // 執行SQL查詢
    	$result = mysqli_query($link, $sql)
    	 or die( mysqli_error($link));

    	$total_records = mysqli_num_rows($result);//取得資料筆數
    	if($total_records == 0){
          echo "<center><font color='red'>";
          echo "使用者名稱或密碼錯誤!<br/>";
          echo '<a href="http://localhost/hotel/login.html" >重新登入</a>';
          echo "</font>";
          $_SESSION["login_session"] = false;



    	}
    	//$total_records = mysqli_num_rows($result);//取得資料筆數
    	
    	$row = mysqli_fetch_array($result, MYSQLI_NUM)
    	 or die( mysqli_error($link));
    	//$row = mysqli_num_rows($result);
    	 

 	// 是否有查詢到使用者記錄
       if ( $row[0]==$account && $row[1] == $password) {
       	//echo "777<br/>";
       	header("Location: functionpage.html");
          // 成功登入, 指定Session變數
       	$_SESSION["login_session"] = true;
        $_SESSION["account"] = $row[0];
        $_SESSION["password"] = $row[1];

/*          
          $_SESSION["account"] = $row[0];
          $_SESSION["password"] = $row[1];
          $_SESSION["name"] = $row[2];
          $_SESSION["email"] = $row[3];
          $_SESSION["skype"] = $row[4];
          $_SESSION["graduate"] = $row[5];
          header("Location: display.php");
*/
          //header("refresh:0;url=index.html");
          exit;
       } 
       else {  // 登入失敗
          echo "<center><font color='red'>";
          echo "使用者名稱或密碼錯誤!<br/>";
          echo '<a href="http://localhost/hotel/login.html" >重新登入</a>';
          echo "</font>";
          $_SESSION["login_session"] = false;
       }
       mysqli_close($link);  // 關閉資料庫連接 
	}
	else{
		echo '<script language="JavaScript">;alert("請輸入員工ID及密碼!!");location.href="http://localhost/hotel/login.html";</script>;';
	}

 ?>
</body>
</html>