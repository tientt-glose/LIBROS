<?php
require("../lib/quantri.php");
require("../lib/dbCon.php");
ob_start();
session_start(); 
if (!isset($_SESSION["ID_User"]) || $_SESSION["Groups"]==0){
	header("location:../index.php");
}
if (isset($_GET["p"]))
	$p = $_GET["p"];
else
	$p ="";
 /*if (isset($_GET["ID_TheLoai"]))
		$IDTL = $_GET["ID_TheLoai"];
	  else
		$IDTL ="";
if (isset($_GET["ID_Sach"]))
		$IDS = $_GET["ID_Sach"];
	  else
		$IDS ="";*/
?>
<?php
$idSach=$_GET["id"];
$qr="DELETE FROM sach
WHERE ID_Sach='$idSach'";
mysqli_query(myConnect(),$qr);
$qr2="DELETE FROM soluong
WHERE ID_Sach='$idSach'";
mysqli_query(myConnect(),$qr2);
header("location:listSach.php");
?>