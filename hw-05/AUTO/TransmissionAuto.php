<?php
namespace AUTO;

class TransmissionAuto
{
    use ReverseGear;

    public function __construct()
    {
        echo " Автоматическая коробка передач<br />\n";
    }

    public function selectGear($speed, $direction = 'вперёд')
    {
        if ($direction == 'назад') {
            $this->goBack();
            echo "Двигаемся назад со скоростью {$speed}м/с<br />\n";
        } else {
            echo "Двигаемся вперёд со скоростью {$speed}м/с<br />\n";
        }
    }

    public function neutralGear()
    {
        echo "Нейтральная передача<br />";
    }
    
}
