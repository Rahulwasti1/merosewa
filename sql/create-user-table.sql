CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    profile_picture VARCHAR(255) NOT NULL DEFAULT 'uploads/profile/default.jpg',
    password_hash VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL
);
