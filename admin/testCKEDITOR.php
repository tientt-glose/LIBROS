<?php
require("../lib/quantri.php");
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
if (isset($_POST["btnThem"]))
{
	$TenSach = $_POST["Tensach"];
	$TacGia = $_POST["Tacgia"];
	$TheLoai = $_POST["idTL"];
	$NXB = $_POST["idNXB"];
	$NamXB = $_POST["NamXB"];
		settype($NamXB,"int");
	$SoTrang = $_POST["Trang"];
		settype($SoTrang,"int");
	$GiaSach = $_POST["GiaSach"];
		settype($GiaSach,"int");
	$HinhAnh = $_POST["upHinh"];
	
	$AnHien = $_POST["AnHien"];
		settype($AnHien,"int");
	 echo $qr="
		INSERT INTO sach(Tensach,Tacgia,ID_Theloai,ID_NXB,NamXB,Sotrang,Giasach,Hinhanh,an_hien) 
		VALUES(
		 '$TenSach', '$TacGia', '$TheLoai', '$NXB', '$NamXB', '$SoTrang', '$GiaSach', '$HinhAnh',  '$AnHien' 
		)
	";
	$res = mysqli_query(myConnect(),$qr);
	/*if (!$res) {
    printf("Error: 1 %s\n", mysqli_error(myConnect()));
    exit();*/
	header("location:listSach.php");
}}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="layout.css"/>
<script src="ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	function BrowseServer2() {
		document.getElementById("demo").innerHTML = "Hello World";
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
      <td id="hangTieuDe">TRANG QUẢN TRỊ</td>
    </tr>
    <tr>
      <td id="hangMenu"><?php require ("menu.php"); ?></td>
    </tr>
    <tr>
      <td><form id="form1" name="form1" method="post">
        <table width="800" border="1">
          <tbody>
            <tr>
              <td colspan="2" align="center">THÊM NỘI DUNG SÁCH</td>
              </tr>
            <tr>
              <td>Tên sách</td>
              <td><input type="text" name="Tensach" id="Tensach"></td>
            </tr>
            <tr>
              <td>Tác giả</td>
              <td><input type="text" name="Tacgia" id="Tacgia">
                <label for="textarea">Text Area:</label>
                <textarea name="textarea" id="textarea" rows="10" cols="80"></textarea>
                <script type="text/javascript">CKEDITOR.replace('textarea',
																{
				
	filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
    filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserWindowWidth: '1000',
    filebrowserWindowHeight: '700',
	uiColor : '#AADC6E',
	
}); </script>
                </td>
            </tr>
            <tr>
              <td>Thể loại</td>
              <td><select name="idTL" id="idTL">
                <?php 
				$theloai=DanhSachTheLoai();
				while($row_theloai=mysqli_fetch_array($theloai)) {
				?>
                <option value="<?php echo $row_theloai["ID_Theloai"]?>"><?php echo $row_theloai["Theloai"]?></option>
               <?php
				}
				?>
              </select></td>
            </tr>
            <tr>
              <td>Nhà xuất bản</td>
              <td><select name="idNXB" id="idNXB">
                <?php
				$nxb=DanhSachNXB();
				while($row_nxb=mysqli_fetch_array($nxb)) {
					?>
                <option value="<?php echo $row_nxb["ID_NXB"]?>"> <?php echo $row_nxb["Ten_NXB"]?> </option>
                <?php } ?>
              </select></td>
            </tr>
            <tr>
              <td>Năm xuất bản</td>
              <td><input type="number" name="NamXB" id="NamXB"></td>
            </tr>
            <tr>
              <td>Số trang</td>
              <td><input type="number" name="Trang" id="Trang"></td>
            </tr>
            <tr>
              <td>Giá sách</td>
              <td><input type="number" name="GiaSach" id="GiaSach"></td>
            </tr>
            <tr>
              <td>Hình ảnh</td>
              <td><p>
                <input type="text" name="upHinh" id="upHinh">
                <input onclick="BrowseServer2()" type="button" name="btnChonFile" id="btnChonFile" value="Chọn file">
              </p>
                <p id="demo">&nbsp;</p></td>
            </tr>
            <tr>
              <td>Ẩn/Hiện</td>
              <td><p>
                <label>
                  <input type="radio" name="AnHien" value="1" id="AnHien_0">
                  Hien</label>
                <br>
                <label>
                  <input type="radio" name="AnHien" value="0" id="AnHien_1">
                  An</label>
                <br>
              </p></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="btnThem" type="submit" id="btnThem" value="Thêm"></td>
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