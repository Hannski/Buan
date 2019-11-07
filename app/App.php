<?php

class App
{
	function __construct()
	{
	require "./app/languageCheck.php";
	include "config.php";
	//header, Navigationsleiste
	require_once 'View/seitenkomponenten/header.php';
	require_once 'View/templates/home.html';
	//Url verarbeiten->Inhalte einfuegen
	$url = new Router();
	//Footer
	require_once 'View/seitenkomponenten/footer.php'; 
	}
}
