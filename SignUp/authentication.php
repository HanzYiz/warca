<?php
session_start();
include "../connection/databases.php";
include '../auth/GoogleAuthenticator.php';

$google = new PHPGangsta_GoogleAuthenticator();

if (!isset($_SESSION["username"]) || !isset($_SESSION["key"])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION["username"];
$secret = $_SESSION["key"];

if (isset($_POST["auth"])) {
    $otp = implode("", $_POST["otp"]);

    if ($google->verifyCode($secret, $otp, 2)) {
        $success = "Verification successful. Welcome, $username!";

        unset($_SESSION['username']);
        unset($_SESSION['key']);
        header("refresh:2; url=http://localhost/Warca/SignIn/");
    } else {
        $error = "Wrong OTP code. Please try again.";
        header("refresh:1.5; url=authentication.php");
    }
}

$qrCodeUrl = $google->getQRCodeGoogleUrl($username, $secret, "Warca Verification");

?>

<!DOCTYPE html>
<html lang="en" data-theme="emerald">

<head>
    <meta charset="UTF-8">
    <title>2FA Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="hero bg-base-200 min-h-screen">
        <?php if (isset($success)) : ?>
            <div role="alert" class="alert alert-success absolute mt-8 top-0 w-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h1 class='text- font-bold text-2xl'><?= $success ?></h1>
            </div>
        <?php endif; ?>
        <?php if (isset($error)) : ?>
            <div role="alert" class="alert alert-error absolute mt-8 top-0 w-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h1 class='text- font-bold text-xl'><?= $error ?></h1>
            </div>
        <?php endif; ?>
        <div class="card w-1/2 text-center shadow-xl">
            <div class="card-body bg-secondary-content rounded rounded-xl shadow shadow-lg">
                <h2 class="text-2xl font-bold text-center">Verification Code</h2>
                <p><?= $username ?></p>
                <p class="mt-2 text-sm">Scan QR Code with Google Authenticator</p>
                <img src="<?= $qrCodeUrl ?>" alt="QR Code" width="200" class="mx-auto mt-2">
                <p class="text-sm mt-2">Or Enter Secret Key: <strong><?= $secret ?></strong></p>

                <form id="otp-form" method="post" action="">
                    <div class="flex items-center justify-center gap-3">
                        <input
                            type="text"
                            class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent appearance-none rounded p-4 outline-none focus:bg-white focus:border-neutral focus:ring-2 focus:ring-neutral"
                            maxlength="1"
                            name="otp[]" />
                        <input
                            type="text"
                            class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent appearance-none rounded p-4 outline-none focus:bg-white focus:border-neutral focus:ring-2 focus:ring-neutral"
                            maxlength="1"
                            name="otp[]" />
                        <input
                            type="text"
                            class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent appearance-none rounded p-4 outline-none focus:bg-white focus:border-neutral focus:ring-2 focus:ring-neutral"
                            maxlength="1"
                            name="otp[]" />
                        <input
                            type="text"
                            class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent appearance-none rounded p-4 outline-none focus:bg-white focus:border-neutral focus:ring-2 focus:ring-neutral"
                            maxlength="1"
                            name="otp[]" />
                        <input
                            type="text"
                            class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent appearance-none rounded p-4 outline-none focus:bg-white focus:border-neutral focus:ring-2 focus:ring-neutral"
                            maxlength="1"
                            name="otp[]" />
                        <input
                            type="text"
                            class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent appearance-none rounded p-4 outline-none focus:bg-white focus:border-neutral focus:ring-2 focus:ring-neutral"
                            maxlength="1"
                            name="otp[]" />
                    </div>
                    <div class="max-w-[260px] mx-auto mt-4">
                        <button type="submit" class="btn btn-secondary w-full mt-2 transition duration-300 ease-in-out transform hover:scale-[1.02]" name="auth">Verify</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('otp-form')
            const inputs = [...form.querySelectorAll('input[type=text]')]
            const submit = form.querySelector('button[type=submit]')

            const handleKeyDown = (e) => {
                if (
                    !/^[0-9]{1}$/.test(e.key) &&
                    e.key !== 'Backspace' &&
                    e.key !== 'Delete' &&
                    e.key !== 'Tab' &&
                    !e.metaKey
                ) {
                    e.preventDefault()
                }

                if (e.key === 'Delete' || e.key === 'Backspace') {
                    const index = inputs.indexOf(e.target);
                    if (index > 0) {
                        inputs[index - 1].value = '';
                        inputs[index - 1].focus();
                    }
                }
            }

            const handleInput = (e) => {
                const {
                    target
                } = e
                const index = inputs.indexOf(target)
                if (target.value) {
                    if (index < inputs.length - 1) {
                        inputs[index + 1].focus()
                    } else {
                        submit.focus()
                    }
                }
            }

            const handleFocus = (e) => {
                e.target.select()
            }

            const handlePaste = (e) => {
                e.preventDefault()
                const text = e.clipboardData.getData('text')
                if (!new RegExp(`^[0-9]{${inputs.length}}$`).test(text)) {
                    return
                }
                const digits = text.split('')
                inputs.forEach((input, index) => input.value = digits[index])
                submit.focus()
            }

            inputs.forEach((input) => {
                input.addEventListener('input', handleInput)
                input.addEventListener('keydown', handleKeyDown)
                input.addEventListener('focus', handleFocus)
                input.addEventListener('paste', handlePaste)
            })
        })
    </script>

</body>

</html>