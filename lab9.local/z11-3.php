<?php

    $userAgent = $_SERVER['HTTP_USER_AGENT'];


    $browserPatterns = array(
        '/MSIE ([0-9.]+)/i' => 'Internet Explorer $1',
        '/Firefox\/([0-9.]+)/i' => 'Firefox $1',
        '/Chrome\/([0-9.]+)/i' => 'Chrome $1',
        '/Safari\/([0-9.]+)/i' => 'Safari $1',
        '/Opera\/([0-9.]+)/i' => 'Opera $1'
    );

    $browser = 'Неизвестный браузер';

    foreach ($browserPatterns as $pattern => $name)
    {
        if (preg_match($pattern, $userAgent, $matches))
        {
            $browser = str_replace('$1', $matches[1], $name);
            break;
        }
    }


    $osPatterns = array(
        '/Windows NT ([0-9.]+)/i' => 'Windows $1',
        '/Mac OS X ([0-9_]+)/i' => 'Mac OS X $1',
        '/Linux/i' => 'Linux',
        '/Android/i' => 'Android',
        '/iPhone/i' => 'iPhone',
        '/iPad/i' => 'iPad'
    );

    $os = 'Неизвестная операционная система';


    foreach ($osPatterns as $pattern => $name)
    {
        if (preg_match($pattern, $userAgent, $matches))
        {
            $os = str_replace('$1', $matches[1], $name);
            break;
        }
    }


    echo "Браузер: {$browser}<br>";
    echo "Операционная система: {$os}";

?>

