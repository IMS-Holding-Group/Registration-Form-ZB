<?php
require_once 'config.php';

// إضافة بيانات جديدة
if (isset($_POST['add'])) {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $birth_date = $_POST['birth_date'];
    $graduation_year = $_POST['graduation_year'];
    
    $stmt = $pdo->prepare("INSERT INTO students (full_name, phone, email, birth_date, graduation_year) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$full_name, $phone, $email, $birth_date, $graduation_year]);
    header('Location: index.php');
    exit;
}

// حذف بيانات
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: index.php');
    exit;
}

// جلب جميع البيانات
$stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
$students = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نموذج التسجيل</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>نموذج التسجيل</h1>
        
        <!-- نموذج الإضافة -->
        <div class="form-box">
            <h2>إضافة طالب جديد</h2>
            <form method="POST">
                <input type="text" name="full_name" placeholder="الاسم الكامل" required>
                <input type="tel" name="phone" placeholder="رقم الجوال" required>
                <input type="email" name="email" placeholder="البريد الإلكتروني" required>
                <input type="date" name="birth_date" required>
                <input type="number" name="graduation_year" placeholder="سنة التخرج" min="1900" max="2100" required>
                <button type="submit" name="add" class="btn">إضافة</button>
            </form>
        </div>

        <!-- عرض البيانات -->
        <div class="table-box">
            <h2>قائمة الطلاب</h2>
            <table>
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>الجوال</th>
                        <th>البريد</th>
                        <th>تاريخ الميلاد</th>
                        <th>سنة التخرج</th>
                        <th>عمليات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($students)): ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">لا توجد بيانات</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($student['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($student['phone']); ?></td>
                                <td><?php echo htmlspecialchars($student['email']); ?></td>
                                <td><?php echo $student['birth_date']; ?></td>
                                <td><?php echo $student['graduation_year']; ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $student['id']; ?>" class="btn-edit">تعديل</a>
                                    <a href="index.php?delete=<?php echo $student['id']; ?>" class="btn-delete" onclick="return confirm('هل أنت متأكد؟')">حذف</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

