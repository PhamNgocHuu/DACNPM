<?php include('master_layout/header.php') ?>
<?php
require('connect.php');
?>

<?php
if (isset($_SESSION['account'])) {
    header('Location: index.php');
}
$errors = []; 
$success = ""; 
date_default_timezone_set("Asia/Ho_Chi_Minh"); // xét timezone (múi giờ)
if (isset($_POST['submit'])) {
    $tendangnhap =  $_POST['tendangnhap'];
    $email =  $_POST['email'];
    $Hoten =  $_POST['Hoten'];
    $matkhau =  trim($_POST['matkhau']);
    $sodienthoai = trim($_POST['sodienthoai']);
    if (empty($Hoten)) { 
        $errors[] = "Họ tên không được để trống"; 
    }

    
    if (count($errors) == 0) {
        $query = "select * from taikhoan where tendangnhap = '{$tendangnhap}' OR email = '{$email}'"; 
        $result = mysqli_query($connect, $query); 
        
        if (mysqli_num_rows($result) > 0) { 
            
            $errors[] = "Tên đăng nhập hoặc email đã tồn tại";
        } else {
            
            $dt = date("Y-m-d H:i:s");
            $query = "insert into taikhoan values (null, '{$tendangnhap}', '{$email}', '{$Hoten}', '{$matkhau}', '{$sodienthoai}')";
            if (mysqli_query($connect, $query)) {
                $success = "Thêm tài khoản thành công";
            } else {
                $errors[] = "Thêm tài khoản thất bại: " . mysqli_error($connect); 
            }
        }
    }
}
?>
<!-- Giao diện đăng ký -->
<div class="container">
    <div class="row">
        <div class="col col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Đăng ký
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
                            <label for="username">Tên đăng nhập</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Nhập tên">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Nhập Email">
                        </div>
                        <div class="form-group">
                            <label for="fullname">Tên đầy đủ</label>
                            <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Nhập tên đầy đủ">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
                        </div>
                        <div class="form-group">
                            <label for="re_password">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" name="re_password" id="re_password" placeholder="Nhập lại mật khẩu">
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" min="10" max="10" class="form-control" name="phone" id="phone" placeholder="Nhập số điện thoại">
                        </div>
                        <div class="form-group">
                            <label for="gender">Giới tính</label>
                            <div class="radio-inline" for="male">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="NAM" checked>
                                Nam
                            </div>
                            <div class="radio-inline" for="female">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="NU">
                                Nữ
                            </div>
                        </div>
                   
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6"><button type="submit" name="submit" class="form-control btn btn-primary mt-4">Đăng Ký</button></div>
                            </div>


                        </div>


                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-12 col-md-5" style="height:100px; background-color: red;">

        </div> -->
    </div>
</div>
<?php include('master_layout/footer.php') ?>
<script src="./assets/js/regisin.js"></script>