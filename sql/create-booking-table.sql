CREATE TABLE booking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service INT NOT NULL,
    consumer INT NOT NULL,
    booking_date DATE NOT NULL,
    -- Only stores selected date
    status VARCHAR(50) NOT NULL DEFAULT 'pending',
    -- Booking status
    message TEXT,
    -- Optional message from user
    FOREIGN KEY (service) REFERENCES service(id),
    FOREIGN KEY (consumer) REFERENCES users(id)
);
