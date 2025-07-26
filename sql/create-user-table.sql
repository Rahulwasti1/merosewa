-- merosewa.users definition
CREATE TABLE `users` (
    `id` int NOT NULL AUTO_INCREMENT,
    `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    `email` varchar(100) NOT NULL,
    `password_hash` varchar(255) NOT NULL,
    `role` varchar(50) NOT NULL,
    `profile_picture` varchar(255) NOT NULL DEFAULT 'uploads/profile/default.jpg',
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
) ENGINE = InnoDB AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
