<?php

include './../../connection/databases.php';

if (isset($_GET["valid"])) {
    $id = $_GET["valid"];
    approved($id);
}

if (isset($_GET["return"])) {
    $id = $_GET["return"];
    returnBook($id);
}

if (isset($_GET["reject"])) {
    $id = $_GET["reject"];
    rejected($id);
}

function approved($id)
{
    global $conn;

    $getBorrow = mysqli_query(
        $conn,
        "SELECT * FROM borrowings WHERE borrowing_id = '$id'"
    );
    $rowBorrow = mysqli_fetch_assoc($getBorrow);
    $borrowing_id = $rowBorrow['borrowing_id'];

    $updateStatus = mysqli_query(
        $conn,
        "UPDATE borrowings SET status = 'approved' WHERE borrowing_id = '$borrowing_id'"
    );
    if ($updateStatus) {
        header("Location: ./index.php");
    }
}

function returnBook($id)
{
    global $conn;

    $getBorrow = mysqli_query(
        $conn,
        "SELECT * FROM borrowings WHERE borrowing_id = '$id'"
    );
    $rowBorrow = mysqli_fetch_assoc($getBorrow);
    $borrowing_id = $rowBorrow['borrowing_id'];

    $updateStatus = mysqli_query(
        $conn,
        "UPDATE borrowings SET status = 'returned' WHERE borrowing_id = '$borrowing_id'"
    );
    if ($updateStatus) {
        header("Location: ./index.php");
    }

    return $updateStatus;
}

function rejected($id)
{
    global $conn;

    $getBorrow = mysqli_query(
        $conn,
        "SELECT * FROM borrowings WHERE borrowing_id = '$id'"
    );
    $rowBorrow = mysqli_fetch_assoc($getBorrow);
    $borrowing_id = $rowBorrow['borrowing_id'];

    $updateStatus = mysqli_query(
        $conn,
        "UPDATE borrowings SET status = 'rejected' WHERE borrowing_id = '$borrowing_id'"
    );
    if ($updateStatus) {
        header("Location: ./index.php");
    }
}
