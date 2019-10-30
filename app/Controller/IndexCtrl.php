<?php

/**
 * 
 */


class IndexCtrl extends Router
{
	function __construct()
	{
	
	
	

	require BASEPATH.'/app/Controller/AdminCtrl.php';
	
			
		
	}
	function hello()
	{
		$adminCtrl  = new AdminCtrl();
	}
}
