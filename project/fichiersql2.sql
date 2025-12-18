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

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,--relation entre enrollments.user_id et users.id (delete user =>delete tout les inscriptions)
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE --relation entre enrollments.course_id et courses.id (delete course =>delete tout les inscriptions)
);









