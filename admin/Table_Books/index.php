<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: http://localhost/Warca/");
}
include '../../connection/databases.php';
include './function/function_books.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin | Table Books</title>
  <link rel="icon" href="../logo/logo.png">
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body class="overflow-hidden">
  <?php
  //* navbar
  ?>
  <nav class="navbar px-3" style="background-color: #1C2321;">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold text-white">
        <img src="../logo/logo.png" alt="Warca" width="40" height="40" class="rounded-circle">
        Hi! Admin
      </a>
      <div class="navlink d-flex gap-3 align-items-center">
        <a href="../Settings/" class="btn btn-outline-primary fw-bold text-white">
          <i class="ri-settings-4-line"></i> Settings
        </a>
        <a href="../../Pages/Logout/" type="button" class="btn btn-outline-danger fw-bold text-white">
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
      <a href="../../admin/"
        class="text-decoration-none p-2 fs-5 fw-bold mx-2 text-black rounded-3"
        style="background: #ffe492;">
        <i class="ri-home-gear-fill"></i> Home </a>
      <a href="../Table_Users/"
        class="text-decoration-none p-2 fs-5 fw-bold mx-2 text-black rounded-3"
        style="background: #ffe492;">
        <i class="ri-account-box-fill"></i> Table Users</a>
      <a href="../Table_Books/"
        class="text-decoration-none p-2 fs-5 fw-bold mx-2 text-black rounded-3"
        style="background: #ffe492;">
        <i class="ri-box-2-fill"></i> Table Books</a>
      <a href="../Table_Borrowing/"
        class="text-decoration-none p-2 fs-5 fw-bold mx-2 text-black rounded-3"
        style="background: #ffe492;">
        <i class="ri-booklet-fill"></i> Table Borrowing</a>
      <a href="../Table_Return/"
        class="text-decoration-none p-2 fs-5 fw-bold mx-2 text-black rounded-3"
        style="background: #ffe492;">
        <i class="ri-arrow-go-back-fill"></i> Table Returns</a>
    </div>
  </div>

  <?php
  //* home
  ?>
  <main id="home" class="bg-dark-subtle position-sticky overflow-y-scroll" style="margin-left: 220px; height: 100vh; padding-bottom: 60px;">
    <nav class="m-3 position-absolute" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="text-black fw-semibold" href="../../admin/">Home</a></li>
        <li class="breadcrumb-item active text-black fw-normal" aria-current="page">Books</li>
      </ol>
    </nav>
    <div class="header-home mt-2 text-center">
      <h1 class="h1 fw-bold">Tabel Books</h1>
    </div>

    <?php
    if ($message_success) {
      echo $message_success;
    }
    if ($message_error) {
      echo $message_error;
    }

    //* form input buku
    ?>
    <div class="form-buku w-75 m-auto p-2 border border-2 border-black rounded-3">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row mb-2">
            <label for="title" class="col-sm-2 col-form-label fw-semibold">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="title-book" id="title" value="<?php echo $title_book ?>" required>
            </div>
          </div>
          <div class="row mb-2">
            <label for="author" class="col-sm-2 col-form-label fw-semibold">Author</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="author-book" id="author" value="<?php echo $author_book ?>" required>
            </div>
          </div>
          <div class="row mb-2">
            <label for="publisher" class="col-sm-2 col-form-label fw-semibold">Publisher</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="publisher-book" id="publisher" value="<?php echo $publisher_book ?>" required>
            </div>
          </div>
          <div class="row mb-2">
            <label for="year" class="col-sm-2 col-form-label fw-semibold">Year</label>
            <div class="col-sm-10">
              <input type="month" class="form-control" name="year-book" id="year" value="<?php echo $year_book ?>" required>
            </div>
          </div>
          <div class="row mb-2">
            <label for="ISBN" class="col-sm-2 col-form-label fw-semibold">ISBN</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="isbn-book" id="isbn" value="<?php echo $isbn_book ?>" required>
            </div>
          </div>
          <div class="row mb-2">
            <label for="category" class="col-sm-2 col-form-label fw-semibold">Category</label>
            <div class="col-sm-10">
              <select class="form-select" name="category-book" required>
                <option value="">Choose category...</option>
                <option value="Motivation" <?php if ($category_book == 'Motivation') echo 'selected'; ?>>Motivation</option>
                <option value="Novel" <?php if ($category_book == 'Novel') echo 'selected'; ?>>Novel</option>
                <option value="Education" <?php if ($category_book == 'Education') echo 'selected'; ?>>Education</option>
                <option value="Comics" <?php if ($category_book == 'Comics') echo 'selected'; ?>>Comics</option>
                <option value="Manga" <?php if ($category_book == 'Manga') echo 'selected'; ?>>Manga</option>
              </select>
            </div>
          </div>
          <div class="row mb-2">
            <label for="stock" class="col-sm-2 col-form-label fw-semibold">Stock</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" name="stock-book" id="stock" value="<?php echo $stock_book ?>" required>
            </div>
          </div>
          <div class="row mb-2">
            <label for="price" class="col-sm-2 col-form-label fw-semibold">Price</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" name="price-book" id="price" value="<?php echo $price_book ?>" required>
            </div>
          </div>
          <div class="row mb-2">
            <label for="exampleTextarea" class="col-sm-2 col-form-label fw-semibold">Description</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="exampleTextarea" name="desc-book" rows="3" placeholder="Please enter description..."><?= $desc_book ?></textarea>
            </div>
          </div>
          <div class="row mb-2">
            <label for="cover" class="col-sm-2 col-form-label fw-semibold">Cover Book</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="cover-book" id="cover" accept=".jpg, .png, .jpeg">
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-success mt-3" name="btn-submit">Submit</button>
        <button type="button" class="btn btn-secondary mt-3" onClick="location.href = '../Table_Books/'">Reset Data</button>
      </form>
    </div>
    <hr class="w-75 mx-lg-auto border-2 border-black">

    <?php
    // * table read data buku 
    ?>
    <div class="container my-4">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        $select_books = "SELECT * FROM books ORDER BY book_id ASC";
        $result_select_books = mysqli_query($conn, $select_books);
        while ($row = mysqli_fetch_assoc($result_select_books)) {
          $book_id = $row['book_id'];
          $title = $row['title'];
          $author = $row['author'];
          $publisher = $row['publisher'];
          $year = $row['year_book'];
          $isbn = $row['isbn'];
          $category_book = $row['category'];
          $stock = $row['stock'];
          $price = $row['price'];
          $desc_book = $row['desc_book'];
          $titleCover = $row['cover_img'];
        ?>
          <div class="col">
            <div class="card h-100 shadow-sm">
              <img src="./cover_books/<?= $titleCover; ?>" class="mx-auto mt-2" style="width: 250px; height: 350px; object-fit: fill;" alt="<?= $title ?>">
              <div class="card-body">
                <div style="height: 50px;">
                  <p class="card-title fw-bold fs-6"><?= $title; ?></p>
                </div>
                <p class="card-text mb-1 text-danger fw-bold"><strong>Book Id:</strong> <?= $book_id; ?></p>
                <p class="card-text mb-1"><strong>Author:</strong> <?= $author; ?></p>
                <p class="card-text mb-1"><strong>Publisher:</strong> <?= $publisher; ?></p>
                <p class="card-text mb-1"><strong>Year:</strong> <?= $year; ?></p>
                <p class="card-text mb-1"><strong>Category:</strong> <?= $category_book; ?></p>
                <p class="card-text mb-1"><strong>Stock:</strong> <?= $stock; ?></p>
                <p class="card-text mb-1"><strong>Price:</strong> Rp<?= $price; ?></p>
                <p class="card-text mb-1"><strong>Description:</strong></p>
                <p class="card-text" style="text-align: justify;"><?= substr(strip_tags($desc_book), 0, 100); ?>...</p>
              </div>
              <div class="card-footer d-flex gap-2">
                <a href="index.php?op=edit&book_id=<?= $book_id; ?>" class="btn btn-warning fw-semibold">
                  <i class="ri-edit-2-line"></i> Edit</a>
                <a href="index.php?op=delete&book_id=<?= $book_id; ?>" class="btn btn-danger fw-semibold">
                  <i class="ri-delete-bin-2-fill"></i> Delete</a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </main>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js" integrity="sha512-NcZdtrT77bJr4STcmsGAESr06BYGE8woZdSdEgqnpyqac7sugNO+Tr4bGwGF3MsnEkGKhU2KL2xh6Ec+BqsaHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  //* script gsap
  <script>
    setTimeout(function() {
      const messageSuccess = document.getElementById('success-message');
      const messageError = document.getElementById('error-message');
      if (messageSuccess) {
        messageSuccess.style.display = 'none';
        location.href = '../Table_Books/';
      }
      if (messageError) {
        messageError.style.display = 'none';
        location.href = '../Table_Books/';
      }
    }, 2500);

    gsap.from(".alert", {
      y: -10,
      duration: 0.5,
      opacity: 0,
    });
  </script>

</body>

</html>