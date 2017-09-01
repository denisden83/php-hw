<?php
namespace AUTO;

spl_autoload_register(function ($classname) {
    require_once(__DIR__ . "/{$classname}.php");
//    require_once(__DIR__ . "/AUTO/" . $classname . ".php");
//    echo "{$classname}<br />";
});
