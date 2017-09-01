<?php
namespace AUTO {

    class Engine
    {
        private $temperature = 0;
        private $enginePower = 20;
        private $maxSpeed;
        
        public function __construct($enginePower = 20)
        {
            $this->enginePower = $enginePower;
            $this->maxSpeed = $enginePower * 2;
            echo 'Двигатель. Мощность - ', $this->enginePower, 'л.с., ',
            't = ', $this->temperature, ' градусов, Максимальная скорость - ',
            $this->maxSpeed, 'м/с<br />', PHP_EOL;
        }
        
        public function getTemperature()
        {
            return $this->temperature;
        }
        
        public function getPower()
        {
            return $this->enginePower;
        }
        
        public function getMaxSpeed()
        {
            return $this->maxSpeed;
        }
        
        public function ignition()
        {
            echo 'Зажигание двигателя', '<br />', PHP_EOL;
        }
        
        public function switchOff()
        {
            echo 'Выключение двигателя', '<br />', PHP_EOL;
        }

        public function temperatureGoUp($rise)
        {
            $this->temperature += $rise;
            echo " t(двигателя)={$this->temperature}гр<br />\n";
            if ($this->temperature >= 90) {
                $this->temperature -= 10;
                echo "Включился вентилятор t=", $this->temperature,
                "гр<br />", PHP_EOL;
            }
        }
    }
}
