<?php
require_once 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $birth_date = $_POST['birth_date'];
    $graduation_year = $_POST['graduation_year'];
    $password = $_POST['password'];
    
    if ($password == $_POST['confirm_password']) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (full_name, phone, email, birth_date, graduation_year, password) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$full_name, $phone, $email, $birth_date, $graduation_year, $hashed_password])) {
            $success = 'تم التسجيل بنجاح!';
        }
    } else {
        $error = 'كلمات المرور غير متطابقة';
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>إنشاء حساب جديد</h2>
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="success"><?php echo $success; ?> <a href="login.php">تسجيل الدخول</a></div>
            <?php endif; ?>
            <form method="POST">
                <input type="text" name="full_name" placeholder="الاسم الكامل" required>
                <input type="tel" name="phone" placeholder="رقم الجوال" required>
                <input type="email" name="email" placeholder="البريد الإلكتروني" required>
                <input type="date" name="birth_date" required>
                <input type="number" name="graduation_year" placeholder="سنة التخرج" min="1900" max="2100" required>
                <input type="password" name="password" placeholder="كلمة المرور" required>
                <input type="password" name="confirm_password" placeholder="تأكيد كلمة المرور" required>
                <button type="submit" class="btn">إنشاء حساب</button>
            </form>
            <p><a href="login.php">لديك حساب؟ سجل الدخول</a></p>
        </div>
    </div>
</body>
</html>
