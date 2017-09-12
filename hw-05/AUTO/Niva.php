<?php
namespace AUTO;

class Niva extends Car
{
    /**
     * @var TransmissionManual
     */
    public $transmission;


    public function __construct($transmission, $enginePower)
    {
        echo "Создание автомобиля Нива<br />\n";
        parent::__construct($enginePower);
        $this->transmission = new $transmission;
        echo "<br /><hr />";
    }

    public function startMovement($distance, $speed, $direction = 'вперёд')
    {
        if ($distance <= 0 || $speed <= 0) {
            return false;
        }

        echo "Поехали!<br />";

        $maxSpeed = $this->getMaxSpeed();
        if ($maxSpeed < $speed) {
            return $this->startMovement($distance, $maxSpeed, $direction);
        }

        $this->ignition();
        $this->releaseEmergencyBrake();
        $this->transmission->selectGear($speed, $direction);

        $currentLocation = 0;
        while ($distance - $currentLocation >= 10) {
            $currentLocation += 10;
            echo "Проехали $currentLocation метров.";
            $this->temperatureGoUp(5);
        }

        if ($distance > $currentLocation) {
            echo "Проехали $distance метров.";
            $this->temperatureGoUp(
                5 / 10 * ($distance - $currentLocation)
            );
        }

        $this->transmission->neutralGear();
        $this->applyEmergencyBrake();
        $this->switchOff();
        return true;
    }
}
