<?php
namespace AUTO;

class Car extends Engine
{
    use EmergencyBrake;

    public function __construct($enginePower)
    {
        parent::__construct($enginePower);
    }
}
