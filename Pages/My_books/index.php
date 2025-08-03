<?php include './function/function_myBooks.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Books | Warca</title>
    <link rel="icon" href="../../assets/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
        rel="stylesheet" />
</head>

<style>
    .cart-wrapper {
        background-color: #f8f9fa;
        min-height: 100vh;
        padding: 40px 0;
    }

    .product-card {
        background: white;
        border-radius: 12px;
        transition: transform 0.2s;
    }

    .product-card:hover {
        transform: translateY(-2px);
    }

    .quantity-input {
        width: 60px;
        text-align: center;
        border: 1px solid #dee2e6;
        border-radius: 6px;
    }

    .product-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
    }

    .summary-card {
        background: white;
        border-radius: 12px;
        position: sticky;
        top: 20px;
    }

    .checkout-btn {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        border: none;
        transition: transform 0.2s;
    }

    .checkout-btn:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #4f46e5, #4338ca);
    }

    .remove-btn {
        color: #dc2626;
        cursor: pointer;
        transition: all 0.2s;
    }

    .remove-btn:hover {
        color: #991b1b;
    }

    .quantity-btn {
        width: 28px;
        height: 28px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        background: #f3f4f6;
        border: none;
        transition: all 0.2s;
    }

    .quantity-btn:hover {
        background: #e5e7eb;
    }

    .discount-badge {
        background: #dcfce7;
        color: #166534;
        font-size: 0.875rem;
        padding: 4px 8px;
        border-radius: 6px;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark position-sticky top-0 shadow-sm" style="z-index: 9999;">
        <div class="container-fluid mx-4">
            <a class="navbar-brand fw-bold text-white" href="#">
                <img src="../../assets/logo.png" alt="" width="45" height="45" class="rounded-circle">
                <span style="color: #ffe492">Waroeng</span>Baca
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
                            <li><a class="dropdown-item fw-normal" href="../Profile/">
                                    <i class="ri-user-line"></i> Profile</a>
                            </li>
                            <li><a class="dropdown-item fw-normal" href="">
                                    <i class="ri-book-2-line"></i> My Books</a>
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

    <div class="cart-wrapper">
        <div class="container">
            <div class="row g-2">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0 fw-bold">My Books</h4>
                        <h5>
                            <span class="badge text-bg-secondary">
                                <?= $count_borrow ?> items
                            </span>
                        </h5>
                    </div>

                    <!-- Product Ca     rds -->
                    <div class="d-flex flex-column gap-3">
                        <!-- Product -->
                        <?= get_user_data($_SESSION["users_id"]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <script>
        gsap.from(".navbar", {
            y: -50,
            duration: 0.5,
            opacity: 0,
        });
        gsap.from(".product-card", {
            opacity: 0,
            duration: 0.7,
            delay: 0.6
        });
    </script>
</body>

</html>