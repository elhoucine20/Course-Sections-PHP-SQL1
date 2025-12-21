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
