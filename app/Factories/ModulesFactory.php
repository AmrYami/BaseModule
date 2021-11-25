<?php

namespace App\Factories;

class ModulesFactory
{

    public static function build(string $module)
    {
        if (class_exists($module)) {
            return app()->make($module);
        } else {
            throw new Exception("Invalid Module type given.");
        }
    }
}
