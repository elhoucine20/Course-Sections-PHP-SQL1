CREATE table courses(
   id int AUTO_INCREMENT PRIMARY KEY,
   title varchar(50) NOT null,
    description  TEXT,
   level ENUM('Débutant','Intermédiaire','Avancé'),
   created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)
------------------------------------------------------------
CREATE TABLE sections (
    id INT PRIMARY KEY AUTO_INCREMENT,
    course_id INT ,
    title VARCHAR(255) NOT null UNIQUE,
    content TEXT,
    position INT NOT null ,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(id)
);
------------------------------------------------------------
INSERT INTO courses (title, description, level, created_at) VALUES
('Introduction à la programmation', 'Apprenez les bases de la programmation avec Python', 'Débutant', '2024-01-15 09:00:00'),
('Développement Web Frontend', 'Maîtrisez HTML, CSS et JavaScript', 'Intermédiaire', '2024-01-20 10:30:00'),
('Base de données SQL', 'Apprenez à manipuler les bases de données relationnelles', 'Avancé', '2024-02-05 14:00:00'),
('Algorithmes avancés', 'Structures de données et algorithmes complexes', 'Avancé', '2024-02-10 11:15:00'),
('Développement Backend', 'API REST avec Node.js et Express', 'Intermédiaire', '2024-02-15 16:45:00'),
('Machine Learning', 'Introduction aux algorithmes de machine learning', 'Débutant', '2024-02-20 13:30:00'),
('Sécurité informatique', 'Principes fondamentaux de la cybersécurité', 'Avancé', '2024-03-01 09:45:00'),
('Développement Mobile', 'Création d''applications iOS et Android', 'Débutant', '2024-03-05 15:20:00'),
('UI/UX Design', 'Conception d''interfaces utilisateur', 'Débutant', '2024-03-10 10:00:00'),
('DevOps', 'Intégration et déploiement continus', 'Intermédiaire', '2024-03-15 14:30:00'),
('Blockchain', 'Fondamentaux de la technologie blockchain', 'Débutant', '2024-03-20 11:00:00'),
('Cloud Computing', 'AWS, Azure et Google Cloud', 'Débutant', '2024-03-25 16:15:00'),
('Big Data', 'Traitement des données massives', 'Intermédiaire', '2024-04-01 09:30:00'),
('Intelligence Artificielle', 'IA et deep learning', 'Avancé', '2024-04-05 13:45:00'),
('Programmation fonctionnelle', 'Haskell et Scala', 'Intermédiaire', '2024-04-10 15:00:00'),
('Tests logiciels', 'Stratégies et outils de testing', 'Avancé', '2024-04-15 10:45:00'),
('Architecture logicielle', 'Design patterns et principes SOLID', 'Débutant', '2024-04-20 14:00:00'),
('IoT - Internet des Objets', 'Conception de systèmes IoT', 'Avancé', '2024-04-25 11:30:00'),
('Réalité virtuelle', 'Développement VR avec Unity', 'Intermédiaire', '2024-05-01 16:00:00'),
('Quantum Computing', 'Introduction à l''informatique quantique', 'Intermédiaire', '2024-05-05 09:15:00');

--------------------------------------------------------------------






