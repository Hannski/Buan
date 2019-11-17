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
    extract($data);
    ob_start();
    require_once BASEPATH.'/app/View/templates/'.$this->_templateDatei;
    $htmlResponse = ob_get_contents();
    ob_end_clean();
    return $htmlResponse;
}
}