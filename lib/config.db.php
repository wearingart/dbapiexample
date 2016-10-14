<?php
/*
 * Page: config.db.php
 *
 * Description: This is the configuration file that generates a connection to the database.
 * Only one connection is made during the lifetime of the app.
 */

use DbApiExample\Database;

require_once "/home/wearingart/webapps/dbapiexample/lib/config.settings.php";
//require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/config.settings.php";
include_once $settings["paths"]["dbapiexample_root"] . "class.Database.php";
//global $mysqli;

$db = new Database();
$db->connect();