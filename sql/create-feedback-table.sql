CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job INT NOT NULL,
    written_by INT NOT NULL,
    body TEXT,
    FOREIGN KEY (job) REFERENCES job(id),
    FOREIGN KEY (written_by) REFERENCES users(id)
);
