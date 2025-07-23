CREATE TABLE service (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_provider INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    rate_per_hour FLOAT NOT NULL,
    image VARCHAR(255) NOT NULL DEFAULT 'uploads/service/default.jpg',
    FOREIGN KEY (service_provider) REFERENCES users(id)
);
