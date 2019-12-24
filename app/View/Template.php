<?php
namespace View;

class Template
{
    protected $_tmplFile = null;

    public function __construct(string $tmplFile)
    {
        $this->_tmplFile = $tmplFile;
    }

    public function renderTemplate(array $data)
    {
        extract($data);
        ob_start();
        include BASEPATH. "/app/includes/languageCheck.php";
        require_once BASEPATH . '/templates/' . $this->_tmplFile.".php";
        $htmlResponse  = ob_get_contents();
        ob_end_clean();

        return $htmlResponse;
    }
}
