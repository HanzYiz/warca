<?php
if (isset($_GET['book_id'])) :
    $idFormUrl = $_GET['book_id'];
    $getBook = mysqli_query($conn, "SELECT * FROM books");

    while ($data = mysqli_fetch_assoc($getBook)) :
        $bookId = hash("md2", $data["book_id"]);

        if ($bookId == $idFormUrl) : ?>
            <div class="container my-4">
                <div class="row g-4 align-items-start">
                    <div class="col-md-4 text-center img">
                        <img src="../../admin/Table_Books/cover_books/<?= $data['cover_img'] ?>" alt="Laut Bercerita" class="book-image w-75">
                    </div>
                    <div class="col-md-8 detail">
                        <h5 class="text-muted"><?= $data['author']; ?></h5>
                        <h2 class="fw-bold"><?= $data['title'] ?></h2>
                        <div class="d-flex align-items-center mb-2">
                            <div class="price">Rp.<?= $data['price'] ?></div>
                        </div>
                        <div class="alert alert-light mt-4" role="alert">
                            <p style="text-align: justify;"><?= $data['desc_book'] ?></p>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6 fw-normal">Publisher <p class="fw-semibold"><?= $data['publisher'] ?></p>
                            </div>
                            <div class="col-sm-6 fw-normal">Year Book <p class="fw-semibold"><?= date('F, Y', strtotime($data['year_book'])) ?></p>
                            </div>
                            <div class="col-sm-6 fw-normal">ISBN <p class="fw-semibold"><?= $data['isbn'] ?></p>
                            </div>
                            <div class="col-sm-6 fw-normal">Stock <p class="fw-semibold"><?= $data['stock'] ?></p>
                            </div>
                        </div>
                        <?php if (isset($_SESSION["login"])): ?>
                            <div class="mt-4 d-flex gap-2 flex-wrap justify-content-center justify-content-md-between">
                                <a href="../Books/Cart/?book_id=<?= $bookId ?>" class="btn btn-outline-primary px-3 rounded rounded-3 fw-semibold">
                                    <i class="ri-shopping-cart-2-line"></i> Continue Cart
                                </a>
                                <a href="../../" class="btn btn-outline-primary px-3 rounded rounded-3 fw-semibold">
                                    <i class="ri-home-7-line"></i> Back to Home
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="mt-4 d-flex gap-2 flex-wrap justify-content-center justify-content-md-between">
                                <a href="../../SignIn/" class="btn btn-outline-primary px-3 rounded rounded-3 fw-semibold">
                                    <i class="ri-shopping-cart-2-line"></i> Continue Cart
                                </a>
                                <a href="../../" class="btn btn-outline-primary px-3 rounded rounded-3 fw-semibold">
                                    <i class="ri-home-7-line"></i> Back to Home
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endwhile; ?>
<?php elseif (!isset($_GET['book_id'])) : ?>
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
                    <a href="../../" class="btn btn-primary"><i class="ri-home-2-line"></i> Back to Home</a>
                </p>
            </div>
        </div>
    </div>
<?php endif; ?>