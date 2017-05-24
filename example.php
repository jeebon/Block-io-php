<?php
	require("service.php");

	//Example 1
	$object = new BlockIoServeice();
	$address = $object->get_new_address();
	print_r($address); exit;


	//Example 2
	/*$object = new BlockIoServeice();
	$balance = $object->get_balance();
	print_r($balance); exit;*/