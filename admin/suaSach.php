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
	$idSach=$_GET["id"]; //$_GET lay text cua mot bien nao do
	//echo $idSach; 
	$row_chitietSach=ChiTietSach($idSach);
	//echo $row_chitietSach;
?>
<?php
if (isset($_POST["btnSua"]))
{
	if (isset($_GET["trang"]))
			{
				$trang=$_GET["trang"];
				settype($trang,"int");
			}
			else {
				$trang=1;
			}
	$TenSach = $_POST["Tensach"];
	$TacGia = $_POST["Tacgia"];
	$TacGia = str_replace( '\'', '\'\'', $TacGia );
	$TheLoai = $_POST["idTL"];
	$NXB = $_POST["idNXB"];
	$NamXB = $_POST["NamXB"];
		settype($NamXB,"int");
	$SoTrang = $_POST["Trang"];
		settype($SoTrang,"int");
	$GiaSach = $_POST["GiaSach"];
		settype($GiaSach,"int");
	 $HinhAnh = $_POST["upHinh"];
		$nhapSach=$_POST["nhapSach"];
	 
	if ($HinhAnh!=$row_chitietSach["Hinhanh"]) {
	if ($idSach<=273) $HinhAnh= substr( $HinhAnh,'30');  else $HinhAnh= substr( $HinhAnh,'34');}
	$AnHien = $_POST["AnHien"];
		settype($AnHien,"int");
	 
	 $qr="
	 	UPDATE sach SET
		Tensach='$TenSach',
		Tacgia='$TacGia',
		ID_Theloai='$TheLoai',
		ID_NXB='$NXB',
		NamXB='$NamXB',
		Sotrang='$SoTrang',
		Giasach='$GiaSach',
		Hinhanh='$HinhAnh',
		an_hien='$AnHien'
		where ID_Sach='$idSach'
	";
	 echo $qr2="
	 	UPDATE soluong SET
		SLTon=SLTon+'$nhapSach',
		Tong=Tong+'$nhapSach'
		where ID_Sach='$idSach'
	";
	$res = mysqli_query(myConnect(),$qr);
	mysqli_query(myConnect(),$qr2);
	/*if (!$res) {
    printf("Error: 1 %s\n", mysqli_error(myConnect()));
    exit();*/
	header("location:listSach.php?trang=$trang");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="layout.css"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"/>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="sckeditor/ckeditor.js"></script>
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
      <td><form method="post" enctype="multipart/form-data" name="form1" id="form1">
        <table width="992" border="1">
          <tbody>
            <tr>
              <td colspan="3" align="center"><strong>SỬA NỘI DUNG SÁCH</strong></td>
              </tr>
            <tr>
              <td width="278">Tên sách</td>
              <td colspan="2"><input value="<?php echo $row_chitietSach["Tensach"]?>" type="text" name="Tensach" id="Tensach"></tr>
            <tr>
              <td>Tác giả</td>
              <td colspan="2"><input value="<?php echo $row_chitietSach["Tacgia"]?>" type="text" name="Tacgia" id="Tacgia"></td>
            </tr>
            <tr>
              <td>Thể loại</td>
              <td colspan="2"><select value="<?php echo $row_chitietSach["Theloai"]?>" name="idTL" id="idTL">
                <?php 
				$theloai=DanhSachTheLoai();
				while($row_theloai=mysqli_fetch_array($theloai)) {
				?>
                <option <?php if($row_chitietSach["ID_Theloai"]==$row_theloai["ID_Theloai"]) echo "selected='selected'" ?> value="<?php echo $row_theloai["ID_Theloai"]?>"><?php echo $row_theloai["Theloai"]?></option>
               <?php
				}
				?>
              </select></td>
            </tr>
            <tr>
              <td>Nhà xuất bản</td>
              <td colspan="2"><select name="idNXB" id="idNXB">
                <?php
				$nxb=DanhSachNXB();
				while($row_nxb=mysqli_fetch_array($nxb)) {
					?>
                <option <?php if($row_chitietSach["ID_NXB"]==$row_nxb["ID_NXB"]) echo "selected='selected'" ?> value="<?php echo $row_nxb["ID_NXB"]?>"> <?php echo $row_nxb["Ten_NXB"]?> </option>
                <?php } ?>
              </select></td>
            </tr>
            <tr>
              <td>Năm xuất bản</td>
              <td colspan="2"><input value="<?php echo $row_chitietSach["NamXB"]?>" type="number" name="NamXB" id="NamXB"></td>
            </tr>
            <tr>
              <td>Số trang</td>
              <td colspan="2"><input value="<?php echo $row_chitietSach["Sotrang"]?>" type="number" name="Trang" id="Trang"></td>
            </tr>
            <tr>
              <td>Giá sách</td>
              <td colspan="2"><input value="<?php echo $row_chitietSach["Giasach"]?>" type="number" name="GiaSach" id="GiaSach"></td>
            </tr>
            <tr>
              <td>Hình ảnh</td>
              <td colspan="2"><p>
                <input value="<?php echo $row_chitietSach["Hinhanh"]?>" type="text" name="upHinh" id="upHinh">
                <input onclick="BrowseServer2()" type="button" name="btnChonFile" id="btnChonFile" value="Chọn file">
              </p>
                </td>
            </tr>
            <tr>
              <td>Ẩn/Hiện</td>
              <td colspan="2"><p>
                <label>
                  <input <?php if ($row_chitietSach["an_hien"]==1) echo "checked='checked'";?> type="radio" name="AnHien" value="1" id="AnHien_0">
                  Hiện</label>
                <br>
                <label>
                  <input <?php if ($row_chitietSach["an_hien"]==0) echo "checked='checked'";?> type="radio" name="AnHien" value="0" id="AnHien_1">
                  Ẩn</label>
                <br>
              </p></td>
            </tr>
            <tr>
              <td>Nhập thêm sách (</td>
              <td width="346">Có <?php echo $row_chitietSach["SLTon"]?> quyển trong kho </td>
              <td width="346">Thêm <input type="number" name="nhapSach" id="nhapSach"> quyển </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2"><input type="submit" name="btnSua" id="btnSua" value="Sửa"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
          </tbody>
        </table>
      </form></td>
    </tr>
  </tbody>
</table>
</body>
</html>