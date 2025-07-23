CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    written_by INT NOT NULL,
    written_for INT NOT NULL,
    body TEXT,
    FOREIGN KEY (written_by) REFERENCES users(id),
    FOREIGN KEY (written_for) REFERENCES users(id)
);
