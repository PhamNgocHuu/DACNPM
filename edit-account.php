<?php include "master_layout/header.php" ?>
<?php
if (!isset($_SESSION['taikhoan'])) {
    header('Location: login.php');
}
require('connect.php');
$errors = []; 
$success = ""; 
date_default_timezone_set("Asia/Ho_Chi_Minh"); // xét timezone (múi giờ)

$taikhoan = $_SESSION['taikhoan'];
$Hoten = isset($_POST['Hoten']) ? trim($_POST['Hoten']) : trim($taikhoan['Hoten']);
$sodienthoai = isset($_POST['sodienthoai']) ? trim($_POST['sodienthoai']) : trim($taikhoan['sodienthoai']);
$email = isset($_POST['email']) ? trim($_POST['email']) : trim($taikhoan['email']);
if (isset($_POST['delete'])) {

    $query = "DELETE FROM taikhoan WHERE id = '{$taikhoan['id']}'";
    $result = mysqli_query($connect, $query);
    if ($result) {
       
        session_destroy();
        
        header("Location:index.php");
        
        echo '<script language="javascript">';
        echo 'alert(Bạn đã xóa tài khoản thành công)';  //not showing an alert box.
        echo '</script>';
    } else {
        $errors[] = "Xóa tài khoản thất bại: " . mysqli_error($connect); 
    }
}

if (isset($_POST['submit'])) {
    
    $dt = date("Y-m-d H:i:s");
    $query = "UPDATE taikhoan SET Hoten = '{$Hoten}', sodienthoai = '{$sodienthoai}', email = '{$email}' WHERE id = '{$taikhoan['id']}'";
    $result = mysqli_query($connect, $query);
    if ($result) {
        $query = "SELECT * FROM taikhoan WHERE id = '{['$id']}'";
        $result = mysqli_query($connect, $query);
        $account = $result->fetch_array(MYSQLI_ASSOC);
        $_SESSION['taikhoan'] = $taikhoan;
        $success = "Sửa tài khoản thành công";
    } else {
        $errors[] = "Sửa tài khoản thất bại: " . mysqli_error($connect); 
    }
}

?>
<!-- Giao diện đăng nhập -->
<div class="container">
    <div class="row">
        <div class="col col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Sửa thông tin tài khoản
                </div>
                <div class="panel-body">
                    <?php if (count($errors) > 0) : ?>
                        <?php for ($i = 0; $i < count($errors); $i++) : ?>
                            <p class="errors" style="color: red;"> <?php echo $errors[$i]; ?> </p>
                        <?php endfor; ?>
                    <?php endif; ?>
                    <?php if ($success) : ?>
                        <p class="success" style="color: green;"> <?php echo $success; ?> </p>
                    <?php endif; ?>
                    <form method="post" action="" onsubmit="return handeFormSubmit();">
                        <div class="form-group">
                            <label for="Hoten">Tên đầy đủ</label>
                            <input type="text" class="form-control" name="Hoten" id="Hoten" placeholder="Nhập tên đầy đủ" value="<?php echo $Hoten ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="sodienthoai">Số điện thoại</label>
                            <input type="text" min="10" max="10" class="form-control" name="sodienthoai" id="sodienthoai" placeholder="Nhập số điện thoại" value=<?php echo $sodienthoai ?> />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="date" class="form-control" name="email" id="email" placeholder="Nhập email" value=<?php echo $email ?> />
                        </div>
                        <button type="submit" class="btn btn-primary mt-4" name="submit">Sửa thông tin</button>
                        <button type="submit" onclick="return handeSubmitDelete()" name="delete" class="btn btn-danger mt-4">Xóa tài khoản</button>

                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-12 col-md-5" style="height:100px; background-color: red;">

        </div> -->
    </div>
</div>
<script src="./assets/js/edit-account.js"></script>
<?php include "master_layout/footer.php" ?>