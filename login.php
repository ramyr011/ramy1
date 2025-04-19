<?php
session_start();
include("db.php"); // الاتصال بقاعدة البيانات

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // التحقق من وجود المستخدم
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            header("Location: dashboard.php"); // تحويل إلى لوحة التحكم
            exit();
        } else {
            echo "<script>alert('كلمة المرور غير صحيحة!');</script>";
        }
    } else {
        echo "<script>alert('البريد الإلكتروني غير مسجل!');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>تسجيل دخول</title>
</head>
<body>
<section class="login-section">
        <div class="container">
            <h2>تسجيل الدخول</h2>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn">تسجيل الدخول</button>
                <p>ليس لديك حساب؟ <a href="register.html">إنشاء حساب جديد</a></p>
            </form>
        </div>
    </section>         
</body>
</html>
