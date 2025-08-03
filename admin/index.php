<?php
session_start();
include "../connection/databases.php";

if (!isset($_SESSION["login"])) {
    header("Location: http://localhost/Warca/");
}

if ($_SESSION["role"] != "admin") {
    header("Location: http://localhost/Warca/");
}

function getTotalUsers($conn)
{
    // Query untuk menghitung jumlah akun
    $query_count_users = "SELECT COUNT(name) AS total_users FROM users";
    $result_count_users = mysqli_query($conn, $query_count_users);
    // Ambil hasilnya
    $row_count = mysqli_fetch_assoc($result_count_users);
    return $row_count['total_users'];
}

function getTotalBooks($conn)
{
    $result_count_books = mysqli_query($conn, "SELECT COUNT(title) AS total_books FROM books");
    $row_count = mysqli_fetch_assoc($result_count_books);
    return $row_count['total_books'];
}

function getBorrowings($conn)
{
    $result_count = mysqli_query($conn, "SELECT COUNT(borrowing_id) AS total_borrow FROM borrowings");
    $row_count = mysqli_fetch_assoc($result_count);
    return $row_count['total_borrow'];
}
function getReturn($conn)
{
    $result_count = mysqli_query($conn, "SELECT COUNT(return_id) AS total_return FROM returns");
    $row_count = mysqli_fetch_assoc($result_count);
    return $row_count['total_return'];
}

$total_users = getTotalUsers($conn);
$total_books = getTotalBooks($conn);
$total_borrow = getBorrowings($conn);
$total_return = getReturn($conn);

