<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: http://localhost/Warca/");
}
include './function/funtion_borrow.php';
include '../../connection/databases.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin | Table Borrowing</title>
  <link rel="icon" href="../logo/logo.png" />
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

  <!-- * home -->
  <main id="home" class="bg-dark-subtle position-sticky overflow-y-scroll pb-5" style="margin-left: 220px; height: 100vh;">
    <nav class="m-3 position-absolute" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="text-black fw-semibold" href="../../admin/">Home</a></li>
        <li class="breadcrumb-item active text-black fw-normal" aria-current="page">Borrowing</li>
      </ol>
    </nav>
    <div class="header-home mt-2 text-center">
      <h1 class="h1 fw-bold">Table Borrowing</h1>
    </div>
    <div class="table mx-lg-auto table-responsive" style="width: 90%;">
      <table class="table align-middle table-border-end-0">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Borrowing_Id</th>
            <th scope="col">User_Id</th>
            <th scope="col">Book_Id</th>
            <th scope="col">Borrow_Date</th>
            <th scope="col">Return_Date</th>
            <th scope="col">Type</th>
            <th scope="col">Status</th>
            <th scope="col">Receipt</th>
            <th scope="col">Validation</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php
          $select_borrowings = "SELECT * FROM borrowings ORDER BY borrowing_id ASC";
          $result_select_borrowings = mysqli_query($conn, $select_borrowings);
          $number = 1;
          while ($row = mysqli_fetch_assoc($result_select_borrowings)) {
            $borrowing_id = $row['borrowing_id'];
            $status = $row['status'];
          ?>
            <tr>
              <th scope="row"><?= $number++; ?></th>
              <td>
                <span class="btn btn-primary btn-sm fw-bold px-3">
                  <?= $row["borrowing_id"]; ?>
                </span>
              </td>
              <td>
                <a href="../Table_Users/"
                  class="btn btn-info btn-sm fw-bold px-3">
                  <?= $row["users_id"]; ?>
                </a>
              </td>
              <td>
                <a href="../Table_Books/"
                  class="btn btn-danger btn-sm fw-bold px-3">
                  <?= $row["book_id"] ?>
                </a>
              </td>
              <td><?= date('j, F Y', strtotime($row["borrow_date"])); ?></td>
              <td><?= date('j, F Y', strtotime($row["return_date"])); ?></td>
              <td><?= $row["type"]; ?></td>
              <td>
                <span class="bg-<?=
                                $status == 'pending' ? 'info text-white' : ($status == 'approved' ? 'success text-white' : ($status == 'rejected' ? 'danger text-white' : 'warning text-black')) ?> py-1 px-2 rounded fw-semibold">
                  <?= $status ?>
                </span>
              </td>
              <td>
                <img src="../../Pages/Books/Payment/receipt/<?= $row["receipt"]; ?>" alt="receipt" class="img-thumbnail" width="100">
              </td>
              <td class="d-flex gap-1 flex-column border-0">
                <a href="index.php?valid=<?= $borrowing_id; ?>" class="btn btn-outline-success fw-semibold">Approved</a>
                <a href="index.php?return=<?= $borrowing_id; ?>" class="btn btn-outline-warning fw-semibold">Returned</a>
                <a href="index.php?reject=<?= $borrowing_id; ?>" class="btn btn-outline-danger fw-semibold">Rejected</a>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </main>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>
</body>

</html>