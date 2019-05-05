<?php
require("../lib/quantri.php");
require("../lib/dbCon.php");
ob_start();
session_start(); 
if (!isset($_SESSION["ID_User"]) || $_SESSION["Groups"]==0){
	header("location:../index.php");
}
?>
<?php 
if (isset($_GET["p"])) $p = $_GET["p"];
    else $p ="";

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
       
      <b> <div class="active"> <a href="timkiem.php" > <i class="fas fa-search" style="margin-left: 10px;"> </i> </a></div> &nbsp; Hello, <?php echo $_SESSION["Hoten"] ?></b>
         </div></td>
    </tr>
    <tr>
      <td id="hangMenu"><?php require ("menu.php"); ?></td>
    </tr>
    <tr>
      <td><table width="1137" border="1">
        <tbody>
          <tr>
            <td colspan="11" style="text-align: center; font-weight: 600; font-size: 30px;">DANH SÁCH KHO</td>
          </tr>
          
          <tr>
            <td width="72" style="text-align: center">ID </td>
            <td width="297" style="text-align: center">Tên</td>
            <td width="118" style="text-align: center">Số lượng tồn</td>
            <td width="153" style="text-align: center">Số lượng bán</td>
            <td width="177" style="text-align: center">Tổng sách nhập vào</td>
            
            <td width="143" style="text-align: center">Trạng thái</td>
            <td width="131"><a href="themSach.php" style="text-align: center">Thêm</a></td>
          </tr>
          <?php
			$sosach1trang=10;
			if (isset($_GET["trang"]))
			{
				$trang=$_GET["trang"];
				settype($trang,"int");
			}
			else {
				$trang=1;
			}
			$from=($trang -1)*$sosach1trang;
			$sach = DanhSachKho_page($from,$sosach1trang);
			//search ve lenh
			while($row_sach=mysqli_fetch_array($sach)) {
				ob_start();
			?>
          <tr>
            <td rowspan="2" style="text-align: center">{IDSach}<br>
            </td>
            <td rowspan="2" style="text-align: center"><a href="suaSach.php?id={IDSach}">{Tensach}</a></td>
            <td rowspan="2" style="text-align: center">{SLTon}</td>
            <td rowspan="2" style="text-align: center">{SLBan}</td>
            <td rowspan="2" style="text-align: center">{Tong}</td>
            <td style="text-align: center">{AnHien}</td>
            <td rowspan="2"><a href="suaSach.php?id={IDSach}">Sửa</a> - <a onclick="return confirm('Bạn có chắc là muốn xóa không?')" href="xoaSach.php?id={IDSach}">Xóa</a></td>
          </tr>
          <tr>
            <td style="text-align: center">{SLTon2}</td>
          </tr>
          <?php 
				// search ve lenh
			$s = ob_get_clean();
			$s = str_replace("{IDSach}",$row_sach["ID_Sach"],$s);
			$s = str_replace("{Tensach}",$row_sach["Tensach"],$s);
			$s = str_replace("{SLTon}",$row_sach["SLTon"],$s);
			//sach$s = str_replace("{IDSach}",$row_sach["ID_Sach"],$s);
			$s = str_replace("{SLBan}",$row_sach["SLBan"],$s);	
			$s = str_replace("{Tong}",$row_sach["Tong"],$s);
				if ($row_sach["an_hien"]==1) $s = str_replace("{AnHien}","Hiện",$s);
				else $s = str_replace("{AnHien}","Ẩn",$s);
				if ($row_sach["SLTon"]!=0) $s = str_replace("{SLTon2}","Còn",$s);
				else $s = str_replace("{SLTon2}","Hết",$s);
			//$s = str_replace("{AnHien}",$row_sach["an_hien"],$s);	
			echo $s; }
			?>
        </tbody>
      </table>
      <hr/>
      <div id="phantrang"><?php 
		  $t= DanhSachKho();
		   $tongsosach=mysqli_num_rows($t);
		   $tongsotrang=ceil($tongsosach/$sosach1trang);
		  for ($i=1; $i<=$tongsotrang;$i++)
		  {
			?>  
			<a <?php if ($i==$trang) echo "style='background-color: red'"?>href="listKho.php?trang=<?php echo $i?>"> <?php echo $i?></a>
		  <?php }
		  ?></div></td>
    </tr>
  </tbody>
</table>
</body>
</html>