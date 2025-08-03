<?php

include '../../connection/databases.php';

$name_user = '';
$email_user = '';
$password_user = '';
$role_user = '';
$message_success = '';
$message_error = '';

if (isset($_POST["btn-submit"])) {
    if (isset($_GET["op"])) {
        $op = $_GET["op"];
        if ($op == "edit") {
            $id = $_GET["user_id"];
            if (updateUsers($_POST) > 0) {
                $message_success =
                    '<div id="success-message" class="alert alert-success mx-lg-auto" style="width: 95%;" role="alert">
                        Data akun berhasil diupdate!
                    </div>';
            } else {
                $message_error =
                    '<div id="error-message" class="alert alert-danger mx-lg-auto" style="width: 95%;" role="alert">
                Data akun gagal diupdate!
            </div>';
            }
        }
    } else {
        if (createUsers($_POST) > 0) {
            $message_success =
                '<div id="success-message" class="alert alert-success mx-lg-auto" style="width: 95%;" role="alert">
                        Data akun berhasil ditambahkan!
                    </div>';
        } else {
            $message_error =
                '<div id="error-message" class="alert alert-danger mx-lg-auto" style="width: 95%;" role="alert">
                Data akun gagal ditambahkan!
            </div>';
        }
    }
}

if (isset($_GET["user_id"])) {
    $user_id = $_GET["user_id"];
    $op = $_GET["op"];

    if ($op == "delete") {
        if (deleteUsers($user_id) > 0) {
            $message_success =
                '<div id="success-message" class="alert alert-success mx-lg-auto" style="width: 95%;" role="alert">
                    Data akun berhasil dihapus!
                </div>';
        } else {
            $message_error =
                '<div id="error-message" class="alert alert-danger mx-lg-auto" style="width: 95%;" role="alert">
                    Data akun gagal dihapus!
                </div>';
        }
    }

    if ($op == "edit") {
        $getUsers = mysqli_query($conn, "SELECT * FROM users WHERE users_id = '$user_id'");
        $row = mysqli_fetch_assoc($getUsers);
        $name_user = $row["name"];
        $email_user = $row["email"];
        $password_user = $row["password"];
        $role_user = $row["role"];
    }
}


function createUsers($users)
{
    global $conn;

    $name_user = htmlspecialchars($users['name-user']);
    $email_user = htmlspecialchars($users['email-user']);
    $password_not_hash = $users['password-user'];
    // Hash password sebelum disimpan
    $password_user = password_hash($users['password-user'], PASSWORD_DEFAULT);
    $role_user =  htmlspecialchars($users['role-user']);
    $profile = profile_users();

    if ($profile == false) {
        $create_users = mysqli_query($conn, "INSERT INTO users (name, email, password, role) VALUES ('$name_user', '$email_user', '$password_user', '$role_user')");
    } elseif ($profile == true) {
        $create_users = mysqli_query($conn, "INSERT INTO users (name, email, password, role, profile) VALUES ('$name_user', '$email_user', '$password_user', '$role_user', '$profile')");
    }

    return mysqli_affected_rows($conn);
}

function deleteUsers($user_id)
{
    global $conn;

    $user_id = intval($user_id);
    $old_profile = mysqli_fetch_assoc(mysqli_query($conn, "SELECT profile FROM users WHERE users_id = '$user_id'"))['profile'];

    $delete_data = mysqli_query($conn, "DELETE FROM users WHERE users_id = '$user_id'");
    if ($delete_data && $old_profile) {
        unlink('./profile_users/' . $old_profile);
    }

    return mysqli_affected_rows($conn);
}

function updateUsers($users)
{
    global $conn;
    $user_id = intval($_GET["user_id"]);

    $name_user = htmlspecialchars($users['name-user']);
    $email_user = htmlspecialchars($users['email-user']);
    // Hash password sebelum disimpan
    $password_user = password_hash($users['password-user'], PASSWORD_DEFAULT);
    $role_user =  htmlspecialchars($users['role-user']);
    $profile = profile_users();

    $old_profile = mysqli_fetch_assoc(mysqli_query($conn, "SELECT profile FROM users WHERE users_id = '$user_id'"))['profile'];

    if ($profile == false) {
        $update_users = mysqli_query($conn, "UPDATE users SET name = '$name_user', email = '$email_user', password = '$password_user', role = '$role_user' WHERE users_id = '$user_id'");
    } else {
        $update_users = mysqli_query($conn, "UPDATE users SET name = '$name_user', email = '$email_user', password = '$password_user', role = '$role_user', profile = '$profile' WHERE users_id = '$user_id'");
        if ($update_users && $old_profile) {
            unlink('./profile_users/' . $old_profile);
        }
    }

    return mysqli_affected_rows($conn);
}

function profile_users()
{
    if (!isset($_FILES['profile-user']) || $_FILES['profile-user']['error'] === 4) {
        return false;
    }

    $nameFile = $_FILES['profile-user']['name'];
    $sizeFile = $_FILES["profile-user"]['size'];
    $tmpFile = $_FILES['profile-user']['tmp_name'];

    $extValid = ['jpg', 'jpeg', 'png'];
    $extFile = strtolower(pathinfo($nameFile, PATHINFO_EXTENSION));

    if (!in_array($extFile, $extValid)) {
        return false;
    }
    if ($sizeFile > 2000000) {
        return false;
    }

    $newFileName = uniqid() . '.' . $extFile;
    move_uploaded_file($tmpFile, './profile_users/' . $newFileName);
    return $newFileName;
}
