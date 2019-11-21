<?php
namespace View;

class Template
{
protected $_templateDatei  = null;
public function __construct($_templateDatei)
{
    $this->_templateDatei = $_templateDatei;
}
public function renderTemplate(array $data)
{
	include BASEPATH.'/app/includes/languageCheck.php';
    include BASEPATH.'/app/includes/styleCheck.php';
	$langArray = $langArray;
    extract($data);
    ob_start();
    require_once BASEPATH.'/templates/'.$this->_templateDatei;
    $langArray = $langArray;
    $htmlResponse = ob_get_contents();
    ob_end_clean();
    return $htmlResponse;
}

}