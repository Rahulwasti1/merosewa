<?php
require_once '../../helpers/redirect-to-login.php';
require_once '../../models/SessionUser.php';
require_once '../../../Database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}
unset($_SESSION['success_message'], $_SESSION['error_message']);
$jobId = $_GET['id'] ?? null;
if (null === $jobId) {
    $_SESSION['error_message'] = "Invalid Job ID.";
    header('Location: index.php');
    exit;
}

if (empty($_POST['feedback'])) {
    $_SESSION['error_message'] = "Please fill in all required fields.";
    header("Location: create.php?id=$jobId");
    exit;
}

$userId = SessionUser::getId();
$db = new Database();
$jobDetails = $db->selectFirst(
    "SELECT
        j.id as job_id,
        b.consumer as written_by ,
        s.service_provider as written_for
    FROM job as j
    JOIN booking as b ON b.id =j.booking
    JOIN service as s ON b.service = s.id
    WHERE b.consumer = ? AND j.id = ?
    LIMIT 1;",
    [$userId, $jobId]
);
if (!$jobDetails) {
    $_SESSION['error_message'] = "Job not found.";
    header('Location: index.php');
    exit;
}
$feedback = $_POST['feedback'];
try {
    $db->getConnection()->beginTransaction();
    $inserted = $db->insert(
        "INSERT INTO
            feedback(written_by, written_for, body)
        VALUES(?, ?, ?);",
        [$jobDetails['written_by'], $jobDetails['written_for'], $feedback]
    );

    if (!$inserted) {
        throw new Exception("Failed to insert feedback record.");
    }
    $rowCount =  $db->update(
        "UPDATE job as j
        SET j.feedback = ?
        WHERE j.id = ?;
        ",
        [$inserted, $jobDetails['job_id']]
    );

    if ($rowCount < 1) {
        throw new Exception("Failed to correlate feedback to job.");
    }


    $db->getConnection()->commit();

    $_SESSION['success_message'] = "Feedback successfully submitted.";
    header("Location: index.php");
    exit;
} catch (PDOException $e) {
    $db->getConnection()->rollBack();
    $_SESSION['error_message'] = $e->getMessage();
    header('Location: index.php');
    exit;
}
