<?php
namespace View;

class Template
{
    protected $_tmplFile = null;

    public function __construct(string $tmplFile)
    {
        $this->_tmplFile = $tmplFile;
    }

    public function renderTemplate(array $data,$data2)
    {
        extract($data);
        extract($data2);
        ob_start();
        require BASEPATH."/app/includes/styleCheck.php";
        require BASEPATH."/app/includes/languageCheck.php";
        require BASEPATH.'/countries/countries.php';
        require_once BASEPATH . '/templates/' . $this->_tmplFile.".php";
        $htmlResponse  = ob_get_contents();
        ob_end_clean();

        return $htmlResponse;
    }
}
