<?php
session_start();

include '../auth/GoogleAuthenticator.php';

if (isset($_SESSION["login"]) && $_SESSION["role"] == "user") {
    header('Location: http://localhost/Warca/');
} elseif (isset($_SESSION["login"]) && $_SESSION["role"] == "admin") {
    header('Location: http://localhost/Warca/admin/');
}

$google = new PHPGangsta_GoogleAuthenticator();

$massage_success = "";

if (isset($_POST['btn-register'])) {
    $username_signup = htmlspecialchars($_POST['name-register']);
    $email_signup = htmlspecialchars($_POST['email-register']);
    // HASH password sebelum disimpan
    $password_signup = password_hash($_POST['password-register'], PASSWORD_DEFAULT);
    $key = $google->createSecret();

    try {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, auth_key) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username_signup, $email_signup, $password_signup, $key);
        $result_create = $stmt->execute();

        $qrCode = $google->getQRCodeGoogleUrl($username_signup, $key);
        
        if ($result_create) {
            $massage_success = "Success";
            $_SESSION["username"] = $username_signup;
            $_SESSION["key"] = $key;
        }

        header("Location: authentication.php");
        
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage();
        // $error = $e->getMessage();
        // echo "<script>alert('Na#me sudah ada, silahkan coba kembali')</script>";
    }
}
