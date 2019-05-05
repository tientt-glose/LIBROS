<!-- hr -->
<div class="container-fluid">
    <div class="row">
        <div class="col-10 mx-auto" style="margin-top: 10px">
            <hr>
        </div>
    </div>
</div>
<br>
<div class="container" style="background-color:#be2a2b;color: white;padding: 14px 20px;text-align: center">
    <b>THÔNG TIN CÁ NHÂN</b>
</div>
<br>
<br>
<?php
$user = check_username($_SESSION['Username']);
$row_user = mysqli_fetch_array($user);
?>
<?php
if (isset($_POST["btnSua"]))
{
	$Hoten = $_POST["Hoten"];
	$Diachi = $_POST["Diachi"];
	$SDT = $_POST["SDT"];
	$Ngaysinh = $_POST["Ngaysinh"];
	$Email = $_POST["Email"];
	$Gioitinh = $_POST["Gioitinh"];
	$ID_User= $row_user['ID_User'];
	 $qr="
	 	UPDATE users SET
		Hoten='$Hoten',
		Diachi='$Diachi',
		SDT='$SDT',
		Ngaysinh='$Ngaysinh',
		Email='$Email',
		Gioitinh='$Gioitinh'
		where ID_User='$ID_User'
	";
	
	$res = mysqli_query(myConnect(),$qr);
	/*if (!$res) {
    printf("Error: 1 %s\n", mysqli_error(myConnect()));
    exit();*/
	//header("location:listSach.php?trang=$trang");
}
?>
<div class="container">
    <div class="row">
        <div class="col">
           	<img src="../img/img_avatar.png" width="280" height="auto" alt="book_preview"/> 
        </div>
        <div class="col" style="display: block;">
            <form id="form1" name="form1" method="post">
              <table width="800" border="1">
                <tbody>
                  <tr>
                   <td><b>Họ và tên:</b></td>
                    <td><input type="text" name="Hoten" value="<?php echo $row_user['Hoten']?>" id="Hoten"></td>
                  </tr>
                  <tr>
                    <td><b>Địa chỉ:</b></td>
                    <td><input type="text" name="Diachi" value="<?php echo $row_user['Diachi']?>" id="Diachi"></td>
                  </tr>
                  <tr>
                    <td><b>Số điện thoại:</b></td>
                    <td><input type="number" name="SDT" value="<?php echo $row_user['SDT']?>" id="SDT"></td>
                  </tr>
                  <tr>
                    <td><b>Ngày sinh:</b></td>
                    <td><input type="date" name="Ngaysinh" value="<?php echo $row_user['Ngaysinh']?>" id="Ngaysinh"></td>
                  </tr>
                  <tr>
                    <td><b>Email:</b></td>
                    <td><input type="text" name="Email" value="<?php echo $row_user['Email']?>" id="Email"></td>
                  </tr>
                  <tr>
                    <td><b>Giới tính:</b></td>
                    <td><input type="text" name="Gioitinh" value="<?php echo $row_user['Gioitinh']?>" id="Gioitinh"></td>
                  </tr>
                  <tr>
                    <td><b>Ngày đăng ký:</b></td>
                    <td><?php echo $row_user['Ngaydangky']?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="btnSua" id="btnSua" value="Sửa"></td>
                  </tr>
                </tbody>
              </table>
            </form>
            <p>
              <?php
            if($row_user['Groups']==1)
                {
                 ?>
          </p>
          <p><a href="admin"><button class="confirmbtn"><i class="fas fa-cog" style="margin-right: 10px"></i>ADMIN PANNEL</button></a></p>
            <?php
                }
            ?>
        </div>
    </div>
</div>