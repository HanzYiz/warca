<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: http://localhost/Warca/");
}
include '../../connection/databases.php';
include './function/funtion_return.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin | Table Users</title>
    <link rel="icon" href="../logo/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
        rel="stylesheet" />
</head>

<body class="overflow-hidden">
    <?php
    //* navbar
    ?>
    <nav class="navbar px-3" style="background-color: #1C2321;">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-white">
                <img src="../logo/logo.png" alt="Warca" width="40" height="40" class="rounded-circle">
                Hi! Admin
            </a>
            <div class="navlink d-flex gap-3 align-items-center">
                <a href="../Settings/" class="btn btn-outline-primary fw-bold text-white">
                    <i class="ri-settings-4-line"></i> Settings
                </a>
                <a href="../../Pages/Logout/" type="button" class="btn btn-outline-danger fw-bold text-white">
                    <i class="ri-logout-box-line"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <?php
    //* sidebar
    ?>
    <div class="sidebar bg-primary-subtle position-absolute left-0" style="width: 220px; height: 100vh;">
        <div class="header-sidebar text-center pt-2">
            <h1 class="fw-bold fs-2 mt-3">
                <i class="ri-admin-fill"></i>
                Admin
            </h1>
        </div>
        <div class="menu-sidebar d-flex flex-column gap-4 my-4">
            <a href="../../admin/"
                class="text-decoration-none p-2 fs-5 fw-bold mx-2 text-black rounded-3"
                style="background: #ffe492;">
                <i class="ri-home-gear-fill"></i> Home </a>
            <a href="../Table_Users/"
                class="text-decoration-none p-2 fs-5 fw-bold mx-2 text-black rounded-3"
                style="background: #ffe492;">
                <i class="ri-account-box-fill"></i> Table Users</a>
            <a href="../Table_Books/"
                class="text-decoration-none p-2 fs-5 fw-bold mx-2 text-black rounded-3"
                style="background: #ffe492;">
                <i class="ri-box-2-fill"></i> Table Books</a>
            <a href="../Table_Borrowing/"
                class="text-decoration-none p-2 fs-5 fw-bold mx-2 text-black rounded-3"
                style="background: #ffe492;">
                <i class="ri-booklet-fill"></i> Table Borrowing</a>
            <a href="../Table_Return/"
                class="text-decoration-none p-2 fs-5 fw-bold mx-2 text-black rounded-3"
                style="background: #ffe492;">
                <i class="ri-arrow-go-back-fill"></i> Table Returns</a>
        </div>
    </div>

    <?php
    //* home
    ?>
    <main id="home" class="bg-dark-subtle position-sticky overflow-y-scroll" style="margin-left: 220px; height: 100vh; padding-bottom: 60px;">
        <nav class="m-3 position-absolute" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-black fw-semibold" href="../../admin/">Home</a></li>
                <li class="breadcrumb-item active text-black fw-normal" aria-current="page">Returns</li>
            </ol>
        </nav>
        <div class="header-home mt-2 text-center">
            <h1 class="h1 fw-bold">Table Returns</h1>
        </div>

        <?php
        // if ($message_success) {
        //     echo $message_success;
        // }
        // if ($message_error) {
        //     echo $message_error;
        // }

        //* form input akun
        ?>
        <!-- <div class="form w-75 p-2 border border-black border-2 shadow rounded-3 mx-lg-auto">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mt-2 row">
                    <label for="name" class="col-sm-2 col-form-label fw-semibold">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name-user" value="<?= $name_user ?>" required>
                    </div>
                </div>
                <div class="mt-2 row">
                    <label for="email" class="col-sm-2 col-form-label fw-semibold">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email-user" value="<?php echo $email_user ?>" required>
                    </div>
                </div>
                <div class="mt-2 row">
                    <label for="password" class="col-sm-2 col-form-label fw-semibold">Password</label>
                    <div class="col-sm-10">
                        <input type="password" id="password" class="form-control" name="password-user" value="<?php echo $password_user ?>" required>
                    </div>
                </div>
                <div class="mt-2 row">
                    <label for="role" class="col-sm-2 col-form-label fw-semibold">Role</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="role-user" required>
                            <option value="user" <?php if ($role_user == 'user') echo 'selected'; ?>>User</option>
                            <option value="admin" <?php if ($role_user == 'admin') echo 'selected'; ?>>Admin</option>
                        </select>
                    </div>
                </div>
                <div class="mt-2 row">
                    <label for="profile" class="col-sm-2 col-form-label fw-semibold">Profile</label>
                    <div class="col-sm-10">
                        <input type="file" id="profile" class="form-control" accept=".jpg, .jpeg, .png" name="profile-user">
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3" name="btn-submit">Submit</button>
                <button type="button" class="btn btn-secondary mt-3" onClick="location.href = '../Table_Users/'">Reset Data</button>
            </form>
        </div> -->
        <hr class="w-75 mx-lg-auto border-2 border-black">
        <?php
        //* table read data
        ?>
        <table class="table table-striped table-hover w-75 mx-lg-auto mt-5 shadow-lg align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <td>Return_Id</td>
                    <td>Borrowing_Id</td>
                    <td>Borrow Date</td>
                    <td>Return Date</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $get_data = mysqli_query(
                    $conn,
                    "SELECT br.*, r.*
                    FROM returns r
                    INNER JOIN borrowings br ON r.borrowing_id = br.borrowing_id"
                );
                $number = 1;
                while ($row = mysqli_fetch_assoc($get_data)) {
                ?>
                    <tr>
                        <th><?= $number++; ?></th>
                        <td>
                            <span class="btn btn-secondary btn-sm fw-bold px-4">
                                <?= $row["return_id"] ?>
                            </span>
                        </td>
                        <td>
                            <a href="../Table_Borrowing/"
                                class="btn btn-primary btn-sm text-decoration-none fw-bold px-4">
                                <?= $row["borrowing_id"] ?>
                            </a>
                        </td>
                        <td><?= date('j, F Y', strtotime($row["borrow_date"])) ?></td>
                        <td><?= date('j, F Y', strtotime($row["return_date"])) ?></td>
                        <td>
                            <span class="bg-<?=
                                            $row['status'] == 'pending' ? 'info text-white' : ($row['status'] == 'approved' ? 'success text-white' : ($row['status'] == 'rejected' ? 'danger text-white' : 'warning text-black')) ?> py-1 px-2 rounded fw-semibold">
                                <?= $row['status'] ?>
                            </span>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script> //* script bootstrap

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js" integrity="sha512-NcZdtrT77bJr4STcmsGAESr06BYGE8woZdSdEgqnpyqac7sugNO+Tr4bGwGF3MsnEkGKhU2KL2xh6Ec+BqsaHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        setTimeout(function() {
            const messageSuccess = document.getElementById('success-message');
            const messageError = document.getElementById('error-message');
            if (messageSuccess) {
                messageSuccess.style.display = 'none';
                location.href = '../Table_Users/';
            }
            if (messageError) {
                messageError.style.display = 'none';
                location.href = '../Table_Users/';
            }
        }, 2500);

        gsap.from(".alert", {
            y: -10,
            duration: 0.5,
            opacity: 0,
        });
    </script>
</body>

</html>