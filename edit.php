<?php
require_once 'config.php';

$id = $_GET['id'] ?? 0;

// جلب البيانات
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch();

if (!$student) {
    header('Location: index.php');
    exit;
}

// تحديث البيانات
if (isset($_POST['update'])) {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $birth_date = $_POST['birth_date'];
    $graduation_year = $_POST['graduation_year'];
    
    $stmt = $pdo->prepare("UPDATE students SET full_name=?, phone=?, email=?, birth_date=?, graduation_year=? WHERE id=?");
    $stmt->execute([$full_name, $phone, $email, $birth_date, $graduation_year, $id]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل البيانات</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>تعديل البيانات</h1>
        <div class="form-box">
            <form method="POST">
                <input type="text" name="full_name" value="<?php echo htmlspecialchars($student['full_name']); ?>" placeholder="الاسم الكامل" required>
                <input type="tel" name="phone" value="<?php echo htmlspecialchars($student['phone']); ?>" placeholder="رقم الجوال" required>
                <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" placeholder="البريد الإلكتروني" required>
                <input type="date" name="birth_date" value="<?php echo $student['birth_date']; ?>" required>
                <input type="number" name="graduation_year" value="<?php echo $student['graduation_year']; ?>" placeholder="سنة التخرج" min="1900" max="2100" required>
                <button type="submit" name="update" class="btn">تحديث</button>
                <a href="index.php" class="btn-cancel">إلغاء</a>
            </form>
        </div>
    </div>
</body>
</html>

