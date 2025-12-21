
<?php
include "config.php";
?>
<!-- <!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inscription Utilisateur</title> -->
  <style>
    * {
      box-sizing: border-box;
      font-family: Arial, Helvetica, sans-serif;
    }

    body {
      min-height: 100vh;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #4f46e5, #06b6d4);
    }

    .register-card {
      background: #ffffff;
      width: 100%;
      max-width: 400px;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .register-card h2 {
      margin-bottom: 20px;
      text-align: center;
      color: #1f2933;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      font-size: 14px;
      color: #374151;
    }

    .form-group input {
      width: 100%;
      padding: 10px 12px;
      border-radius: 8px;
      border: 1px solid #d1d5db;
      outline: none;
      font-size: 14px;
    }

    .form-group input:focus {
      border-color: #6366f1;
      box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
    }

    .btn-submit {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 8px;
      background: #4f46e5;
      color: #ffffff;
      font-size: 15px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .btn-submit:hover {
      background: #4338ca;
    }

    .footer-text {
      margin-top: 15px;
      text-align: center;
      font-size: 13px;
      color: #6b7280;
    }

    .footer-text a {
      color: #4f46e5;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
<!-- </head> -->
<body>

  <form class="register-card" action="" method="post">
    <h2>Inscription</h2>

    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="Votre username" required />
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="exemple@email.com" required />
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="********" required />
    </div>

    <button type="submit" name="inscription" class="btn-submit">S'inscrire</button>

    <div class="footer-text">
      Déjà un compte ? <a href="login.php">Se connecter</a>
    </div>
  </form>

</body>
</html>

<?php
  if(isset($_POST['inscription'])){
    $name = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

     if(empty($name)){
    echo "name est invalid";
  }
    if(empty($email)){
    echo "email est invalid";
  }
    if(empty($password)){
    echo "password est invalid";
  }

  $sqll ="INSERT INTO users(name,email,password)
                       value('$name','$email','$password')";
  $resultt = mysqli_query($connect,$sqll);
  header("location: login.php");


  }
?>



