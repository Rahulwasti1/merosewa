<?php
require_once '../helpers/redirect-to-login.php';

require_once '../models/SessionUser.php';
require_once '../../Database.php';

function getServicesFromSession()
{
    $db = new Database();
    return $db->selectAll("SELECT * FROM service WHERE service_provider = ? ;", [SessionUser::getId()]);
}
