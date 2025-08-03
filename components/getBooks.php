<?php
include './connection/databases.php';
$getBooks = mysqli_query($conn, "SELECT * FROM books");
while ($data = mysqli_fetch_assoc($getBooks)) :
    $HashBookId = hash('md2', $data['book_id']);

    if ($data['stock'] == 0) : ?>
        <div class="books-link text-decoration-none opacity-50">
            <div class="card flex-shrink-0 shadow-sm" style="min-width: 250px; width: 250px; height: 450px;">
                <img src="./admin/Table_Books/cover_books/<?php echo $data['cover_img']; ?>"
                    class="m-auto mt-3"
                    width="200px"
                    height="300px"
                    alt="<?= $data['title'] ?>">
                <div class="card-body" style="position: relative;">
                    <small class="fw-normal">
                        <?= $data['author'] ?>
                    </small>
                    <p class="fw-bold small mb-1" style="line-height: normal;">
                        <?= $data['title'] ?>
                    </p>
                    <p class="fs-6 position-absolute bottom-0 text-danger fw-bold text-center">
                        Stock : <?= $data['stock'] ?>
                    </p>
                </div>
            </div>
        </div>
    <?php else : ?>
        <a href="./Pages/Books/?book_id=<?= $HashBookId ?>" class="books-link text-decoration-none">
            <div class="card flex-shrink-0 shadow-sm" style="min-width: 250px; width: 250px; height: 450px;">
                <img src="./admin/Table_Books/cover_books/<?php echo $data['cover_img']; ?>"
                    class="m-auto mt-3"
                    width="200px"
                    height="300px"
                    alt="<?= $data['title'] ?>">
                <div class="card-body" style="position: relative;">
                    <small class="fw-normal">
                        <?= $data['author'] ?>
                    </small>
                    <p class="fw-bold small mb-1" style="line-height: normal;">
                        <?= $data['title'] ?>
                    </p>
                    <p class="fw-bold position-absolute" style="left: auto; bottom: 0;">
                        Rp. <?= $data['price'] ?>
                    </p>
                    <p class="fs-6 fw-light position-absolute" style="inset: auto 25px 0 auto;">
                        Stock : <?= $data['stock'] ?>
                    </p>
                </div>
            </div>
        </a>
    <?php endif;
    ?>
<?php endwhile; ?>