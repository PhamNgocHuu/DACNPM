<?php include('master_layout/header.php') ?>
<?php
include('connect.php');
$errors = []; 
$success = ""; 
?>

<?php
if (isset($_SESSION['taikhoan'])) {
    header('Location: index.php');
}
if (isset($_POST['submit'])) {
    $tendangnhap = trim($_POST['tendangnhap']);
    $matkhau = trim($_POST['matkhau']);

    $query = "SELECT id, tendangnhap, email, Hoten, sodienthoai FROM taikhoan WHERE (tendangnhap = '$tendangnhap' OR 'email = '$email') AND matkhau = '$matkhau'";
    $result = mysqli_query($connect, $query); 
    
    if (mysqli_num_rows($result) > 0) {
        $taikhoan = $result->fetch_array(MYSQLI_ASSOC); 
        $_SESSION['taikhoan'] = $taikhoan; 
        header('Location: index.php');
    } else {
        $errors[] = "Thông tin đăng nhập chưa đúng. Vui lòng đăng nhập lại";
    }
}
?>

<!-- Giao diện đăng nhập -->
<div class="container">
    <div class="row">
        <div class="col col-md-6 col-md-offset-3">
            <div class="panel panel-defaul">
                <div class="panel-heading">
                    Đăng nhập
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
                            <label for="username">Email hoặc tên đăng nhập</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Nhập Email hoặc tên đăng nhập">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
                        </div>

                        <button type="submit" class="btn btn-primary mt-4" name='submit'>Đăng nhập</button>
                        <button type="button" class="btn btn-primary mt-4">
                            <a href="forget-password.php">Quên mật khẩu</a>
                            <br>
                        <button type="button" class="btn btn-white mt-4">
                        <a href="regisin.php">Tạo tài khoản</a></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-12 col-md-5" style="height:100px; background-color: red;">

        </div> -->
    </div>
</div>

<?php include "master_layout/footer.php" ?>
<script src="./assets/js/login.js"></script>