<?php
// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root"; // ضع اسم المستخدم لقاعدة البيانات
$password = ""; // ضع كلمة المرور لقاعدة البيانات
$dbname = "bank_db"; // اسم قاعدة البيانات

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// التحقق من إرسال البيانات
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // التحقق من تطابق كلمة المرور
    if ($password !== $confirm_password) {
        echo "❌ كلمة المرور غير متطابقة!";
        exit();
    }

    // تشفير كلمة المرور
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // إدخال البيانات في قاعدة البيانات
    $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "✅ تم إنشاء الحساب بنجاح!";
    } else {
        echo "❌ خطأ: " . $sql . "<br>" . $conn->error;
    }
}

// إغلاق الاتصال
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>انشاء حساب</title>
</head>
<body>
<h2>إنشاء حساب جديد</h2>
            <form action="register.php" method="POST">
                <input type="text" name="fullname" placeholder="الاسم الكامل" required>
                <input type="email" name="email" placeholder="البريد الإلكتروني" required>
                <input type="password" name="password" placeholder="كلمة المرور" required>
                <input type="password" name="confirm_password" placeholder="تأكيد كلمة المرور" required>
                <button type="submit" class="btn">إنشاء الحساب</button>
            </form>
            <p>لديك حساب بالفعل؟ <a href="login.html">تسجيل الدخول</a></p>
        </div>
    </section>        
</body>
</html>