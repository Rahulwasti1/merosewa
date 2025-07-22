CREATE TABLE job (
    id INT AUTO_INCREMENT PRIMARY KEY,
    appointment INT NOT NULL,
    actual_duration INT NOT NULL,
    actual_price FLOAT NOT NULL,
    FOREIGN KEY (appointment) REFERENCES booking(id)
);
