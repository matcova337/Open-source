<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <?php
  if (isset($_POST['submit-login'])) {
    $input_email = $_POST['input_email'];
    $input_password = $_POST['input_password'];
    $action = "#";

    $check_email = "SELECT * FROM `khachhang` WHERE Email = '$input_email'";
    $result_email = mysqli_query($conn, $check_email);

    if ($result_email) {
      if (mysqli_num_rows($result_email) > 0) {
        $row = mysqli_fetch_assoc($result_email);
        $hashedPassword = $row['MatKhau'];

        if (password_verify($input_password, $hashedPassword)) {
          $_SESSION['loggedin'] = true; // Lưu trạng thái đăng nhập
          $_SESSION['email'] = $row['Email']; // Lưu email của người dùng
          header("Location: index.php");
        } else {
          $msg = "Mật khẩu không đúng";
        }
      } else {
        $msg = "Tài khoản không tồn tại";
      }
    } else {
      echo "Lỗi truy vấn: " . mysqli_error($conn);
    }
  }
  ?>
  <div class="container">
    <div class="container-login-signin">
      <form action="" method="post">
        <div class="title">Đăng nhập</div>
        <div>
          <?php
          if (isset($msg))
            echo $msg;
          ?>
        </div>
        <div class="input-box underline">
          <input type="text" name="input_email" placeholder="Nhập email của bạn" required value="<?php
          if (isset($input_email))
            echo $input_email;
          ?>">
          <div class="underline"></div>
        </div>
        <div class="input-box">
          <input type="password" name="input_password" placeholder="Mật khẩu" required value="<?php
          if (isset($input_password))
            echo $input_password;
          ?>">
          <div class="underline"></div>
        </div>
        <div class="input-box button">
          <input type="submit" name="submit-login" value="ĐĂNG NHẬP">
        </div>

        <div class="option">Bạn chưa có tài khoản? Hãy đăng ký tại <a href="?page=register">đây</a></div>
        <div class="twitter">
          <a href="#">
            <i class="fab fa-google"></i>
            <span>Đăng nhập với Google</span>
          </a>
        </div>
        <div class="facebook">
          <a href="#">
            <i class="fab fa-facebook-f"></i>
            <span>Đăng nhập với Facebook</span>
          </a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>