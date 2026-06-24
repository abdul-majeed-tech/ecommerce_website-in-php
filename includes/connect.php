<?php
$host = 'aws-0-ap-southeast-1.pooler.supabase.com';
$db   = 'postgres';
$user = 'postgres';
$pass = 'LaravelLivewire12@'; // ⚠️ Agar aapne koi aur password rakha tha toh woh likhein
$port = '5432';

try {
    $con = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>