?>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin | Home</title>
    <link rel="icon" href="./logo/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<style>
    .stats-card {
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, .1);
    }

    .card-hover-primary:hover {
        background: linear-gradient(45deg, #4e73df, #224abe);
    }

    .card-hover-success:hover {
        background: linear-gradient(45deg, #1cc88a, #169a6b);
    }

    .card-hover-info:hover {
        background: linear-gradient(45deg, #36b9cc, #258391);
    }

    .card-hover-warning:hover {
        background: linear-gradient(45deg, #f6c23e, #dda20a);
    }

    .stats-card:hover .text-primary,
    .stats-card:hover .text-success,
    .stats-card:hover .text-info,
    .stats-card:hover .text-warning,
    .stats-card:hover .text-muted,
    .stats-card:hover .card-title {
        color: white !important;
    }

    .icon-circle {
        height: 60px;
        width: 60px;
        border-radius: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        background: rgba(0, 0, 0, .05);
        transition: all 0.3s ease;
    }

    .stats-card:hover .icon-circle {
        background: rgba(255, 255, 255, .2);
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 10px 0;
    }

    .progress {
        height: 8px;
        border-radius: 4px;
        background: rgba(0, 0, 0, .05);
    }

    .progress-bar {
        border-radius: 4px;
    }

    .stat-change {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.9rem;
    }

    .trend-icon {
        font-size: 0.8rem;
    }

    .mini-chart {
        height: 50px;
        margin-top: 10px;
        display: flex;
        align-items: flex-end;
        gap: 3px;
    }

    .chart-bar {
        flex: 1;
        background: rgba(0, 0, 0, .05);
        border-radius: 3px 3px 0 0;
        transition: all 0.3s ease;
    }

    .stats-card:hover .chart-bar {
        background: rgba(255, 255, 255, .2);
    }
</style>

<body class="overflow-hidden">
    <?php
    //* navbar
    ?>
    <nav class="navbar px-3" style="background-color: #1C2321;">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-white">
                <img src="./logo/logo.png" alt="Warca" width="40" height="40" class="rounded-circle">
                Hi! Admin
            </a>
            <div class="navlink d-flex gap-3 align-items-center">
                <a href="./Settings/" class="btn btn-outline-primary fw-bold text-white">
                    <i class="ri-settings-4-line"></i> Settings
                </a>
                <a href="../Pages/Logout/" type="button" class="btn btn-outline-danger fw-bold text-white">
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
            <a href="../admin/"
                class="text-decoration-none p-2 fs-5 fw-bold mx-2 text-black rounded-3"
                style="background: #ffe492;">
                <i class="ri-home-gear-fill"></i> Home</a>
            <a href="../admin/Table_Users/"
                class="text-decoration-none p-2 fs-5 fw-bold mx-2 text-black rounded-3"
                style="background: #ffe492;">
                <i class="ri-account-box-fill"></i> Table Users</a>
            <a href="../admin/Table_Books/"
                class="text-decoration-none p-2 fs-5 fw-bold mx-2 text-black rounded-3"
                style="background: #ffe492;">
                <i class="ri-box-2-fill"></i> Table Books</a>
            <a href="../admin/Table_Borrowing/"
                class="text-decoration-none p-2 fs-5 fw-bold mx-2 text-black rounded-3"
                style="background: #ffe492;">
                <i class="ri-booklet-fill"></i> Table Borrowing</a>
            <a href="../admin/Table_Return/"
                class="text-decoration-none p-2 fs-5 fw-bold mx-2 text-black rounded-3"
                style="background: #ffe492;">
                <i class="ri-arrow-go-back-fill"></i> Table Returns</a>
        </div>
    </div>

    <?php
    //* home
    ?>
    <main id="home" class="bg-dark-subtle position-sticky overflow-y-scroll h-100" style="margin-left: 220px;">
        <nav class="m-3 position-absolute" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-black fw-semibold" href="../admin/">Home</a></li>
                <li class="breadcrumb-item active text-black fw-normal" aria-current="page">Home</li>
            </ol>
        </nav>
        <div class="header-home mt-2 text-center">
            <h1 class="h1 fw-bold">Home</h1>
        </div>

        <div class="container text-center mt-4">
            <div class="container">
                <div class="row g-4 justify-content-center">
                    <!-- Users Card -->
                    <div class="col-xl-3 col-md-6" onclick="window.location.href = '../admin/Table_Users/'">
                        <div class="card stats-card card-hover-success shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-muted text-uppercase fw-bold small">Active Users</div>
                                        <div class="stat-value text-success">Users : <?= $total_users ?></div>
                                    </div>
                                    <div class="icon-circle">
                                        <i class="ri-group-fill text-success"></i>
                                    </div>
                                </div>
                                <div class="progress mt-4">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Books Card -->
                    <div class="col-xl-3 col-md-6" onclick="window.location.href = '../admin/Table_Books/'">
                        <div class="card stats-card card-hover-info shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-muted text-uppercase fw-bold small">Books</div>
                                        <div class="stat-value text-info">Books : <?= $total_books ?></div>
                                    </div>
                                    <div class="icon-circle">
                                        <i class="ri-book-3-fill text-info"></i>
                                    </div>
                                </div>
                                <div class="progress mt-4">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Boorrowing Card -->
                    <div class="col-xl-3 col-md-6" onclick="window.location.href = '../admin/Table_Borrowing/'">
                        <div class="card stats-card card-hover-warning shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-muted text-uppercase fw-bold small">Borrowing</div>
                                        <div class="stat-value text-warning">Borrow : <?= $total_borrow ?></div>
                                    </div>
                                    <div class="icon-circle">
                                        <i class="ri-bank-card-fill text-warning"></i>
                                    </div>
                                </div>
                                <div class="progress mt-4">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6" onclick="window.location.href = '../admin/Table_Return/'">
                        <div class="card stats-card card-hover-primary shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-muted text-uppercase fw-bold small">Return</div>
                                        <div class="stat-value text-primary">Return : <?= $total_return ?></div>
                                    </div>
                                    <div class="icon-circle">
                                        <i class="ri-arrow-go-back-fill text-primary fw-bold"></i>
                                    </div>
                                </div>
                                <div class="progress mt-4">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container h-100">
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>