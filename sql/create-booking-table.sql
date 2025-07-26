-- merosewa.booking definition
CREATE TABLE `booking` (
    `id` int NOT NULL AUTO_INCREMENT,
    `service` int NOT NULL,
    `status` varchar(50) NOT NULL,
    `message` text,
    `consumer` int NOT NULL,
    `booking_date` date NOT NULL,
    PRIMARY KEY (`id`),
    KEY `service` (`service`),
    KEY `consumer` (`consumer`),
    CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`service`) REFERENCES `service` (`id`),
    CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`consumer`) REFERENCES `users` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 10 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
