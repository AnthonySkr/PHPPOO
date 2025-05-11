<?php

namespace Classes\Provision;

class Watermelon extends Provision {

    public function __construct() 
    {
        $this->icon = '🍉';
        $this->name = 'Watermelon';

        $this->moodPoints = -20;
        $this->hungerPoints = -30;
        $this->thirstPoints = -10;
    }
}