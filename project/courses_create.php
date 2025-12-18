<?php
include "config.php";
include "header.php";
?>

<section class="form-container">
    <h2>Ajouter/Modifier un Cours</h2>

    <?php
    $errors = [];
    
    // Variables pour stockee les valeurs
    $title = "";
    $description = "";
    $level = "";
    $created_at = "";

    if (isset($_POST['submit'])) {
        
        // Validation dyal title
        $title = trim($_POST['title']);
        if (empty($title)) {
            $errors['title'] = "title invalide";
        }

        // validation dyal description
            $description = trim($_POST['description']);
        if (empty($description)) {
            $errors['description'] = "description invalide";
        } 
        
        // Validation dyal level
        if (empty($_POST['level'])) {
            $errors['level'] = "level est null";
        } else if (in_array($_POST['level'], ["Débutant", "Intermédiaire", "Avancé"])) {
            $level = trim($_POST['level']);
        } else {
            $errors['level'] = "level invalide";
        }

        // date de creation
        if (empty($_POST['created_at'])) {
            $created_at = date('Y-m-d H:i:s');
        } else {
            $created_at = $_POST['created_at'];
        }

        // INSERT en la DATABASE
        if (empty($errors)) {
            $sql = "INSERT INTO courses (Title, Description, level, created_at)
                    VALUES ('$title', '$description', '$level', '$created_at')";

            if (mysqli_query($connect, $sql)) {
                echo "<p style='color:green; padding:10px; background:#d4edda; border-radius:5px;'>
                        l'ajout est valide 
                      </p>";
                // Reset les variables
                $title = "";
                $description = "";
                $level = "";
                $created_at = "";

            } else {
                echo "<p style='color:red; padding:10px; background:#f8d7da; border-radius:5px;'>
                        Erreur de l'ajout en database : " . mysqli_error($connect) . "
                      </p>";
            }
        }
    }
    ?>

    <!-- form -->
    <form action="courses_create.php" method="POST" class="course-form">

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

        <!-- level -->
        <div class="form-group">
            <label for="level">level </label>
            <select id="level" name="level">
                <option value="">saisir  level</option>
                
                <option value="Débutant" 
                    <?php 
                    if ($level == "Débutant") {
                        echo "selected";
                    }
                    ?>>
                    Débutant
                </option>
                
                <option value="Intermédiaire" 
                    <?php 
                    if ($level == "Intermédiaire") {
                        echo "selected";
                    }
                    ?>>
                    Intermédiaire
                </option>
                
                <option value="Avancé" 
                    <?php 
                    if ($level == "Avancé") {
                        echo "selected";
                    }
                    ?>>
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
            <label for="created_at">Date de creation </label>
            <input type="date" 
                   id="created_at" 
                   name="created_at"
                   value="<?php echo $created_at; ?>">
        </div>

        <!-- Buttons -->
        <div class="form-actions" style="display:flex; gap:10px; margin-top:20px;">
            <button type="submit" name="submit" class="submit-btn">
                Enregistrer
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