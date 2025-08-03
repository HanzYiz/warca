<?php
include "../../../connection/databases.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Return | Warca</title>
    <link rel="icon" href="../../../assets/logo.png">
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

        &::selection {
            background-color: var(--primary-color2);
            color: #ffffff;
        }
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #86b7fe;
    }

    .payment-summary {
        background-color: #f8f9fa;
        border-radius: 10px;
    }

    .card-icon {
        width: 50px;
    }

    .error-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f8f9fa;
    }

    .error-content {
        text-align: center;
    }

    .error-content h1 {
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .error-content p {
        font-size: 1.5rem;
        margin-bottom: 2rem;
    }

    .lottie-animation {
        max-width: 400px;
        margin-bottom: 2rem;
    }
</style>

<body>
    <?php
    if (isset($_GET["return"])) {
        $returnId = $_GET["return"];
        $select = mysqli_query(
            $conn,
            "SELECT b.*, br.*, u.*
                FROM borrowings br
                INNER JOIN books b ON br.book_id = b.book_id
                INNER JOIN users u ON br.users_id = u.users_id"
        );

        while ($data = mysqli_fetch_assoc($select)) {
            $borrowingId = hash("md2", $data["borrowing_id"]);
            if ($returnId == $borrowingId) {
                $borrowing_id = $data["borrowing_id"];
                if (isset($_POST["btn-return"])) {
                    $return_date = $_POST["return"];

                    $create_return = mysqli_query($conn, "INSERT INTO returns (borrowing_id, return_date) VALUES ('$borrowing_id', '$return_date')");
                    if ($create_return) {
                        $update_status = mysqli_query($conn, "UPDATE borrowings SET status = 'returned' WHERE borrowing_id = '$borrowing_id'");
                        header("Location: success.php");
                    }
                }
    ?>
                <div class="container py-5">
                    <h2 class="mb-4 text-center text-md-start fw-bold">Return</h2>
                    <div class="row g-4">
                        <div class="col-lg-7 payment">
                            <div class="card p-4 shadow-sm">
                                <h5 class="mb-3">Billing Information</h5>
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="fullname" name="name" value="<?= $data["name"] ?>" disabled>
                                    </div>
                                    <div class=" mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= $data["email"] ?>" disabled>
                                    </div>
                                    <div class="mb-3" id="borrow_date">
                                        <label for="borrow" class="form-label">Borrow Date</label>
                                        <input type="date" class="form-control" id="borrow" name="borrow" required
                                            value="<?= $data["borrow_date"] ?>">
                                    </div>
                                    <div class="mb-3" id="return_date">
                                        <label for="return-date" class="form-label">Return Date</label>
                                        <input type="date" class="form-control" id="return-date" name="return" required>
                                    </div>
                                    <button type="submit" name="btn-return" class="btn btn-outline-success mt-4 w-100 fw-semibold">
                                        <i class="ri-bank-card-line"></i> Return
                                    </button>
                                </form>
                            </div>
                            <a href="../../../Pages/My_books/" class="btn btn-outline-secondary mt-2 fw-semibold">
                                <i class="ri-arrow-left-s-line"></i> My Books
                            </a>
                        </div>

                        <!-- Order Summary -->
                        <div class="col-lg-5 order-summary">
                            <div class="card p-4 shadow-sm payment-summary">
                                <h3 class="mb-3 fw-bold"><?= $data["title"] ?></h3>
                                <div class="row mb-3">
                                    <img src="../../../admin/Table_Books/cover_books/<?= $data["cover_img"] ?>"
                                        alt="" class="col-md-4" width="200">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
    } else {
        header("refresh: 2; url=../../../Pages/My_books/");
        ?>
        <div class="container m-auto mt-5">
            <div class="alert alert-danger d-flex flex-column align-items-center text-center w-50 m-auto" role="alert">
                <dotlottie-player src="https://lottie.host/6379cae0-add4-4949-a140-f4bea60d90cf/F0HzMOH4Jy.lottie" background="transparent" speed="1" style="width: 300px; height: 300px" loop autoplay></dotlottie-player>
                <div class="content w-100">
                    <h1 class="alert-heading">Oops...!</h1>
                    <h4 class="fw-semibold">
                        <i class="ri-error-warning-line"></i>Error
                    </h4>
                    <hr>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <script>
        gsap.from(".payment", {
            duration: 0.6,
            x: -80,
            opacity: 0,
        });
        gsap.from(".order-summary", {
            duration: 1,
            opacity: 0,
            delay: 0.3
        });
        gsap.from(".error-container", {
            duration: 1,
            scale: 0.9,
            opacity: 0,
        });
    </script>
</body>

</html>