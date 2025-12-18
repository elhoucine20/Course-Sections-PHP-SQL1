<?php
// session_start();

// // ✅ Si l'utilisateur est déjà connecté, on le redirige
// if (isset($_SESSION['user_id'])) {
//     header('Location: dashboard.php');
//     exit();
// }

// Connexion à la base de données
// require_once 'config.php'; // $connect = mysqli_connect(...)

// $error = '';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $email = trim($_POST['email']);
//     $password = trim($_POST['password']);

//     if (!empty($email) && !empty($password)) {
//         $stmt = mysqli_prepare($connect, "SELECT id, username, password FROM users WHERE email = ?");
//         mysqli_stmt_bind_param($stmt, 's', $email);
//         mysqli_stmt_execute($stmt);
//         $result = mysqli_stmt_get_result($stmt);

//         if ($user = mysqli_fetch_assoc($result)) {
            // ✅ Vérification du mot de passe hashé
            // if (password_verify($password, $user['password'])) {
                // Stocker les infos dans la session
//                 $_SESSION['user_id'] = $user['id'];
//                 $_SESSION['username'] = $user['username'];

//                 header('Location: dashboard.php');
//                 exit();
//             } else {
//                 $error = 'Mot de passe incorrect';
//             }
//         } else {
//             $error = 'Email introuvable';
//         }
//     } else {
//         $error = 'Veuillez remplir tous les champs';
//     }
// }
// ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>

    <form method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
</div>

</body>
</html>


<?php
 
?>