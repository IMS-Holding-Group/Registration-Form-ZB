<?php
// ملف الاتصال بقاعدة البيانات
$host = 'localhost';
$dbname = 'u741730784_RegFormZB';
$username = 'u741730784_admin_RFZB';
$password = 'PdDep6.comMSLPHI25@!';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("خطأ في الاتصال بقاعدة البيانات: " . $e->getMessage());
}

// بدء الجلسة
session_start();
?>

