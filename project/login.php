<!-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title> -->
 <style>
        body {
      min-height: 100vh;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #4f46e5, #06b6d4);
    }
        .login-box {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .error {
            color: red;
            text-align: center;
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

<div class="login-box">
    <h2>Login</h2>

    <form method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit" name="login">Se connecter</button>
         <div class="footer-text">
           <p>Don't have an account? <a href="inscription.php">inscription</a></p>
        </div>
    </form>
</div>

</body>
</html>

<?php
    session_start();
    include "config.php";
    

    // echo session_id();

    if(isset($_POST['login'])){

        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = '$email' and password = '$password'";

        $result = mysqli_query($connect,$sql);
        if(mysqli_num_rows($result) == 1){
            $user = mysqli_fetch_assoc($result);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['emai_l'] = $email;
            // header("location: courses_list.php");
            header("location: courses_list.php");
        }
        else{
            echo "invalid email or password";
        }
    }

?>
