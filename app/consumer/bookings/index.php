<?php
require_once '../../helpers/redirect-to-login.php';
require_once '../../models/SessionUser.php';
require_once '../../../Database.php';

$db = new Database();
$bookings = $db->selectAll("SELECT * FROM booking;");
echo json_encode($bookings);
