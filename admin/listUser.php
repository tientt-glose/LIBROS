<?php
require("../lib/quantri.php");
require("../lib/dbCon.php");
ob_start();
session_start(); 
if (!isset($_SESSION["ID_User"]) || $_SESSION["Groups"]==0){
	header("location:../index.php");
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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
<table width="1000" border="1" align="center">
  <tbody>
    <tr>
      <td id="hangTieuDe">TRANG QUẢN TRỊ
      <div style="width: 400px; float: right">
      <b> <div class="active"> <a href="timkiem.php" > <i class="fas fa-search" style="margin-left: 10px;"> </i> </a></div> Hello, <?php echo $_SESSION["Hoten"] ?></b>
         </div></td>
      
    </tr>
    <tr>
    <td id="hangMenu"><?php require ("menu.php"); ?></td>
    </tr>
    <tr>
      <td><table width="1048" border="1">
        <tbody>
          <tr>
            <td colspan="10" style="text-align: center; font-size: 30px;"><strong>DANH SÁCH NGƯỜI DÙNG</strong></td>
            </tr>
          <tr>
            <td width="87" style="text-align: center">ID </td>
            <td width="129" style="text-align: center">Họ tên</td>
            <td width="82" style="text-align: center">Địa chỉ</td>
            <td width="90" style="text-align: center">SĐT</td>
            <td width="112" style="text-align: center">Ngày sinh</td>
            <td width="75" style="text-align: center">E-Mail</td>
            <td width="92" style="text-align: center">Giới tính</td>
            <td width="108" style="text-align: center">Ngày đăng ký</td>
            <td width="70" style="text-align: center">Quyền</td>
            <td width="139" style="text-align: center">Chức năng</td>
          </tr>
         <?php
			
			$soUser1trang=5;
			if (isset($_GET["trang"]))
			{
				$trang=$_GET["trang"];
				settype($trang,"int");
			}
			else {
				$trang=1;
			}
			$from=($trang -1)*$soUser1trang;
			$User = DanhSachUser_page($from,$soUser1trang);
			//search ve lenh
			while($row_User=mysqli_fetch_array($User)) {
				ob_start();
			?>
          <tr>
            <td style="text-align: center">{ID_User}</td>
            <td style="text-align: center"><a href="suaUser.php?id={ID_User}">{Ten}</a><br>
              <!--<img src=" /*$img= explode(".", $row_User["Hinhanh"]); 
				if ($img[0]<='274') echo "../upload/sach/images/{urlHINH}"; 
				else echo "../upload/sach/images/new/{urlHINH}"; //chuyen huong hinh vi ckfinder chi la demo*/?>"
				   width="150" height="212" alt=""/>--></td>
            <td style="text-align: center">{DiaChi}  </td>
            <td style="text-align: center">{SDT}</td>
            <td style="text-align: center">{NgaySinh}</td>
            <td style="text-align: center">{Mail}</td>
            <td style="text-align: center">{GioiTinh}</td>
            <td style="text-align: center">{NgayDK}</td>
            <td style="text-align: center">{Quyen}</td>
            <td style="text-align: center"><a href="suaUser.php?id={ID_User}">Thay đổi quyền</a> - <a onclick="return confirm('Bạn có chắc là muốn xóa người dùng này không?')" href="xoaUser.php?id={ID_User}">Xóa</a></td>
          </tr>
          <?php 
				// search ve lenh
			$s = ob_get_clean();
			$s = str_replace("{ID_User}",$row_User["ID_User"],$s);
			$s = str_replace("{Ten}",$row_User["Hoten"],$s);
			$s = str_replace("{DiaChi}",$row_User["Diachi"],$s);
			//sach$s = str_replace("{ID_User}",$row_User["ID_Sach"],$s);
			$s = str_replace("{SDT}",$row_User["SDT"],$s);	
			$s = str_replace("{NgaySinh}",$row_User["Ngaysinh"],$s);
			$s = str_replace("{Mail}",$row_User["Email"],$s);
			$s = str_replace("{GioiTinh}",$row_User["Gioitinh"],$s);	
			$s = str_replace("{NgayDK}",$row_User["Ngaydangky"],$s);
			//$s = str_replace("{Quyen}",$row_User["Groups"],$s);
			//$s = str_replace("{urlHINH}",$row_User["Hinhanh"],$s);
			
				if ($row_User["Groups"]==1) $s = str_replace("{Quyen}","Admin",$s);
				else $s = str_replace("{Quyen}","User",$s);
			//$s = str_replace("{Quyen}",$row_User["an_hien"],$s);	
			echo $s; }
			?>
      </table>
      <hr/>
      <div id="phantrang"><?php 
		  $t= DanhSachUser();
		   $tongsoUser=mysqli_num_rows($t);
		   $tongsotrang=ceil($tongsoUser/$soUser1trang);
		  for ($i=1; $i<=$tongsotrang;$i++)
		  {
			?>  
			<a <?php if ($i==$trang) echo "style='background-color: red'"?>href="listUser.php?trang=<?php echo $i?>"> <?php echo $i?></a>
		  <?php }
		  ?></div>
      </td>
    </tr>
  </tbody>
</table>
</body>
</html>