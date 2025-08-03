<?php

include '../../connection/databases.php';

$title_book = '';
$author_book = '';
$publisher_book = '';
$year_book = '';
$isbn_book = '';
$category_book = '';
//img
$stock_book = '';
$price_book = '';
$desc_book = '';
$message_success = '';
$message_error = '';

if (isset($_POST["btn-submit"])) {
    if (isset($_GET["op"])) {
        $op = $_GET["op"];
        if ($op == "edit") {
            $id = $_GET["book_id"];
            if (updateBooks($_POST) > 0) {
                $message_success =
                    '<div id="success-message" class="alert alert-success mx-lg-auto" style="width: 95%;" role="alert">
                        Data buku berhasil diupdate!
                    </div>';
            } else {
                $message_error =
                    '<div id="error-message" class="alert alert-danger mx-lg-auto" style="width: 95%;" role="alert">
                Data buku gagal diupdate!
            </div>';
            }
        }
    } else {
        if (createBooks($_POST) > 0) {
            $message_success =
                '<div id="success-message" class="alert alert-success mx-lg-auto" style="width: 95%;" role="alert">
                        Data buku berhasil ditambahkan!
                    </div>';
        } else {
            $message_error =
                '<div id="error-message" class="alert alert-danger mx-lg-auto" style="width: 95%;" role="alert">
                Data buku gagal ditambahkan!
            </div>';
        }
    }
}

if (isset($_GET["book_id"])) {
    $book_id = $_GET["book_id"];
    $op = $_GET["op"];

    if ($op == "delete") {
        if (deleteBooks($book_id) > 0) {
            $message_success =
                '<div id="success-message" class="alert alert-success mx-lg-auto" style="width: 95%;" role="alert">
                    Data buku berhasil dihapus!
                </div>';
        } else {
            $message_error =
                '<div id="error-message" class="alert alert-danger mx-lg-auto" style="width: 95%;" role="alert">
                    Data buku gagal dihapus!
                </div>';
        }
    }

    if ($op == "edit") {
        $getBook = mysqli_query($conn, "SELECT * FROM books WHERE book_id = '$book_id'");
        $row = mysqli_fetch_assoc($getBook);
        $title_book = $row['title'];
        $author_book = $row['author'];
        $publisher_book = $row['publisher'];
        $year_book = $row['year_book'];
        $isbn_book = $row['isbn'];
        $category_book = $row['category'];
        $stock_book = $row['stock'];
        $price_book = $row['price'];
        $desc_book = $row['desc_book'];
    }
}


function createBooks($Books)
{
    global $conn;

    $title_book = htmlspecialchars($Books['title-book']);
    $author_book = htmlspecialchars($Books['author-book']);
    $publisher_book = htmlspecialchars($Books['publisher-book']);
    $year_book = htmlspecialchars($Books['year-book']);
    $isbn_book = htmlspecialchars($Books['isbn-book']);
    $category_book = htmlspecialchars($Books['category-book']);
    $stock_book = htmlspecialchars($Books['stock-book']);
    $price_book = htmlspecialchars($Books['price-book']);
    $desc_book = htmlspecialchars($Books['desc-book']);
    $cover_book = cover_img();

    if ($cover_book == false) {
        $create_users = mysqli_query(
            $conn,
            "INSERT INTO books (title, author, publisher, year_book, isbn, category, stock, price, desc_book) 
        VALUES ('$title_book', '$author_book', '$publisher_book', '$year_book', '$isbn_book', '$category_book', '$stock_book', '$price_book', '$desc_book')"
        );
    } elseif ($cover_book == true) {
        $create_users = mysqli_query(
            $conn,
            "INSERT INTO books (title, author, publisher, year_book, isbn, category, stock, price, desc_book, cover_img) 
        VALUES ('$title_book', '$author_book', '$publisher_book', '$year_book', '$isbn_book', '$category_book', '$stock_book', '$price_book', '$desc_book', '$cover_book')"
        );
    }

    return mysqli_affected_rows($conn);
}

function deleteBooks($book_id)
{
    global $conn;

    $book_id = intval($book_id);
    $old_coverImg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT cover_img FROM books WHERE books_id = '$book_id'"))['cover_img'];

    $delete_data = mysqli_query($conn, "DELETE FROM books WHERE book_id = '$book_id'");
    if ($delete_data && $old_coverImg) {
        unlink('./cover_books/' . $old_coverImg);
    }

    return mysqli_affected_rows($conn);
}


function updateBooks($Books)
{
    global $conn;
    $book_id = intval($_GET["book_id"]);

    $title_book = htmlspecialchars($Books['title-book']);
    $author_book = htmlspecialchars($Books['author-book']);
    $publisher_book = htmlspecialchars($Books['publisher-book']);
    $year_book = htmlspecialchars($Books['year-book']);
    $isbn_book = htmlspecialchars($Books['isbn-book']);
    $category_book = htmlspecialchars($Books['category-book']);
    $stock_book = htmlspecialchars($Books['stock-book']);
    $price_book = htmlspecialchars($Books['price-book']);
    $desc_book = htmlspecialchars($Books['desc-book']);
    $cover_book = cover_img();

    $old_coverImg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT cover_img FROM books WHERE book_id = '$book_id'"))['cover_img'];

    if ($cover_book == false) {
        $update_book = mysqli_query(
            $conn,
            "UPDATE books 
            SET 
        title = '$title_book',
        author = '$author_book',
        publisher = '$publisher_book',
        year_book = '$year_book',
        isbn = '$isbn_book',
        category = '$category_book',
        stock = '$stock_book',
        price = '$price_book',
        desc_book = '$desc_book' 
        WHERE book_id = '$book_id'"
        );
    } else {
        $update_book = mysqli_query(
            $conn,
            "UPDATE books 
            SET 
        title = '$title_book',
        author = '$author_book',
        publisher = '$publisher_book',
        year_book = '$year_book',
        isbn = '$isbn_book',
        category = '$category_book',
        stock = '$stock_book',
        price = '$price_book',
        desc_book = '$desc_book',
        cover_img = '$cover_book'
        WHERE book_id = '$book_id'"
        );
        if ($update_book && $old_coverImg) {
            unlink('./cover_books/' . $old_coverImg);
        }
    }

    return mysqli_affected_rows($conn);
}


function cover_img()
{
    if (!isset($_FILES['cover-book']) || $_FILES['cover-book']['error'] === 4) {
        return false;
    }

    $nameFile = $_FILES['cover-book']['name'];
    $sizeFile = $_FILES["cover-book"]['size'];
    $tmpFile = $_FILES['cover-book']['tmp_name'];

    $extValid = ['jpg', 'jpeg', 'png', 'heic'];
    $extFile = strtolower(pathinfo($nameFile, PATHINFO_EXTENSION));

    if (!in_array($extFile, $extValid)) {
        return false;
    }
    if ($sizeFile > 2000000) {
        return false;
    }

    $newFileName = uniqid() . '.' . $extFile;
    move_uploaded_file($tmpFile, './cover_books/' . $newFileName);
    return $newFileName;
}
