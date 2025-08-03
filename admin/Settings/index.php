<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: http://localhost/Warca/");
}
include './settings.php';
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
                <li class="breadcrumb-item active text-black fw-normal" aria-current="page">Settings</li>
            </ol>
        </nav>
        <div class="header-home mt-2 text-center">
            <h1 class="h1 fw-bold">Settings</h1>
        </div>

        <div class="container p-4 bg-light rounded rounded-3 shadow shadow-lg w-75">
            <div class="col-md-12 text-center">
                <img src="../logo/logo.png" alt="" class="img-fluid rounded rounded-3 mx-auto" width="150">
            </div>
            <?php
            $select = mysqli_query($conn, "SELECT * FROM users WHERE users_id = '1'");
            $row = mysqli_fetch_assoc($select);
            ?>
            <form class="row g-3" method="post">
                <div class="col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        placeholder="Admin"
                        value="<?= $row['name']; ?>"
                        name="name-admin"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password"
                        class="form-control"
                        id="inputPassword4"
                        placeholder="******"
                        value="********"
                        name="pass-admin"
                        required>
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email"
                        class="form-control"
                        id="email"
                        placeholder="admin@gmail.com"
                        value="<?= $row['email']; ?>"
                        name="email-admin"
                        required>
                </div>
                <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <input type="text"
                        class="form-control"
                        id="address"
                        placeholder="Indonesia, Jawa Barat"
                        value="<?= $row['address']; ?>"
                        name="address-admin"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Number Phone</label>
                    <input type="text"
                        class="form-control"
                        id="phone"
                        placeholder="08123456789"
                        value="<?= $row['phone']; ?>"
                        name="phone-admin"
                        required>
                </div>
                <div class="col-md-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" class="form-select" name="gender-admin" required>
                        <option selected>Choose...</option>
                        <option value="Male" <?php if ($row['gender'] == 'male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if ($row['gender'] == 'female') echo 'selected'; ?>>Female</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="profile" class="form-label">Profile</label>
                    <input type="file"
                        class="form-control"
                        id="profile"
                        accept=".jpg, .jpeg, .png"
                        name="profile-admin">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-outline-success fw-bold" name="btn-submit">
                        <i class="ri-save-3-line"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>

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