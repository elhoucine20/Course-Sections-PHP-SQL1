-- table users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(50) UNIQUE,
    password VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- table nrollments (N:N)
CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    course_id INT,
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,--(delete user =>delete tout les inscriptions)
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE --(delete course =>delete tout les inscriptions)
);

-- presentation de partie 2 

--  Fonctionnalités Implémentées

-- Authentification des utilisateurs

-- Inscription avec hachage sécurisé des mots de passe

-- Connexion avec vérification sécurisée

-- Gestion des sessions PHP

-- Déconnexion avec destruction de la session

-- Gestion des utilisateurs

-- Création de comptes avec rôle par défaut Student

-- Stockage sécurisé des informations utilisateur

-- Gestion des inscriptions aux cours

-- Inscription d’un utilisateur connecté à un cours

-- Relation plusieurs-à-plusieurs entre utilisateurs et cours

-- Consultation de la liste des cours suivis par chaque utilisateur

-- Gestion des données relationnelles

-- Utilisation de tables de liaison

-- Requêtes SQL avec JOIN pour relier utilisateurs, cours et inscriptions

-- Tableau de bord statistique

-- Calcul du nombre total de cours et d’utilisateurs

-- Analyse des inscriptions par cours

-- Identification du cours le plus populaire

-- Détection des cours sans inscription

-- Suivi des dernières inscriptions et des utilisateurs récents








