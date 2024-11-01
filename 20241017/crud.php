<?php
session_start();

$server = "192.168.100.86";
$user = "root";
$pass = "password";
$mydb = "app_development";

$conn = new mysqli($server, $user, $pass, $mydb);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if (isset($id)) {
        try {
            $stmt = $conn->prepare("UPDATE user SET name=?, email=?, phone=? WHERE id=?");
            $stmt->bind_param('sssi', $name, $email, $phone, $id);

            $stmt->execute();
            $stmt->close();
        } catch (\Throwable $th) {
            $_SESSION['error'] = $th->getMessage();
        }
    } else {
        try {
            $stmt = $conn->prepare("INSERT INTO user (name, email, phone) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $name, $email, $phone);

            $stmt->execute();
            $stmt->close();
        } catch (\Throwable $th) {
            $_SESSION['error'] = $th->getMessage();
        }
    }

    header("Location: " . htmlspecialchars(dirname(($_SERVER['PHP_SELF']))) . '/index.php');
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    try {
        $stmt = $conn->prepare("DELETE FROM user WHERE id=?");
        $stmt->bind_param('i', $id);

        $stmt->execute();
        $stmt->close();
    } catch (\Throwable $th) {
        $_SESSION['error'] = $th->getMessage();
    }

    header("Location: " . htmlspecialchars(dirname(($_SERVER['PHP_SELF']))) . '/index.php');
}