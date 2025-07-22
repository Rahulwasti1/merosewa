DELIMITER $$

CREATE TRIGGER insert_job_only_if_booking_completed
BEFORE INSERT ON job
FOR EACH ROW
BEGIN
    DECLARE booking_status VARCHAR(50);
    
    SELECT status INTO booking_status
    FROM booking
    WHERE id = NEW.appointment;

    IF booking_status <> 'completed' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Cannot insert job: Booking status is not completed.';
    END IF;
END$$

DELIMITER ;
