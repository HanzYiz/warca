<?php
include '../connection/databases.php';
include './sign_in.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign In | Warca</title>
  <link rel="icon" href="../assets/logo.png">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="./style.css">
</head>

<style>
</style>

<body>
  <header>
    <h1><span>Waroeng</span>Baca</h1>
  </header>

  <main>
    <?php if (isset($error)): ?>
      <div class="massage">
        <p>
          <?= $error ?>
        </p>
      </div>
    <?php endif; ?>
    <div class="box-login">
      <div class="header-login">
        <h3>Login Your Account</h3>
      </div>
      <form action="" method="post">
        <label for="email">Email</label>
        <input type="text" name="email-login" id="email" required />
        <label for="password">Password</label>
        <input type="password" name="password-login" id="password" required />
        <button type="button" id="showPassword">
          <i class="fa-solid fa-eye"></i>
        </button>
        <button type="submit" name="btn-login">Login Now</button>
      </form>
      <div class="link">
        <p>Don't Have An Account? <a href="../SignUp/">Sign Up</a></p>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
  <script>
    const password = document.getElementById('password');
    const showPassword = document.getElementById('showPassword');

    showPassword.addEventListener('click', () => {
      let isPassword = password.type === 'password';
      password.type = isPassword ? 'text' : 'password';
      showPassword.innerHTML = isPassword ?
        '<i class="fa-solid fa-eye-slash"></i>' :
        '<i class="fa-solid fa-eye"></i>';
    });

    gsap.from("header h1", {
      duration: 0.5,
      x: -300,
      opacity: 0
    });
    gsap.from(".box-login", {
      duration: 1,
      opacity: 0,
      delay: 0.2
    })
  </script>
</body>

</html>