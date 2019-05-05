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
      <td><table width="1048" border="1">
<body>
    <tr>
      <td><table width="1048" border="1" align="center">
        <tbody>
           <tr>
            <td width="99" style="text-align: center">ID </td>
            <td width="150" style="text-align: center">Tên</td>
            <td width="79" style="text-align: center">Tác giả</td>
            <td width="103" style="text-align: center">Thể loại</td>
            <td width="119" style="text-align: center">NXB</td>
            <td width="83" style="text-align: center">Số trang</td>
            <td width="84" style="text-align: center">Năm XB</td>
            <td width="95" style="text-align: center">Giá</td>
            <td width="91" style="text-align: center">Trạng thái</td>
            <td width="81"><a href="themSach.php" style="text-align: center">Thêm</a></td>
          </tr>
          <?php
			$tukhoa=$_GET["search"];
			$sosach1trang=2;
			if (isset($_GET["trang"]))
			{
				$trang=$_GET["trang"];
				settype($trang,"int");
			}
			else {
				$trang=1;
			}
			$from=($trang -1)*$sosach1trang;
			$sach = DanhSachBook_searchpage($from,$sosach1trang,$tukhoa);
			//search ve lenh
			while($row_sach=mysqli_fetch_array($sach)) {
				ob_start();
			?>
          <tr>
            <td style="text-align: center"><p>{IDSach}<br>
            </p></td>
            <td style="text-align: center"><a href="suaSach.php?id={IDSach}">{Tensach}</a><br>
              <img style='max-width: 100%; height: auto;' src="<?php $img= explode(".", $row_sach["Hinhanh"]); 
				if ($img[0]<='274') echo "../upload/sach/images/{urlHINH}"; 
				else echo "../upload/sach/images/new/{urlHINH}"; //chuyen huong hinh vi ckfinder chi la demo?>" 
			   alt=""  id="imgS"/></td>
            <td style="text-align: center">{Tacgia}  </td>
            <td style="text-align: center"><p>{Theloai}</p></td>
            <td style="text-align: center">{NXB}</td>
            <td style="text-align: center">{Sotrang}</td>
            <td style="text-align: center">{NamXB}</td>
            <td style="text-align: center">{Giasach}</td>
            <td style="text-align: center">{AnHien}</td>
            <td><a href="suaSach.php?id={IDSach}">Sửa</a> - <a onclick="return confirm('Bạn có chắc là muốn xóa không?')" href="xoaSach.php?id={IDSach}">Xóa</a></td>
          </tr>
          <?php 
				// search ve lenh
			$s = ob_get_clean();
			$s = str_replace("{IDSach}",$row_sach["ID_Sach"],$s);
			$s = str_replace("{Tensach}",$row_sach["Tensach"],$s);
			$s = str_replace("{Tacgia}",$row_sach["Tacgia"],$s);
			//sach$s = str_replace("{IDSach}",$row_sach["ID_Sach"],$s);
			$s = str_replace("{Theloai}",$row_sach["Theloai"],$s);	
			$s = str_replace("{NXB}",$row_sach["Ten_NXB"],$s);
			$s = str_replace("{Giasach}",$row_sach["Giasach"],$s);	
			$s = str_replace("{Sotrang}",$row_sach["Sotrang"],$s);
			$s = str_replace("{NamXB}",$row_sach["NamXB"],$s);	
			$s = str_replace("{urlHINH}",$row_sach["Hinhanh"],$s);
				if ($row_sach["an_hien"]==1) $s = str_replace("{AnHien}","Hiện",$s);
				else $s = str_replace("{AnHien}","Ẩn",$s);
			//$s = str_replace("{AnHien}",$row_sach["an_hien"],$s);	
			echo $s; }
			?>
        </tbody>
      </table>
      <hr/>
      <div id="phantrang"><?php 
		  $t= DanhSachBook_search($tukhoa);
		   $tongsosach=mysqli_num_rows($t);
		   $tongsotrang=ceil($tongsosach/$sosach1trang);
		  for ($i=1; $i<=$tongsotrang;$i++)
		  {
			?>  
			<a <?php if ($i==$trang) echo "style='background-color: red'"?>href="listSach.php?trang=<?php echo $i?>"> <?php echo $i?></a>
	  <?php }
		  ?></div></td>
    </tr>
  </tbody>
</table>
</body>
</html>