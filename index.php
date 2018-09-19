<?php

//INCLUDE THE FILES NEEDED...
require_once('model/ExeptionModel.php');
require_once('controller/LoginController.php');
require_once('model/LoginModel.php');
require_once('model/RegisterUserModel.php');
require_once('view/LoginView.php');
require_once('view/RegisterView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$em = new \model\ExeptionModel();
$v = new \view\LoginView($em);
$lm = new \model\LoginModel();
$rum = new \model\RegisterUserModel();
$rw = new \view\RegisterView();
$lc = new \controller\LoginController($v, $lm, $rw, $rum);
$dtv = new \view\DateTimeView();
$lv = new \view\LayoutView();

$lc->registerOrCheckUser();

$lv->render($lc->getLoggedInStatus(), $lc, $dtv);

