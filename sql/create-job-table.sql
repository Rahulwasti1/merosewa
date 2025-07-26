-- merosewa.job definition
CREATE TABLE `job` (
    `id` int NOT NULL AUTO_INCREMENT,
    `booking` int NOT NULL,
    `duration` int NOT NULL,
    `earnings` float NOT NULL,
    `feedback` int DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `booking` (`booking`),
    KEY `feedback` (`feedback`),
    CONSTRAINT `job_ibfk_1` FOREIGN KEY (`booking`) REFERENCES `booking` (`id`),
    CONSTRAINT `job_ibfk_2` FOREIGN KEY (`feedback`) REFERENCES `feedback` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 10 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
