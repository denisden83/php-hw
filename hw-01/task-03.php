<?php
define('GREETING', 'Hey!');
$constant = "GREETING";
if (defined('GREETING')) {
    echo constant('GREETING') . " I exist!<br />\n";
}
echo constant($constant) . " " . "How are you?<br />\n";
define('GREETING', 'Hello!');
echo GREETING . ' Where is "Hello!" ???';
