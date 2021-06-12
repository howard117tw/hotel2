<?php 
  session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>display.php</title>
</head> 
<body>
<?php





  if(!isset($_SESSION["account"]) || ($_SESSION["account"]=="")){

    //前往登入頁面

    header("Location: login.php");
    exit;

  }else{


  

    if ( isset($_POST["orderid"])){
      $temp = $_POST["orderid"];
    }else{
      header("Location: login.php");
      exit;
    }

    $link = mysqli_connect("localhost","root","","hotel")
      or die("無法開啟MySQL資料庫連接!<br/>");
    mysqli_query($link, 'SET NAMES utf8');
  

    $sql = "SELECT * FROM orderlist WHERE 訂單編號=$temp";

    $result = mysqli_query($link, $sql)
      or die( mysqli_error($link));
    $row = mysqli_fetch_array($result, MYSQLI_NUM);

    if($row>0){
      $_SESSION["login_session"] = true;
      $_SESSION["orderid"] = $row[0];
      $_SESSION["name"] = $row[1];
      $_SESSION["phonenumber"] = $row[2];
      $_SESSION["email"] = $row[3];
      $_SESSION["checkindate"] = $row[4];
      $_SESSION["checkoutdate"] = $row[5];
      $_SESSION["roomtype"] = $row[6];
    }
    else{
      echo "查無資料<br>";
      echo '<a href="http://localhost/hotel/findorder.html">重新查詢</a>';
      exit;
    }
    


    mysqli_close($link);






  }

  ?>


	<form name="login" action="revise.php" method="post">
      <table  align="center" RULES=ROWS style="border-top:0px #FFFFFF solid; border-right:0px #FFFFFF solid; border-left:0px #FFFFFF solid;"cellspacing="1" cellpadding="5" border="1" class="table">
         <tr>
                <font size="6" >訂單資料
        </tr>
        <tr>
          <td width="16%" align="right">訂單編號:</td>
          <td width="84%"><input type="text" name="orderid" value= "<?php echo $_SESSION["orderid"] ?>" readonly> 
          </td>
        </tr>
        <tr>
          <td width="16%" align="right">訂購者姓名:</td>
          <td width="84%"><input type="text" name="name" value= "<?php echo $_SESSION["name"] ?>">
          </td>
        </tr>
        <tr>
          <td width="16%" align="right">手機號碼:</td>
          <td width="84%"><input type="text" name="phonenumber" value= "<?php echo $_SESSION["phonenumber"] ?>"></td>
        </tr>
        <tr>
          <td width="16%" align="right">email:</td>
          <td width="84%"><input type="text" name="email" value= "<?php echo $_SESSION["email"] ?>"></td>
        </tr>
        <tr>
          <td width="16%" align="right">入住日期:</td>
          <td width="84%"><input type="date" name="checkindate" value= "<?php echo $_SESSION["checkindate"] ?>"></td>
        </tr>
        <tr>
          <td width="16%" align="right">退房日期:</td>
          <td width="84%"><input type="date" name="checkoutdate" value= "<?php echo $_SESSION["checkoutdate"] ?>"></td>
        </tr>

        <tr>    
                <td width="16%" align="right">房型:</td>
                <td><select name="roomtype">
                    <option value="<?php echo $_SESSION["roomtype"] ?>"><?php echo $_SESSION["roomtype"] ?> </option>
                    <option value="單人房">單人房</option>
                    <option value="雙人房">雙人房</option>
                    <option value="家庭四人房">家庭四人房</option>
                </select> </td>
            </tr>

        <tr>
          <td><input type="submit" name="login" value="確認修改"></td>
        </table>  
    </form>

</body>
</html>