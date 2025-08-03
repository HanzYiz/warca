<?php
include '../../connection/databases.php';
include './edit/edit_user.php';
?>

<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profile | Warca</title>
    <link rel="icon" href="../../assets/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
        rel="stylesheet" />
</head>

<style>
    body {
        background-color: #f0f2f5;
        font-family: 'Segoe UI', sans-serif;
        padding-top: 70px;
    }

    .profile-card {
        max-width: 960px;
        margin: auto;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .profile-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .profile {
        width: 220px;
        height: 250px;
        object-fit: fill;
        border-radius: 10px;
    }

    .label {
        font-weight: bold;
        color: #777;
    }

    .value {
        color: #333;
    }
</style>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <img src="../../assets/logo.png" alt="Logo" width="40" class="rounded-circle me-2">
                <span style="color: #ffe492">Waroeng</span><span class="text-white">Baca</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold text-white" href="../../">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold text-white" href="../../">Collection Books</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link fw-semibold text-white dropdown-toggle" role="button" data-bs-toggle="dropdown">
                            Setting
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item fw-normal" href="#"> <?= $_SESSION["name"] ?></a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item fw-normal" href="../../Pages/Profile/">
                                    <i class="ri-user-line"></i> Profile</a>
                            </li>
                            <li><a class="dropdown-item fw-normal" href="../My_books/">
                                    <i class="ri-shopping-cart-2-line"></i> My Books</a>
                            </li>
                            <li><a class="dropdown-item fw-normal text-danger" href="../../Pages/Logout/">
                                    <i class="ri-logout-box-line"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile -->
    <div class="profile-card mt-5">
        <div class="row">
            <!-- Foto Profil di Kiri -->
            <div class="profile-header col-md-4 text-center d-flex flex-column align-items-center justify-content-center">
                <img src="../../admin/Table_Users/profile_users/<?= $user["profile"]; ?>" alt="<?= $user["name"]; ?>"
                    class="profile mb-3">
                <h4 class="fw-semibold"><?= $user['name']; ?></h4>
                <p class="text-muted text-capitalize"><?= $user["role"]; ?> Warca</p>
                <button class="btn btn-outline-warning mt-2 text-black fw-semibold" data-bs-toggle="modal" data-bs-target="#editModal">
                    <i class="ri-edit-box-line"></i> Edit Profil
                </button>
            </div>

            <!-- Info Profil di Kanan -->
            <div class="profile-info col-md-8">
                <div class="row mb-3">
                    <div class="col-sm-6 mb-3">
                        <div class="label">
                            <i class="ri-mail-line"></i> Email
                        </div>
                        <div class="value"><?= $user['email']; ?></div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="label">
                            <i class="ri-lock-2-line"></i> Password
                        </div>
                        <div class="value" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis; max-width: 200px;">
                            <span class="fw-bold">********</span>
                            <!-- <?= $user['password']; ?> -->
                        </div>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <div class="label">
                            <?php if ($user['gender'] == 'male'): ?>
                                <i class="ri-men-line"></i>
                            <?php else: ?>
                                <i class="ri-women-line"></i>
                            <?php endif; ?>
                            Gender
                        </div>
                        <div class="value text-capitalize"><?= $user['gender']; ?></div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="label">
                            <i class="ri-phone-line"></i> Number Phone
                        </div>
                        <div class="value"><?= $user['phone']; ?></div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="label">
                            <i class="ri-home-7-line"></i> Address
                        </div>
                        <div class="value"><?= $user['address']; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade modal-lg" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="ri-edit-box-line"></i> Edit Profil Pengguna
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" method="post" action="" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="inputName4" name="name" value="<?= $user['name']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputPassword4" name="password" value="<?= $user['password']; ?>" required>
                        </div>
                        <div class=" col-12">
                            <label for="inputAddress" class="form-label">Email</label>
                            <input type="email" class="form-control" id="inputEmail" name="email" value="<?= $user['email']; ?>" required>
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Address</label>
                            <input type="text" class="form-control" id="inputAddress" name="address" value="<?= $user['address']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">Number Phone</label>
                            <input type="text" class="form-control" id="inputCity" name="phone" value="<?= $user['phone']; ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Gender</label>
                            <select id="inputState" class="form-select" name="gender" required>
                                <option selected>Choose...</option>
                                <option value="Male" <?php if ($user['gender'] == 'male') echo 'selected'; ?>>Male</option>
                                <option value="Female" <?php if ($user['gender'] == 'female') echo 'selected'; ?>>Female</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputZip" class="form-label">Profile</label>
                            <input type="file" class="form-control" id="inputZip" accept=".jpg, .png, .jpeg .heic" name="profile">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-success fw-semibold" name="update">
                                <i class="ri-save-3-line"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <script>
        gsap.from(".navbar", {
            y: -50,
            duration: 0.7,
            opacity: 0,
        });
        gsap.from(".profile-card", {
            opacity: 0,
            y: 100,
            duration: 1,
            ease: "back.out(2)",
        });
    </script>
</body>

</html>