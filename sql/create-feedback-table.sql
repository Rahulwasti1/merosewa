-- merosewa.feedback definition
CREATE TABLE `feedback` (
    `id` int NOT NULL AUTO_INCREMENT,
    `written_by` int NOT NULL,
    `written_for` int NOT NULL,
    `body` text,
    PRIMARY KEY (`id`),
    KEY `written_by` (`written_by`),
    KEY `written_for` (`written_for`),
    CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`written_by`) REFERENCES `users` (`id`),
    CONSTRAINT `feedback_ibfk_3` FOREIGN KEY (`written_for`) REFERENCES `users` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 13 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
