<?php

use Vandy\GitSearch;
require_once "./lib/config.settings.php";
include_once $settings["paths"]["lib_root"] . "config.db.php";
include_once $settings["paths"]["vandy_root"] . "class.GitSearch.php";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.github.com/search/repositories?q=created%3A%3E2000-01-01&sort=stars&order=desc",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "User-Agent: Vandy-Code-Test",
        "cache-control: no-cache"
    ),
));

$responseJson = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    $result = "cURL Error #:" . $err;
} else {
    $response = json_decode($responseJson, true);

    $search = new GitSearch();
    $search->saveMostStarred($response);
    $result = $search->generateStarredList();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Brian Wilkins - Vanderbilt - VICTR - Code Test</title>

    <!-- Bootstrap core CSS -->
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/vendor/bootstrap/starter-template.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brian Wilkins - Code Test</a>
        </div>
    </div>
</nav>

<div class="container">

    <div class="starter-template">
        <h1>Get Most Starred Public Git Repositories</h1>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?= $result; ?>


        </div><!-- end panel-group -->
    </div>

</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="./bower_components/jquery/dist/jquery.min.js"></script>
<script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>