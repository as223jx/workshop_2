<?php

require_once 'BodyView.php';
require_once 'BoatController.php';

session_start();
	$controller = new BoatController();
	$htmlBody = $controller->control();
	$view = new BodyView();
	$view->echoBody($htmlBody);
