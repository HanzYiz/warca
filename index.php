<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Waroeng Baca</title>
    <link rel="icon" href="./assets/logo.png" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" />
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
        background-color: #f5f9ff;
        box-sizing: border-box;
        overflow-x: hidden;

        &::selection {
            background-color: #4f9cf9;
            color: #ffffff;
        }
    }

    #home {
        background: url(./assets/Banner.png);
        background-size: cover;
        padding: 100px 20px;
        height: 100dvh;
        color: white;
    }

    #profile {
        height: 80dvh;
        display: flex;
        align-items: center;
        background: #073263;
        background: linear-gradient(181deg,
                rgba(7, 50, 99, 1) 19%,
                rgba(33, 81, 117, 1) 100%);
        padding: 60px 20px;
    }

    #colletion-books .books-link:hover {
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }

    #colletion-books .overflow-auto::-webkit-scrollbar {
        height: 6px;
    }

    #colletion-books .overflow-auto::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 5px;
    }

    #colletion-books .overflow-auto::-webkit-scrollbar-track {
        background-color: rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    @media (max-width: 768px) {
        #home {
            padding: 80px 10px;
            text-align: center;
        }

        #judul {
            font-size: 1.8rem;
            margin-top: 120px !important;
        }

        .book1,
        .book2,
        .rocket {
            display: none;
            /* Sembunyikan elemen dekorasi di mobile agar tidak memakan ruang */
        }

        #profile .col-md-6 {
            text-align: center;
        }

        #profile img {
            margin-top: 20px;
            max-height: 250px;
        }

        .overflow-auto {
            flex-wrap: nowrap;
            overflow-x: auto;
        }
    }
</style>

<body>
    <?php include './components/navbar.php'; ?>

    <?php //* home 
    ?>
    <section id="home" class="home">
        <div class="container">
            <?php if (isset($_SESSION["login"])) : ?>
                <h1 id="judul" class="fw-bold text-center position-relative" style="margin-top:200px;">
                    👋Hi! <?= $_SESSION["name"] ?>, <br />
                    Welcome to
                    <span style="color: #ffe492">Waroeng</span>Baca
                </h1>
            <?php elseif (!isset($_SESSION["login"])) : ?>
                <h1 id="judul" class="fw-bold text-center position-relative" style="margin-top:200px;">
                    Welcome to
                    <span style="color: #ffe492">Waroeng</span>Baca
                </h1>
            <?php endif; ?>
        </div>
        <img
            src="./assets/book(2).png"
            class="book2 position-absolute bottom-0"
            width="550px"
            height="350px"
            style="left: -60px; bottom: 0" />
        <img
            src="./assets/book(1).png"
            class="book1 position-absolute"
            height="350px"
            style="right: -190px; bottom: 0" />
        <img
            src="./assets/rocket.png"
            class="rocket position-absolute"
            height="70px"
            style="top: 300px; right: 0; transform: rotate(-50deg)" />
        <img
            src="./assets/earth.png"
            class="earth position-absolute"
            height="50px"
            style="left: 50px; top: 130px" />
    </section>

    <?php //* profile 
    ?>
    <section id="profile" class="">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text">
                    <h1 class="h2 fw-bold text-white">
                        Apa itu <span style="color: #ffe492">Waroeng</span>Baca
                    </h1>
                    <p class="mt-3 fw-semibold text-white" style="text-align: justify">
                        Waroeng Baca adalah perpustakaan online yang menyediakan berbagai
                        koleksi buku menarik mulai dari fiksi hingga non-fiksi, yang bisa
                        kamu baca di mana saja dan kapan saja.
                    </p>
                </div>
                <div
                    class="col-md-6 text-center img">
                    <img
                        src="./assets/books.svg"
                        alt="Books"
                        class="img-fluid rounded-4"
                        style="max-height: 350px" />
                </div>
            </div>
        </div>
    </section>

    <?php //* collection books
    ?>
    <section id="colletion-books" class="py-5 bg-white">
        <div class="container">
            <div class="header">
                <h1 class="fw-bold text-center">Collection Books</h1>
            </div>
            <div class="d-flex overflow-auto gap-3 p-4 overflow-y-hidden">
                <!-- Kartu Buku 1 -->
                <?php include './components/getBooks.php'; ?>
            </div>
        </div>
    </section>

    <?php //* footer
    ?>
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2025 Waroeng Baca. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js"></script>
    <script>
        gsap.registerPlugin(ScrollTrigger);
        window.addEventListener('scroll', () => {
            const navScroll = document.querySelector('.navbar');
            const judul = document.getElementById('judul');
            const book1 = document.getElementsByClassName('book1')[0];
            const book2 = document.getElementsByClassName('book2')[0];
            const rocket = document.getElementsByClassName('rocket')[0];

            if (window.scrollY > 150) {
                navScroll.setAttribute('style', 'background-color: #1C2321;');
                navScroll.classList.remove('bg-transparent');
            } else {
                navScroll.classList.add('bg-transparent');
            }

            judul.style.bottom = window.scrollY + 'px';
            rocket.style.right = window.scrollY + 'px';
            rocket.style.top = 300 + window.scrollY / 3 + 'px';
            rocket.style.transform = 'rotate(' + (-50 + window.scrollY) + 'deg)';
            rocket.style.right = window.scrollY + 'px';
            book1.style.transform = 'translateX(' + window.scrollY + 'px)';
            book2.style.transform = 'translateX(' + -window.scrollY + 'px)';
        });
        gsap.from("body", {
            opacity: 0,
            duration: 1
        });
        gsap.from("#home .rocket", {
            x: 200,
            opacity: 0,
            duration: 1,
        });
        gsap.from("#home .book1", {
            x: 500,
            duration: 1,
            delay: 0.3,
        });
        gsap.from("#home .book2", {
            x: -500,
            duration: 1,
            delay: 0.6,
        });
        gsap.from(".navbar", {
            y: -50,
            duration: 0.7,
            opacity: 0,
        });
        gsap.from("#profile .text", {
            x: -100,
            opacity: 0,
            duration: 0.7,
            scrollTrigger: {
                trigger: "#profile .text",
                toggleActions: "restart none restart reverse",
                start: "top 88%",
                end: "200px top"
            }
        });
        gsap.from("#profile .img", {
            x: 100,
            opacity: 0,
            duration: 0.7,
            delay: 0.3,
            scrollTrigger: {
                trigger: "#profile .text",
                toggleActions: "restart none restart reverse",
                start: "top 88%",
                end: "200px top"
            }
        });
        gsap.from("#colletion-books .container .header h1", {
            y: -100,
            opacity: 0,
            scrollTrigger: {
                trigger: ".header",
                toggleActions: "restart none restart reverse",
                start: "top 90%"
            }
        });
    </script>
</body>

</html>