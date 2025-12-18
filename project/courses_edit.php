<?php
include "config.php";
include "header.php";

// verifier if id contien a url
if (!isset($_GET['id'])) {
    header("Location: courses_list.php");
    exit();
}

$id = $_GET['id'];

$errors = [];
$course = null; 

// Recuperer les donnees de cours
$sql = "SELECT * FROM courses WHERE id = '$id'";
$result = mysqli_query($connect, $sql);//exucute dyal query f base de donnees

if (mysqli_num_rows($result) > 0) {
    $course = mysqli_fetch_assoc($result);//set les donnees sous form table assocaitive
} else {
    header("Location: courses_list.php");
    exit();
}

// Variables pour stockee les valeurs 
$title = "";
$description = "";
$level = "";
$created_at = "";

// Tritement de formulaire
if (isset($_POST['submit'])) {
    
    // Validation dyal Title
        $title = trim($_POST['title']);
    if (empty($title)) {
        $errors['title'] = "Titre invalide";
    }

    // Validation dyal Description
        $description = trim($_POST['description']);
    if (empty($description)) {
        $errors['description'] = "Description invalide";
    }

    // Validation dyal level
    if (empty($_POST['level'])) {
        $errors['level'] = "level est false";
    } else if (in_array($_POST['level'], ["Débutant", "Intermédiaire", "Avancé"])) {
        $level = trim($_POST['level']);
    } else {
        $errors['level'] = "Level invalide";
    }

    // Date
    if (empty($_POST['created_at'])) {
        $created_at = $course['created_at'];
    } else {
        $created_at = $_POST['created_at'] . ' ' . date('H:i:s');
    }

    // Si pas d'erreurs, UPDATE dans DB
    if (empty($errors)) {
        $sqlUpdate = "UPDATE courses 
                      SET title = '$title', description = '$description', level = '$level', created_at = '$created_at' 
                      WHERE id = '$id'";
        
        if (mysqli_query($connect, $sqlUpdate)) {
            echo "<p style='color:green; padding:10px; background:#d4edda; border-radius:5px; margin:20px;'> Cours est modifie </p>";
            
            // Recharger les donnees
            $sql = "SELECT * FROM courses WHERE id = '$id'";
            $result = mysqli_query($connect, $sql);
            $course = mysqli_fetch_assoc($result); // sous form array assocaitive
        } else {
            echo "<p style='color:red; padding:10px; background:#f8d7da; border-radius:5px; margin:20px;'> Erreur en la modification: " . mysqli_error($connect) . " </p>";
        }
    }
}
?>

<section class="form-container">
   <h2>Modifier le Cours #<?php echo $id; ?></h2>

    <form action="" method="POST" class="course-form">

        <!-- Title -->
        <div class="form-group">
            <label for="title">Titre </label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   placeholder="Titre du cours"
                   value="<?php echo $title; ?>">
            <?php 
            if (isset($errors['title'])) {
                echo "<p class='error'>" . $errors['title'] . "</p>";
            }
            ?>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description </label>
            <textarea id="description" 
                      name="description" 
                      rows="5"
                      placeholder="Description du cours"><?php echo $description; ?></textarea>
            <?php 
            if (isset($errors['description'])) {
                echo "<p class='error'>" . $errors['description'] . "</p>";
            }
            ?>
        </div>

        <!-- Level -->
        <div class="form-group">
            <label for="level">Level </label>
            <select id="level" name="level">
                <option value=""> saisir level  </option>
                
                <option value="Débutant" <?php if ($level == "Débutant") echo "selected"; ?>>
                    Débutant
                </option>

                <option value="Intermédiaire" <?php if ($level == "Intermédiaire") echo "selected"; ?>>
                    Intermédiaire
                </option>

                <option value="Avancé" <?php if ($level == "Avancé") echo "selected"; ?>>
                    Avancé
                </option>
            </select>
            <?php 
            if (isset($errors['level'])) {
                echo "<p class='error'>" . $errors['level'] . "</p>";
            }
            ?>
        </div>

        <!-- Date -->
        <div class="form-group">
            <label for="created_at">Date de creation</label>
            <input type="date" 
                   id="created_at" 
                   name="created_at"
                   value="<?php echo $created_at; ?>">
        </div>
        <!-- Buttons -->
        <div class="form-actions" style="display:flex; gap:10px; margin-top:20px;">
            <button type="submit" name="submit" class="submit-btn">
                Sauvegarder les modifications
            </button>

            <a href="courses_list.php">
                <button type="button" class="cancel-btn">
                     Annuler
                </button>
            </a>
        </div>
    </form>
</section>

<?php include "footer.php"; ?>