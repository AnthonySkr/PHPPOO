<?php

namespace Classes\Provision;

class Water extends Provision {

    public function __construct() 
    {
        $this->icon = '💧';
        $this->name = 'Water';

        $this->moodPoints = -20;
        $this->thirstPoints = -40;
    }
}