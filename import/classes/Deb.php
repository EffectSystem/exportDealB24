<?php

namespace import\classes;

class Deb
{
    public static function print($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    /* Функция логгирования
    * @var $data      - данные для записи
    * @var str $path  - путь к фалу
    * @var str $title - 
    */
    public static function log($data, $path, $title = 'DEBUG', $bool = true)
    {
        if ($bool) {
            $log = "\n-------------------------------------------------------------------\n";
            $log .= date('d.m.Y H:i:s') . "\n";
            $log .= $title . "\n";
            $log .= print_r($data, 1);
            $log .= "\n------------------------------------------------------------------\n";
            file_put_contents($path, $log, FILE_APPEND);
        }
        return true;
    }

    public static function mailLog($data, $path, $title = 'Mail', $bool = true)
    {
        if ($bool) {
            $log = date('d.m.Y H:i:s') . " ";
            $log .= $title . " ";
            $log .= print_r($data, 1);
            $log .= "\n";

            file_put_contents($path, $log, FILE_APPEND);
        }
        return true;
    }
}
