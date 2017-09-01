<?php
namespace AUTO;

trait EmergencyBrake
{
    public function applyEmergencyBrake()
    {
        echo 'Ставим на ручник', '<br />', PHP_EOL;
    }
    
    public function releaseEmergencyBrake()
    {
        echo 'Снимаем с ручника', '<br />', PHP_EOL;
    }
}
