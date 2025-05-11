<?php

namespace Classes\Provision;

class Cola extends Provision {

    public function __construct() 
    {
        $this->icon = '🥤';
        $this->name = 'Cola';

        $this->moodPoints = 30;
        $this->thirstPoints = -10;
    }
}