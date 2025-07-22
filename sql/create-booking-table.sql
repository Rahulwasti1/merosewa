CREATE TABLE booking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service INT NOT NULL,
    consumer INT NOT NULL,
    start_time DATETIME NOT NULL,
    estimated_duration INT NOT NULL,
    estimated_price FLOAT NOT NULL,
    status VARCHAR(50) NOT NULL,
    message TEXT,
    FOREIGN KEY (service) REFERENCES service(id),
    FOREIGN KEY (consumer) REFERENCES users(id)
);
