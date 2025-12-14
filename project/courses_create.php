<?php
include "config.php";
include "header.php";
?>

<section class="form-container">
    <h2>Ajouter/Modifier un Cours</h2>

    <?php
    // fonction dyal validation des donnees
    function Valid_form($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $errors = [];
    
    // Variables pour garder les valeurs
    $title = "";
    $description = "";
    $niveau = "";
    $created_at = "";

    if (isset($_POST['submit'])) {
        
        // Validation dyal title
        if (empty($_POST['title'])) {
            $errors['title'] = "titre invalide";
        } else {
            $title = Valid_form($_POST['title']);
        }

        // Validation dyal Description
        if (empty($_POST['description'])) {
            $errors['description'] = "Description invalide";
        } else {
            $description = Valid_form($_POST['description']);
        }

        // Validation dyal niveau
        if (empty($_POST['niveau'])) {
            $errors['niveau'] = "Le niveau est null";
        } else if (in_array($_POST['niveau'], ["Débutant", "Intermédiaire", "Avancé"])) {
            $niveau = Valid_form($_POST['niveau']);
        } else {
            $errors['niveau'] = "Niveau invalide";
        }

        // date de creation
        if (empty($_POST['created_at'])) {
            $created_at = date('Y-m-d H:i:s');
        } else {
            $created_at = $_POST['created_at'];
        }

        // INSERT dans la DATABASE
        if (empty($errors)) {
            $sql = "INSERT INTO courses (Title, Description, level, created_at)
                    VALUES ('$title', '$description', '$niveau', '$created_at')";

            if (mysqli_query($connect, $sql)) {
                echo "<p style='color:green; padding:10px; background:#d4edda; border-radius:5px;'>
                        l'ajout est succes !
                      </p>";
                
                // Reset les variables
                $title = "";
                $description = "";
                $niveau = "";
                $created_at = "";
            } else {
                echo "<p style='color:red; padding:10px; background:#f8d7da; border-radius:5px;'>
                        Erreur de l'ajout en database : " . mysqli_error($connect) . "
                      </p>";
            }
        }
    }
    ?>

    <!-- FORM -->
    <form action="courses_create.php" method="POST" class="course-form">

        <!-- Title -->
        <div class="form-group">
            <label for="title">Titre *</label>
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
            <label for="description">Description *</label>
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
            <label for="niveau">Niveau *</label>
            <select id="niveau" name="niveau">
                <option value="">-- Choisir le niveau --</option>
                
                <option value="Débutant" 
                    <?php 
                    if ($niveau == "Débutant") {
                        echo "selected";
                    }
                    ?>>
                    Débutant
                </option>
                
                <option value="Intermédiaire" 
                    <?php 
                    if ($niveau == "Intermédiaire") {
                        echo "selected";
                    }
                    ?>>
                    Intermédiaire
                </option>
                
                <option value="Avancé" 
                    <?php 
                    if ($niveau == "Avancé") {
                        echo "selected";
                    }
                    ?>>
                    Avancé
                </option>
            </select>
            <?php 
            if (isset($errors['niveau'])) {
                echo "<p class='error'>" . $errors['niveau'] . "</p>";
            }
            ?>
        </div>

        <!-- Date -->
        <div class="form-group">
            <label for="created_at">Date de creation (optionnel)</label>
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