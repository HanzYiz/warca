<?php
session_start();
include '../../../connection/databases.php';
include './function/funtion_payment.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Payment | Warca</title>
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
</style>

<body>
    <div class="container py-5">
        <h2 class="mb-4 text-center text-md-start fw-bold">Payment</h2>
        <?php
        if (isset($_GET["book_id"])) {
            $book_id = $_GET["book_id"];
            $getBook = mysqli_query($conn, "SELECT * FROM books");
            while ($data = mysqli_fetch_assoc($getBook)) {
                $bookId = hash("md2", $data["book_id"]);
                if ($bookId == $book_id) {
        ?>
                    <div class="row g-4">
                        <!-- Payment Form -->
                        <div class="col-lg-7 payment">
                            <div class="card p-4 shadow-sm">
                                <h5 class="mb-3">Billing Information</h5>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname"
                                            value="<?= $_SESSION["name"] ?>" disabled>
                                    </div>
                                    <div class=" mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= $_SESSION["email"] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Type</label>
                                        <select class="form-select" aria-label="Default select example" id="type" name="type">
                                            <option value="borrow" <?php if ($type == "borrow") echo "selected"; ?>>Borrow</option>
                                            <option value="buy" <?php if ($type == "buy") echo "selected"; ?>>Buy</option>
                                        </select>
                                    </div>
                                    <div class="mb-3" id="borrow_date">
                                        <label for="borrow" class="form-label">Borrow Date</label>
                                        <input type="date" class="form-control" id="borrow" name="borrow" required
                                            value="<?= date("Y-m-d") ?>">
                                    </div>
                                    <div class="mb-3" id="return_date">
                                        <label for="return-date" class="form-label">Return Date</label>
                                        <input type="date" class="form-control" id="return-date" name="return" required>
                                    </div>
                                    <div class="mb-3 d-none" id="receipt">
                                        <label for="receipt" class="form-label">Receipt</label>
                                        <input type="file" class="form-control" id="receipt" name="receipt" accept=".jpg, .jpeg, .png">
                                    </div>
                                    <div class="payment_method d-none">
                                        <h6 class="mt-4">Payment Method</h6>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="Bank Transfer" checked>
                                            <label class="form-check-label" for="bank_transfer">
                                                Bank Transfer (Mandiri, BCA, BRI, etc.)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="COD">
                                            <label class="form-check-label" for="cod">
                                                Cash or Deal (COD)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method" id="ewallet" value="E-Wallet">
                                            <label class="form-check-label" for="ewallet">
                                                E-Wallet (OVO, GoPay, DANA)
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" name="btn-payment" class="btn btn-outline-success mt-4 w-100 fw-semibold">
                                        <i class="ri-bank-card-line"></i> Pay Now
                                    </button>
                                </form>
                            </div>
                            <a href="../../../Pages/Books/?book_id=<?= $bookId ?>" class="btn btn-outline-secondary mt-2 fw-semibold">
                                <i class="ri-arrow-left-s-line"></i>Continue Shopping
                            </a>
                        </div>

                        <!-- Order Summary -->
                        <div class="col-lg-5 order-summary">
                            <div class="card p-4 shadow-sm payment-summary">
                                <h3 class="mb-3 fw-bold">Total</h3>
                                <div class="row mb-3">
                                    <img src="../../../admin/Table_Books/cover_books/<?= $data["cover_img"] ?>"
                                        alt="" class="col-md-4" width="200">
                                    <div class="col-md-8">
                                        <h6 class="fw-bold"><?= $data["title"] ?></h6>
                                        <p class="fw-semibold price d-none">Rp.<?= $data["price"] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
        } else {
            ?>
            <div class="container m-auto mt-5">
                <div class="alert alert-danger d-flex flex-column align-items-center text-center w-50 m-auto" role="alert">
                    <dotlottie-player src="https://lottie.host/6379cae0-add4-4949-a140-f4bea60d90cf/F0HzMOH4Jy.lottie" background="transparent" speed="1" style="width: 300px; height: 300px" loop autoplay></dotlottie-player>
                    <div class="content w-100">
                        <h1 class="alert-heading">Oops...!</h1>
                        <h4>
                            <i class="ri-error-warning-line"></i> Payment not found
                        </h4>
                        <hr>
                        <p class="mb-0">
                            <a href="../../../" class="btn btn-primary"><i class="ri-home-2-line"></i> Back to Home</a>
                        </p>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <script>
        const select = document.getElementById("type");
        const borrowDate = document.getElementById("borrow_date");
        const returnDate = document.getElementById("return_date");
        const paymentMethod = document.querySelector(".payment_method");
        const price = document.querySelector(".price");
        const receipt = document.getElementById("receipt");

        select.addEventListener("change", () => {
            if (select.value == "buy") {
                paymentMethod.classList.remove("d-none");
                price.classList.remove("d-none");
                borrowDate.classList.add("d-none");
                returnDate.classList.add("d-none");
                receipt.classList.remove("d-none");
                document.getElementById("return-date").required = false;
            } else {
                paymentMethod.classList.add("d-none");
                price.classList.add("d-none");
                receipt.classList.add("d-none");
                borrowDate.classList.remove("d-none");
                returnDate.classList.remove("d-none");
            }
        });

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
    </script>
</body>

</html>