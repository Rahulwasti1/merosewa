CREATE TABLE job (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking INT NOT NULL,
    feedback INT,
    actual_duration INT NOT NULL,
    actual_price FLOAT NOT NULL,
    FOREIGN KEY (booking) REFERENCES booking(id),
    FOREIGN KEY (feedback) REFERENCES feedback(id)
);
