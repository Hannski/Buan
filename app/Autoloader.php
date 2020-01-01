<?php declare(strict_types = 1);

class Autoloader
{
    public function load(string $class):void
    {
        $pathName = str_replace('\\','/',$class);
        $path = sprintf('%s/app/%s.php'); BASEPATH.$pathName);
            if (!class_exists($class))
            {
                if(file_exists($path))
                {
                    require_once $path;
                }
            }
    }
}