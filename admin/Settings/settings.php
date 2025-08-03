<?php
include '../../connection/databases.php';

if (isset($_POST["btn-submit"])) {
    $name_admin = $_POST["name-admin"];
    $email_admin = $_POST["email-admin"];

    // HASH password sebelum disimpan
    $pass_admin = password_hash($_POST["pass-admin"], PASSWORD_DEFAULT);

    $address_admin = $_POST["address-admin"];
    $phone_admin = $_POST["phone-admin"];
    $gender_admin = $_POST["gender-admin"];
    $profile_admin = profile_admin();

    // Update data admin
    if ($profile_admin == false) {
        $update_admin = mysqli_query(
            $conn,
            "UPDATE users SET name = '$name_admin', email = '$email_admin', password = '$pass_admin', address = '$address_admin', phone = '$phone_admin', gender = '$gender_admin' WHERE users_id = 1"
        );
    } else {
        $update_admin = mysqli_query(
            $conn,
            "UPDATE users SET name = '$name_admin', email = '$email_admin', password = '$pass_admin', profile = '$profile_admin', address = '$address_admin', phone = '$phone_admin', gender = '$gender_admin' WHERE users_id = 1"
        );
    }

    if ($update_admin) {
        header("Location: index.php");
        exit;
    }
}

function profile_admin()
{
    if (!isset($_FILES['profile-admin']) || $_FILES['profile-admin']['error'] === 4) {
        return false;
    }

    $nameFile = $_FILES['profile-admin']['name'];
    $sizeFile = $_FILES["profile-admin"]['size'];
    $tmpFile = $_FILES['profile-admin']['tmp_name'];

    $extValid = ['jpg', 'jpeg', 'png'];
    $extFile = strtolower(pathinfo($nameFile, PATHINFO_EXTENSION));

    if (!in_array($extFile, $extValid)) {
        return false;
    }
    if ($sizeFile > 2000000) {
        return false;
    }

    $newFileName = uniqid() . '.' . $extFile;
    move_uploaded_file($tmpFile, '../admin/Table_Users/profile_users/' . $newFileName);
    return $newFileName;
}
