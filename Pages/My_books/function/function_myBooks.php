<?php
session_start();
include '../../connection/databases.php';

$users_id = $_SESSION["users_id"];

function get_user_data($users_id)
{
    global $conn;

    $select_borrow = mysqli_query($conn, "
        SELECT b.*, br.borrowing_id, br.borrow_date, br.return_date, br.type, br.status
        FROM borrowings br
        INNER JOIN books b ON br.book_id = b.book_id
        WHERE br.users_id = '$users_id'
    ");

    while ($row = mysqli_fetch_assoc($select_borrow)) {
        $browId = $row["borrowing_id"];
        $browId = hash("md2", $browId);
?>
        <div class="product-card p-3 shadow-sm">
            <div class="row align-items-center">
                <div class="col-md-2">
                    <img src="../../admin/Table_Books/cover_books/<?= htmlspecialchars($row["cover_img"]) ?>"
                        alt="<?= $row["title"] ?>"
                        class="img-fluid">
                </div>
                <div class="col-md-4">
                    <h6 class="mb-1"><?= htmlspecialchars($row["title"]) ?></h6>
                    <p class="fw-semibold mb-0"><?= htmlspecialchars($row["author"]) ?> | <?= htmlspecialchars($row["publisher"]) ?></p>
                    <p class="fw-semibold mb-0"><?= date('F Y', strtotime($row["year_book"])) ?></p>
                    <p class="fw-semibold mb-0"><?= htmlspecialchars($row["category"]) ?></p>
                    <p class="fw-semibold mb-0">Rp.<?= htmlspecialchars($row["price"]) ?></p>
                </div>
                <?php if ($row["type"] == 'Buy') : ?>
                    <div class="col-md-3">
                        <p class="fw-semibold mb-0 text-success"><i class="ri-chat-check-line"></i> This Buy</p>
                    </div>
                <?php else: ?>
                    <div class="col-md-3">
                        <?php if ($row["borrow_date"] == NULL && $row["return_date"] == NULL) : ?>
                            <p class="fw-semibold mb-0 text-danger"><i class="ri-error-warning-line"></i> Error</p>
                        <?php else : ?>
                            <p class="fw-semibold mb-0">
                                Borrow Date: <?= date('d F Y', strtotime($row["borrow_date"])) ?>
                            </p>
                            <p class="fw-semibold mb-0">
                                Return Date: <?= date('d F Y', strtotime($row["return_date"])) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="col-md-1 mt-1 d-flex flex-column align-items-start gap-2">
                    <span class="bg-<?= $row["status"] == 'pending' ? 'info text-white' : ($row["status"] == 'approved' ? 'success text-white' : ($row["status"] == 'rejected' ? 'danger text-white' : 'warning')) ?> text-capitalize fw-semibold px-2 py-1 rounded rounded-sm">
                        <?= htmlspecialchars($row["status"]) ?>
                    </span>
                    <?php if ($row["status"] == 'pending') : ?>
                        <a href="index.php?op=delete&browId=<?= $browId ?>" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this borrowing?')">
                            <i class="ri-delete-bin-line"></i> Delete
                        </a>
                    <?php endif; ?>
                </div>
                <?php if ($row["type"] == 'Borrow') : ?>
                    <?php if ($row["status"] == 'returned') : ?>
                        <div class="col-md-2 d-none"></div>
                    <?php elseif ($row["status"] == 'pending') : ?>
                        <div class="col-md-2 d-none"></div>
                    <?php elseif ($row["status"] == 'rejected') : ?>
                        <div class="col-md-2">
                            <a href="index.php?op=delete&browId=<?= $browId ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this borrowing?')">
                                <i class="ri-delete-bin-line"></i> Delete
                            </a>
                        </div>
                    <?php else : ?>
                        <div class="col-md-2">
                            <a href="./Return/?return=<?= $browId ?>" class="btn btn-secondary btn-sm">
                                Return Book
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php
    }
    if (mysqli_num_rows($select_borrow) == 0) {
    ?>
        <div class="alert alert-warning mt-3" role="alert">
            <h3 class="mb-1">No books borrowed yet!</h3>
            <p class="mb-2">You haven't borrowed any books yet. Browse our collection and start reading now!</p>
            <hr>
            <a href="../../#colletion-books" class="btn btn-sm btn-info fw-semibold text-white">Browse Books</a>
        </div>
        <dotlottie-player src="https://lottie.host/c1fc0fcf-9947-446b-a999-98d13389245e/b9EQztyJSh.lottie" background="transparent" speed="1" style="width: 300px; height: 300px" class="m-auto" loop autoplay></dotlottie-player>
        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
<?php
    }
}

if (isset($_GET["browId"])) {
    $browId = $_GET["browId"];
    $borrowing = mysqli_query(
        $conn,
        "SELECT * FROM borrowings"
    );

    while ($row = mysqli_fetch_assoc($borrowing)) {
        $realId = hash("md2", $row["borrowing_id"]);

        if ($realId == $browId) {
            $delete_borrow = mysqli_query(
                $conn,
                "DELETE FROM borrowings WHERE borrowing_id = '$row[borrowing_id]'"
            );
            header("Location: ./index.php");
            exit;
        }
    }
}

function total_items($users_id)
{
    global $conn;

    $select_borrow = mysqli_query(
        $conn,
        "SELECT * FROM borrowings WHERE users_id = '$users_id'"
    );
    return mysqli_num_rows($select_borrow);
}

$count_borrow = total_items($users_id);

?>