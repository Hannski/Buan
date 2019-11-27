<?php
namespace View;

class Template
{

public function __construct($_templateDatei)
{
    
}
public function language(array $data)
{
	include BASEPATH.'/app/includes/languageCheck.php';
    include BASEPATH.'/app/includes/styleCheck.php';
	
}

}