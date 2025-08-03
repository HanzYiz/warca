<?php
include '../../../connection/databases.php';

$borrow_date = "";
$return_date = "";
$type = "";

if (isset($_GET["book_id"])) {
    $book_id_param = $_GET["book_id"];
    $users_id = $_SESSION["users_id"];
    $name = $_SESSION["name"];

    $getBook = mysqli_query($conn, "SELECT * FROM books");
    while ($data = mysqli_fetch_assoc($getBook)) {
        $bookid = hash("md2", $data["book_id"]);

        if ($bookid == $book_id_param) {
            $book_id = $data["book_id"];

            if (isset($_POST["btn-payment"])) {
                $borrow_date = $_POST["borrow"];
                $return_date = $_POST["return"];
                $type = $_POST["type"];
                $receipt = upload_recipt();
                $_SESSION["payment"] = true;

                if ($type == "buy") {
                    $borrow_date = date("Y-m-d", strtotime($borrow_date));
                    $return_date = date("Y-m-d", strtotime($borrow_date));
                    $borrow = $conn->prepare("INSERT INTO borrowings 
                                            (users_id, book_id, borrow_date, return_date, type, receipt) 
                                            VALUES (?, ?, ?, ?, ?, ?)");
                    $borrow->bind_param("ssssss", $users_id, $book_id, $borrow_date, $return_date, $type, $receipt);
                    $borrow->execute();
                } else {
                    $borrow = mysqli_query(
                        $conn,
                        "INSERT INTO borrowings
                        (users_id, book_id, borrow_date, return_date, type)
                        VALUES ('$users_id', '$book_id', '$borrow_date', '$return_date', '$type')"
                    );
                }
                if ($borrow) {
                    header("Location: ./Success/");
                }
            }
        }
    }
}

function upload_recipt()
{
    $nameFile = $_FILES['receipt']['name'];
    $sizeFile = $_FILES['receipt']['size'];
    $tmpFile = $_FILES['receipt']['tmp_name'];

    $extValid = ['jpg', 'jpeg', 'png'];
    $extFile = strtolower(pathinfo($nameFile, PATHINFO_EXTENSION));

    if (!in_array($extFile, $extValid)) {
        return false;
    }
    if ($sizeFile > 2000000) {
        return false;
    }

    $newFileName = uniqid() . '.' . $extFile;
    move_uploaded_file($tmpFile, './receipt/' . $newFileName);
    return $newFileName;
}
