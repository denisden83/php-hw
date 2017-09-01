<?php
namespace AUTO;

class TransmissionManual
{
    use ReverseGear;

    public function __construct()
    {
        echo " Ручная коробка передач<br />\n";
    }

    public function selectGear($speed, $direction = 'вперёд')
    {
        if ($direction == 'назад') {
            $this->goBack();
            echo "Двигаемся назад со скоростью {$speed}м/с<br />\n";
        } else {
            if ($speed < 20) {
                $this->goForward1();
            } else {
                $this->goForward2();
            }
            echo "Двигаемся вперёд со скоростью {$speed}м/с<br />\n";
        }
    }

    public function neutralGear()
    {
        echo "Нейтральная передача<br />";
    }

    public function goForward1()
    {
        echo "Включил 1-ю передача<br />";
    }
    public function goForward2()
    {
        echo "Включил 2-ю передача<br />";
    }
}
