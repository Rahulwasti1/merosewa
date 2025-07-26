-- merosewa.service definition
CREATE TABLE `service` (
    `id` int NOT NULL AUTO_INCREMENT,
    `service_provider` int NOT NULL,
    `name` varchar(100) NOT NULL,
    `description` text,
    `rate_per_hour` float NOT NULL,
    `image` varchar(255) NOT NULL DEFAULT 'uploads/service/default.jpg',
    PRIMARY KEY (`id`),
    KEY `service_provider` (`service_provider`),
    CONSTRAINT `service_ibfk_1` FOREIGN KEY (`service_provider`) REFERENCES `users` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 16 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
