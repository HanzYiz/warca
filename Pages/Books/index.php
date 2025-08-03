<?php
session_start();
include '../../connection/databases.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Buku - Warca</title>
    <link rel="icon" href="../../assets/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
        rel="stylesheet" />
</head>

<style>
    :root {
        --primary-color1: #043873;
        --primary-color2: #4f9cf9;
        --primary-secondary1: #ffe492;
        --primary-secondary2: #a7cefc;
        --primary-secondary3: #ffffff;
        --primary-secondary4: #212529;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: #fafafa;
        color: #333;
        padding-top: 70px;

        &::selection {
            background-color: var(--primary-color2);
            color: #ffffff;
        }
    }

    .breadcrumb a {
        text-decoration: none;
        color: #6c757d;
    }

    .breadcrumb-item+.breadcrumb-item::before {
        content: ">";
    }

    .book-image {
        max-width: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .price {
        font-size: 24px;
        font-weight: bold;
    }

    .original-price {
        text-decoration: line-through;
        color: #999;
        font-size: 16px;
        margin-left: 10px;
    }

    .discount {
        color: red;
        font-weight: bold;
        margin-left: 5px;
    }

    .btn-format {
        border: 1px solid #ccc;
        border-radius: 20px;
        padding: 6px 16px;
        background-color: #f4f4f4;
    }

    .book-actions i {
        font-size: 1.2rem;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container-fluid mx-4">
            <a class="navbar-brand fw-bold text-white" href="#">
                <img src="../../assets/logo.png" alt="" width="45" height="45" class="rounded-circle">
                <span style="color: #ffe492">Waroeng</span>Baca
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php if (isset($_SESSION["login"])) : ?>
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
                                <li><a class="dropdown-item fw-normal" href="../Profile/">
                                        <i class="ri-user-line"></i> Profile</a>
                                </li>
                                <li><a class="dropdown-item fw-normal" href="../My_books/">
                                        <i class="ri-book-2-line"></i> My Books</a>
                                </li>
                                <li><a class="dropdown-item fw-normal text-danger" href="../../Pages/Logout/">
                                        <i class="ri-logout-box-line"></i> Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            <?php elseif (!isset($_SESSION["login"])): ?>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="btn btn-outline-info m-2 fw-semibold text-white" href="../../SignIn/">
                                <i class="ri-user-shared-2-line"></i> Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-info m-2 fw-semibold text-white" href="../../SignUp/">
                                <i class="ri-user-add-line"></i> Sign Up</a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <?php include '../../components/details_books.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <script>
        gsap.from(".container .row .img .book-image", {
            duration: 0.6,
            opacity: 0,
            scale: 0.9
        });
        gsap.from(".container .row .detail", {
            duration: 1,
            opacity: 0,
            delay: 0.5
        });
    </script>
</body>

</html>