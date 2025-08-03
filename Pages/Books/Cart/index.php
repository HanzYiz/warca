<?php include '../../../connection/databases.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Shopping Cart</title>
    <link rel="icon" href="../../../assets/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
        rel="stylesheet" />
</head>

<style>
    :root {
        --primary-color1: #043873;
        --primary-color2: #4f9cf9;
        --primary-secondary1: #ffe492;
        --primary-secondary2: #a7cefc;
        --primary-secondary3: #ffffff;
        --primary-secondary4: #212529;
    }

    body {
        font-family: 'Inter', sans-serif;

        &::selection {
            background-color: var(--primary-color2);
            color: #ffffff;
        }
    }

    .cart-item img {
        max-width: 100%;
        height: auto;
        object-fit: cover;
    }

    .quantity-input {
        width: 50px;
    }

    .cart-summary {
        background-color: #f8f9fa;
        border-radius: 10px;
    }

    @media (max-width: 576px) {
        .cart-actions {
            flex-direction: column;
            align-items: flex-start !important;
        }

        .cart-actions button {
            width: 100%;
            margin-bottom: 5px;
        }
    }
</style>

<body>
    <div class="container my-5">
        <h2 class="mb-4 text-center text-md-start fw-bold">Your Shopping Cart</h2>
        <?php include '../../../components/cart_detail.php'; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <script>
        gsap.from(".container .row .cart .card", {
            x: -100,
            duration: 1,
            opacity: 0,
        });
        gsap.from(".container .row .summary", {
            duration: 1,
            opacity: 0,
            delay: 0.3
        });
    </script>
</body>

</html>