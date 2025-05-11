<?php

namespace Classes\Provision;

abstract class Provision {
    
    private $icon = '';
    private $name = '';

    private $healthPoints = 0;
    private $moodPoints = 0;
    private $hungerPoints = 0;
    private $thirstPoints = 0;

    public function getIcon() 
    {
        return $this->icon;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function getHealthPoints() 
    {
        return $this->healthPoints;
    }

    public function getMoodPoints() 
    {
        return $this->moodPoints;
    }

    public function getHungerPoints() 
    {
        return $this->hungerPoints;
    }

    public function getThirstPoints() 
    {
        return $this->thirstPoints;
    }
}