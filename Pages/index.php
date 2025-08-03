<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>WaroengBaca</title>
    <link rel="icon" href="../../../../assets/logo.png">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
        crossorigin="anonymous" />
    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
        rel="stylesheet" />
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz@0,14..32;1,14..32&display=swap');

    :root {
        --color-main: #7886c7;
        --color-navy: #3e5879;
        --color-white: #fefefe;
        --color-secondary: #ffe492;
    }

    .error-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f8f9fa;
    }

    .error-content {
        text-align: center;
    }

    .error-content h1 {
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .error-content p {
        font-size: 1.5rem;
        margin-bottom: 2rem;
    }

    .lottie-animation {
        max-width: 400px;
        margin-bottom: 2rem;
    }
</style>

<body>
    <div class="container m-auto mt-5">
        <div class="alert alert-danger d-flex flex-column align-items-center text-center w-50 m-auto" role="alert">
            <dotlottie-player src="https://lottie.host/6379cae0-add4-4949-a140-f4bea60d90cf/F0HzMOH4Jy.lottie" background="transparent" speed="1" style="width: 300px; height: 300px" loop autoplay></dotlottie-player>
            <div class="content w-100">
                <h1 class="alert-heading">Oops...!</h1>
                <h4 class="fw-semibold">
                    <i class="ri-error-warning-line"></i> Pages error
                </h4>
                <hr>
                <p class="mb-0">
                    <a href="../" class="btn btn-primary"><i class="ri-home-2-line"></i> Back to Home</a>
                    <?php header("refresh: 2; url=../") ?>
                </p>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <script
        src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"
        type="module"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <script>
        gsap.from(".error-container", {
            duration: 1,
            scale: 0.9,
            opacity: 0,
        });
    </script>
</body>

</html>