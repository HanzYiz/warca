<?php
include '../connection/databases.php';
include './sign_up.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up | WaroengBaca</title>
  <link rel="icon" href="../assets/logo.png">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <header>
    <h1><span>Waroeng</span>Baca</h1>
  </header>

  <main>
    <section class="content">
      <h1>
        "Welcome. <br>
        Start your reading now with WaroengBaca!"
      </h1>
    </section>
    <section class="register">
      <div class="box-register">
        <?php if ($massage_success): ?>
          <div class="massage">
            <p>
              Success Create Account, Login Now!
            </p>
          </div>
        <?php endif; ?>
        <div class="header-register">
          <h3>Create Your Account</h3>
        </div>
        <form action="" method="post">
          <label for="name">Name</label>
          <input type="text" name="name-register" id="name" required />
          <label for="email">Email</label>
          <input type="email" name="email-register" id="email" required />
          <label for="password">Password</label>
          <input
            type="password"
            name="password-register"
            id="password"
            required />
          <button type="button" id="showPassword">
            <i class="fa-solid fa-eye"></i>
          </button>
          <button type="submit" name="btn-register">Create Account</button>
        </form>
        <div class="footer">
          <p>Already have an account? <a href="../SignIn/">Login Now</a></p>
        </div>
      </div>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
  <script>
    const inputPassword = document.getElementById('password');
    const showPassword = document.getElementById('showPassword');
    const massageSucces = document.querySelector('.massage');

    showPassword.addEventListener('click', () => {
      const isPassword = inputPassword.type === 'password';
      inputPassword.type = isPassword ? 'text' : 'password';
      showPassword.innerHTML = isPassword ?
        '<i class="fa-solid fa-eye-slash"></i>' :
        '<i class="fa-solid fa-eye"></i>';
    });

    setTimeout(() => {
      massageSucces.style.display = 'none';
    }, 3000);
    
    gsap.from("header h1", {
      duratoin: 0.5,
      opacity: 0,
      x: -500,
    });
    gsap.from(".content h1", {
      duratoin: 0.5,
      opacity: 0,
      x: -500,
      delay: 0.3
    });
    gsap.from(".box-register", {
      duratoin: 0.5,
      opacity: 0,
      delay: 0.8
    });
  </script>
</body>

</html>