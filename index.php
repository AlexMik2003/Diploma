<?php

ini_set('display_errors', 1);

require_once 'config/bootstrap.php';

use app\App;

$app= new App();
$app->run();
