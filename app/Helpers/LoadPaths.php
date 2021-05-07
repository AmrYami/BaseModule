<?php

function getModuleName($moduleName)
{
    return app_path('Modules' . DS() . $moduleName . DS());
}

function loadRoute($fileName, $moduleName)
{
    return getModuleName($moduleName) . 'routes' . DS() . $fileName . '.php';
}

function loadViews($moduleName)
{
    return getModuleName($moduleName) . 'resources' . DS() . 'views';
}

function loadMigrations($moduleName)
{
    return getModuleName($moduleName) . 'database' . DS() . 'migrations';
}

function loadLang($moduleName)
{
    return getModuleName($moduleName) . 'resources' . DS() . 'lang';
}

function buildControllerNamespace(string $moduleName){
    return ucfirst($moduleName).'\Http\Controllers';
}

function DS()
{
    return DIRECTORY_SEPARATOR;
}
