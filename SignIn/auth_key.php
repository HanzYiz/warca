<?php
session_start();
include '../connection/databases.php';
include '../auth/GoogleAuthenticator.php';

$google = new PHPGangsta_GoogleAuthenticator();

if ($_SESSION["auth_key"] != null) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["key"])) {
    $email = $_SESSION["email"];
    $name = $_SESSION["name"];

    $auth_key = $google->createSecret();

    try {
        $stmt = $conn->prepare("UPDATE users SET auth_key = ? WHERE email = ?");
        $stmt->bind_param("ss", $auth_key, $email); // urutan sesuai query: key dulu, lalu email
        $result_create = $stmt->execute();

        // Buat QR code
        $qrCode = $google->getQRCodeGoogleUrl($name, $auth_key, "Warca Verification");

        if ($result_create) {
            $message_success = "Success";
            $_SESSION["username"] = $name;
            $_SESSION["auth_key"] = $auth_key;
        }
        header("Location: authentication.php");
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="emerald">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Authentication</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="hero bg-base-200 min-h-screen">
        <div class="card w-1/3 text-center shadow-xl">
            <div class="card-body bg-secondary-content rounded rounded-xl shadow shadow-lg">
                <h2 class="text-2xl font-bold text-center">Authentication Key</h2>
                <h1 class="text-2xl font-bold text-start">Username : <?= $_SESSION["name"] ?></h1>
                <h1 class="text-2xl font-bold text-start">Email : <?= $_SESSION["email"] ?></h1>
                <form id="otp-form" method="post" action="">
                    <div class="flex items-center justify-center gap-3">
                    </div>
                    <div class="max-w-[260px] mx-auto mt-4">
                        <button type="submit" class="btn btn-secondary w-full mt-2 transition duration-300 ease-in-out transform hover:scale-[1.02]" name="key">Verify</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>