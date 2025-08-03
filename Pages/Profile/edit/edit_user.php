<?php
session_start();
include './../../connection/databases.php';

$loggedInUserId = $_SESSION["users_id"]; // Ambil ID user dari session
$selectedUser = mysqli_query($conn, "SELECT * FROM users WHERE users_id = '$loggedInUserId'");
$user = mysqli_fetch_assoc($selectedUser);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $profile = profile_users();

    //* update tanpa gambar
    if ($profile == false) {
        $updateData = mysqli_query($conn, "UPDATE users SET name = '$name', email = '$email', password = '$password', gender = '$gender', address = '$address', phone = '$phone' WHERE users_id = '$loggedInUserId'");

        if ($updateData) {
            header("Location: index.php?succes=1");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } elseif ($profile == true) {
        $updateData = mysqli_query($conn, "UPDATE users SET name = '$name', email = '$email', password = '$password', profile = '$profile', gender = '$gender', address = '$address', phone = '$phone' WHERE users_id = '$loggedInUserId'");
        
        if ($updateData) {
            unlink('../../admin/Table_Users/profile_users/' . $user['profile']);
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

function profile_users()
{
    $nameFile = $_FILES['profile']['name']; // nama file 'asdasd.jpg'
    $sizeFile = $_FILES["profile"]['size'];
    $error = $_FILES['profile']['error'];
    $tmpFile = $_FILES['profile']['tmp_name'];

    //* cek file
    $extValid = ['jpg', 'jpeg', 'png', 'heic'];
    $extFile = explode('.', $nameFile);
    $extFile = strtolower(end($extFile));

    //* cek extension
    if (!in_array($extFile, $extValid)) {
        return false;
    }
    //* cek size
    if ($sizeFile > 2000000) {
        return false;
    }
    //* lolos
    move_uploaded_file($tmpFile, '../../admin/Table_Users/profile_users/' . $nameFile);
    return $nameFile;
}
