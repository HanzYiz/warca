<?php
session_start();
include '../connection/databases.php'; // koneksi database

if (isset($_SESSION["login"]) && $_SESSION["role"] == "user") {
    header('Location: http://localhost/Warca/');
    exit;
} elseif (isset($_SESSION["login"]) && $_SESSION["role"] == "admin") {
    header('Location: http://localhost/Warca/admin/');
    exit;
}

if (isset($_POST['btn-login'])) {
    $email_signIn = htmlspecialchars($_POST['email-login']);
    $password_signIn = htmlspecialchars($_POST['password-login']);

    // Ambil data user berdasarkan email
    $select_data = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $select_data);
    mysqli_stmt_bind_param($stmt, "s", $email_signIn);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verifikasi password hash
        if (password_verify($password_signIn, $row['password'])) {
            // Login sukses
            $_SESSION["users_id"] = $row['users_id'];
            $_SESSION["name"] = $row['name'];
            $_SESSION["email"] = $row['email'];
            $_SESSION["role"] = $row['role'];
            $_SESSION["username"] = $row['email'];
            $_SESSION["auth_key"] = $row['auth_key'];

            if ($_SESSION["auth_key"] == null) {
                $_SESSION["create_key"] = true;
                header("Location: http://localhost/Warca/SignIn/auth_key.php");
                exit;
            }
            header("Location: http://localhost/Warca/SignIn/verify.php");
            exit;
        } else {
            // Password salah
            $error = "Password is incorrect";
        }
    } else {
        // Email tidak ditemukan
        $error = "Email is not found";
    }
}
