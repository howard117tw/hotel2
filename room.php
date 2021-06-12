<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>房間狀態</title>
</head>
<body>
<?php
  session_start();
  if(!isset($_SESSION["account"]) || ($_SESSION["account"]=="")){

    //前往登入頁面

    header("Location: login.php");
    exit;

    }
    else
    {
    $link = mysqli_connect("localhost","root","","hotel");
    $sql = "SELECT * FROM room";
    mysqli_query($link, 'SET NAMES utf8');
    $result = mysqli_query($link, $sql)
      or die( mysqli_error($link));

    $total_fields=mysqli_num_fields($result); // 取得欄位數
    $total_records=mysqli_num_rows($result);  // 取得記錄數

    $_SESSION['a'] = array();




    for ($i=0;$i<$total_records;$i++) 
    {

    $row = mysqli_fetch_assoc($result); //將陣列以欄位名索引

  

  echo "$row[房號]&nbsp;&nbsp;";
  $_SESSION['key']="$i";
  $_SESSION['a']["$_SESSION[key]"]= $row['房號'];
  $id=$row['房號'];
  echo $_SESSION['a']["$_SESSION[key]"];
  echo "$row[房型]&nbsp;&nbsp;";
  echo "$row[定價]&nbsp;&nbsp;";
  //echo "$row[房間狀態]<br><br>";
  //echo '<a href="http://localhost/hotel2/roomrevise.html" >狀態修改</a>';

?>
  <!--
  <a href="http://localhost/hotel/roomrevise.php">更改房間狀態</a><br>
  -->
  
  <form name="roomrevise" action= "roomrevise.php?id=<?php echo $id;?>"  method="post">
    <select name="status">
    <option value="<?php echo "$row[房間狀態]"?>"><?php echo "$row[房間狀態]"?></option>
    <option value="空房">空房</option>
      <option value="已入住">已入住</option>
      <option value="未清潔">未清潔</option>

      </select>
      <?php //echo $_SESSION['a']["$_SESSION[key]"]; ?>
    <!--&nbsp;&nbsp;
    -->
    <input type="submit" name="revise" value="確認修改">
    <?php //echo $_SESSION['a']["$_SESSION[key]"]; ?>
  </form>
  
  <?php //echo $_SESSION['a']["$_SESSION[key]"]; ?>
  <br><br>
    





<?php

   } 
   
    
 
   

}
?>


</body>
</html>