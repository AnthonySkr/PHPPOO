<?php

namespace Classes\Provision;

class Burger extends Provision {

    public function __construct() 
    {
        $this->icon = '🍔';
        $this->name = 'Burger';

        $this->moodPoints = -10;
        $this->hungerPoints = -100;
        $this->thirstPoints = 30;
    }
}