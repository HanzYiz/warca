<?php
session_start();
include "../connection/databases.php";
include '../auth/GoogleAuthenticator.php';

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

if ($_SESSION["auth_key"] == null) {
    header("Location: key.php");
    exit;
}

$google = new PHPGangsta_GoogleAuthenticator();

if (isset($_POST["verify"])) {
    $otp = implode("", $_POST["otp"]);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $_SESSION["username"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $checkResult = $google->verifyCode($user["auth_key"], $otp, 2);

    if ($checkResult && $_SESSION["role"] == 'admin') {
        $_SESSION["login"] = true;
        header("Location: http://localhost/Warca/admin/");
        exit;
    } elseif ($checkResult && $_SESSION["role"] == 'user') {
        $_SESSION["login"] = true;
        header("Location: http://localhost/Warca/");
        
    } else {
        $error = "The OTP code you entered is incorrect!";
        header("refresh:2; url=verify.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="emerald">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="hero bg-base-200 min-h-screen">
        <?php if (isset($error)) : ?>
            <div role="alert" class="alert alert-error absolute w-1/2 mt-8 mx-auto top-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="font-bold text-xl"><?= $error ?></p>
            </div>
        <?php endif; ?>
        <div class="card w-1/2 text-center shadow-xl">
            <div class="card-body bg-secondary-content rounded rounded-xl shadow shadow-lg">
                <h2 class="text-2xl font-bold text-center">Verification Code <strong>OTP</strong></h2>
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
                        <button type="submit" class="btn btn-neutral w-full mt-2 transition duration-300 ease-in-out transform hover:scale-[1.02]" name="verify">Verify</button>
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