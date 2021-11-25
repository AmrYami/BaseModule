<?php

function serverName()
{
    $sslOrNot = env('HTTPS');
    if ($sslOrNot == FALSE)
        $sslOrNot = 'http://';
    else
        $sslOrNot = 'https://';
    return $sslOrNot . request()->getHost();
}
