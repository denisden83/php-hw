<?php
namespace AUTO;

require_once(__DIR__ . "/init.php");

$transmissionManual = 'AUTO\TransmissionManual';
$transmissionAuto = 'AUTO\TransmissionAuto';
$enginePower = 50;

$niva = new Niva($transmissionManual, $enginePower);

$niva->startMovement(205, 10, "впёред");
