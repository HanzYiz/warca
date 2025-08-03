<?php

if (isset($_GET["book_id"])) :
    $getBookId = $_GET["book_id"];
    $getDataBooks = mysqli_query($conn, "SELECT * FROM books");

    while ($data = mysqli_fetch_assoc($getDataBooks)) :
        $bookId = hash("md2", $data["book_id"]);

        if ($bookId == $getBookId) :
?>
            <div class="row gx-3 gy-4">
                <!-- Cart Item -->
                <div class="col-lg-8 cart">
                    <div class="card mb-4 shadow-sm">
                        <div class="row g-0 flex-column flex-md-row">
                            <div class="col-md-4 p-3 d-flex align-items-center justify-content-center">
                                <img src="../../../admin/Table_Books/cover_books/<?= $data["cover_img"] ?>" class="img-fluid rounded rounded-3" alt="Cover Book">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between flex-column flex-md-row">
                                        <h3 class="card-title fw-bold"><?= $data['title'] ?></h3>
                                        <h5 class="text-md-end mt-2 mt-md-0">Rp.<?= $data['price'] ?></h5>
                                    </div>
                                    <p class="card-text text-muted mt-2" style="text-align: justify;">
                                        <?= $data['desc_book'] ?>
                                    </p>
                                    <div class="row mb-3">
                                        <div class="col-sm-6 fw-normal">
                                            Publisher <p class="fw-semibold"><?= $data['publisher'] ?></p>
                                        </div>
                                        <div class="col-sm-6 fw-normal">
                                            Year Book <p class="fw-semibold"><?= date('F, Y', strtotime($data['year_book'])) ?></p>
                                        </div>
                                        <div class="col-sm-6 fw-normal">
                                            ISBN <p class="fw-semibold"><?= $data['isbn'] ?></p>
                                        </div>
                                        <div class="col-sm-6 fw-normal">
                                            Stock <p class="fw-semibold"><?= $data['stock'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="../../../Pages/Books/?book_id=<?= $bookId ?>" class="btn btn-outline-secondary mt-2 fw-semibold">
                        <i class="ri-arrow-left-s-line"></i>Continue Shopping
                    </a>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4 summary">
                    <div class="card shadow-sm cart-summary">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Order Summary <i class="ri-file-list-3-line"></i></h5>
                            <div class="d-flex justify-content-between">
                                <span>Subtotal</span>
                                <span>Rp.<?= $data['price'] ?></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Total</span>
                                <span>Rp.<?= $data['price'] ?></span>
                            </div>
                            <a href="../../../Pages/Books/Payment/?book_id=<?= $bookId ?>" class="btn btn-outline-primary w-100 mt-3 fw-semibold">
                                <i class="ri-bank-card-line"></i> Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endwhile; ?>
<?php else : ?>
    <div class="container m-auto mt-5">
        <div class="alert alert-danger d-flex flex-column align-items-center text-center w-50 m-auto" role="alert">
            <dotlottie-player src="https://lottie.host/6379cae0-add4-4949-a140-f4bea60d90cf/F0HzMOH4Jy.lottie" background="transparent" speed="1" style="width: 300px; height: 300px" loop autoplay></dotlottie-player>
            <div class="content w-100">
                <h1 class="alert-heading">Oops...!</h1>
                <h4>
                    <i class="ri-error-warning-line"></i> Book not found
                </h4>
                <hr>
                <p class="mb-0">
                    <a href="../../../" class="btn btn-primary"><i class="ri-home-2-line"></i> Back to Home</a>
                </p>
            </div>
        </div>
    </div>
<?php endif; ?>