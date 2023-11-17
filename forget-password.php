<?php include "master_layout/header.php" ?>
<?php
if (isset($_SESSION['taikhoan'])) {
    header('Location: index.php');
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require ("connect.php");
$errors = []; 
$success = ""; 
date_default_timezone_set("Asia/Ho_Chi_Minh"); // xét timezone (múi giờ)

function generateRandomString($length = 10)
{
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}


if (isset($_POST['submit'])) {
    $email = trim($_POST["email"]);
    $tendangnhap = trim($_POST["tendangnhap"]);
 
    $query = "SELECT * FROM taikhoan where email = '{$email}' AND tendangnhap = '{$tendangnhap}'";
    $result = mysqli_query($connect, $query); 
    if (mysqli_num_rows($result) == 0) { 
        $errors[] = "Không tồn tại tài khoản cần tìm";
    } else {
        
        $dt = date("Y-m-d H:i:s");
        $password = generateRandomString(5);
        $query = "UPDATE taikhoan SET matkhau = '{$matkhau}' where email = '{$email}' AND tendangnhap = '{$tendangnhap}'";
        if (mysqli_query($connect, $query)) {
            
            $mail = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';

            
            $mail->isSMTP(); 
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true; 
            $mail->Username = 'phamngochuu@gmail.com'; 
            $mail->Password = '19092002'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            $mail->Port = 587; 
            //Recipients
            $mail->setFrom('phamngochuu@gmail.com', 'Pham Huu');
            $mail->addAddress($email, '');
            // Content
            $mail->isHTML(true);   
            $mail->Subject = 'Cấp lại mật khẩu';
            $mail->Body = "Mật khẩu mới của bạn là: <b>'{$password}'</b>";

            $mail->send();
            $success = "Mật khẩu đã được thay đổi và được gửi vào email của bạn";
        } else {
            $errors[] = "ĐỔi mật khẩu thất bại: " . mysqli_error($connect); 
        }
    }
}
?>

<!-- Giao diện đăng nhập -->
<div class="container">
    <div class="row">
        <div class="col col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Quên mật khẩu
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
                    <form method="POST" action="" onsubmit="return handeFormSubmit();">
                        <div class="form-group">
                            <label for="email">Email </label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Nhập Email">
                        </div>
                        <div class="form-group">
                            <label for="username">Tên đăng nhập</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Nhập tên">
                        </div>
                        <button type="submit" class="btn btn-primary mt-4" name="submit">Cấp lại mật khẩu</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-12 col-md-5" style="height:100px; background-color: red;">

        </div> -->
    </div>
</div>

<?php include "master_layout/footer.php" ?>
<script src="./assets/js/forget-password.js"></script>