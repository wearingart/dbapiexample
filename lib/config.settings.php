<?php
/*
 * Description: This page is used to parse the settings ini file for the app in one
 * location, and the settings are used throughout the application.
 */

if (!isset($settings) || !array($settings)) {
    $settings = parse_ini_file('/home/wearingart/DbApiExample.ini', TRUE);
}

//date_default_timezone_set($settings['timezone']['identifier']);
//error_reporting($settings['errors']['error_reporting']);
//ini_set('display_errors', $settings['errors']['display_errors']);
