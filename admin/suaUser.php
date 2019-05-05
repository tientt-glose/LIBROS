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
	$idUser=$_GET["id"]; //$_GET lay text cua mot bien nao do
	//echo $idSach; 
	$row_chitietUser=ChiTietUser($idUser);
	//echo $row_chitietSach;
?>

<?php
if (isset($_POST["btnSua"]))
{
	
	$Groups = $_POST["Groups"];
		settype($Groups,"int");
	 $qr="
	 	UPDATE users SET
		Groups='$Groups'
		where ID_User='$idUser'
	";
	$res = mysqli_query(myConnect(),$qr);
	/*if (!$res) {
    printf("Error: 1 %s\n", mysqli_error(myConnect()));
    exit();*/
	header("location:listUser.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="layout.css"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	function BrowseServer2() {
		//cument.getElementById("demo").innerHTML = "Hello World";
		CKFinder.popup( {
                 chooseFiles: true,
                 onInit: function( finder ) {
                     finder.on( 'files:choose', function( evt ) {
                         var file = evt.data.files.first();
                         document.getElementById( 'upHinh' ).value = file.getUrl();
                     } );
                     finder.on( 'file:choose:resizedImage', function( evt ) {
                         document.getElementById( 'upHinh' ).value = evt.data.resizedUrl;
                     } );
                 }
             } );
		
	}
	function BrowseServer(startupPath, functionData) {
		var finder= new CKFinder();
		finder.basePath='ckfinder/';
		finder.startupPath=startupPath;
		finder.selectActionFunction=SetFileField();
		finder.selectActionData=functionData;
		//finder.selectThumbnailActionFunction=ShowThumbnails;
		finder.popup();
		
	}
	function SetFileField(fileUrl,data){
		document.getElementById(data["selectActionData"]).value=fileUrl;
	}
	function ShowThumbnails(fileUrl,data){
		var sFileName= this.getSelectedFile().name;
		document.getElementById('thumbnails').innerHTML +=
			'<div class="thumb">' +
			'<img src="' + fileUrl + '"/>' +
			'<div class="caption">' +
			'<a href="' + data["fileUrl"] + '"target="_blank">' +sFileName + '</a>  ('+ data["fileSize"] + 'KB)' +                    
			'</div>' +
				'</div>';
		document.getElementById('preview').style.display="";
		return false;
	}
	</script>

</head>

<body>
<table width="1000" border="1" align="center">
  <tbody>
    <tr>
      <td id="hangTieuDe">TRANG QUẢN TRỊ
       <div style="width: 200px; float: right">
      <b> Hello, <?php echo $_SESSION["Hoten"] ?></b>
         </div></td>
     
    </tr>
    <tr>
      <td id="hangMenu"><?php require ("menu.php"); ?></td>
    </tr>
    <tr>
      <td><form id="form1" name="form1" method="post">
        <table width="996" border="1">
          <tbody>
            <tr>
              <td colspan="2" align="center"><strong>SỬA QUYỀN USER</strong></td>
              </tr>
            <tr>
              <td width="129">ID - Tên</td>
              <td width="851"><?php echo $row_chitietUser["ID_User"]?> - <?php echo $row_chitietUser["Hoten"]?></td>
            </tr>
            <tr>
              <td>Quyền</td>
              <td><p>
                <label>
                  <input <?php if ($row_chitietUser["Groups"]==1) echo "checked='checked'";?> type="radio" name="Groups" value="1" id="Groups_0">
                  Admin</label>
                <br>
                <label>
                  <input <?php if ($row_chitietUser["Groups"]==0) echo "checked='checked'";?> type="radio" name="Groups" value="0" id="Groups_1">
                  User</label>
              </p></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" name="btnSua" id="btnSua" value="Sửa"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </tbody>
        </table>
      </form></td>
    </tr>
  </tbody>
</table>
</body>
</html>