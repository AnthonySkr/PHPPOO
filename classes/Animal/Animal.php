<?php

namespace Classes\Animal;

use Classes\Game;
use Classes\Provision\Provision;

class Animal {
    private $icon;
    private $name;
    private $age = 0;

    private $health = 100;
    private $mood = 100;
    private $hunger = 50;
    private $thirst = 50;

    public function __construct($icon, $name) 
    {
        $this->icon = $icon;
        $this->name = $name;
    }

    public function isDead()
    {
        return $this->health == 0;
    }

    public function getIcon() 
    {
        return $this->icon;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function getAge() 
    {
        return $this->age;
    }

    public function  getHealth() 
    {
        return $this->health;
    }

    public function getMood() 
    {
        return $this->mood;
    }

    public function getHunger() 
    {
        return $this->hunger;
    }

    public function getThirst() 
    {
        return $this->thirst;
    }

    public function changeHealth($points) 
    {
        $game = Game::getInstance();
        $game->addMessage("{$this->name}: {$points} health points.");
        
        $this->health += $points;

        if ($this->health > 100)
        {
            $this->health = 100;
        }
        elseif ($this->health < 0)
        {
            $this->health = 0;
        }
    }

    public function changeMood($points) 
    {
        $game = Game::getInstance();
        $game->addMessage("{$this->name}: {$points} mood points.");

        $this->mood += $points;

        if ($this->mood > 100) 
        {
            $this->mood = 100;
        }
        elseif ($this->mood < 0) 
        {
            $this->mood = 0;
        }
    }

    public function changeHunger($points) 
    {
        $game = Game::getInstance();
        $game->addMessage("{$this->name}: {$points} hunger points.");

        $this->hunger += $points;

        if ($this->hunger > 100) 
        {
            $this->hunger = 100;
        }
        elseif ($this->hunger < 0) 
        {
            $this->hunger = 0;
        }
    }

    public function changeThirst($points) 
    {
        $game = Game::getInstance();
        $game->addMessage("{$this->name}: {$points} thirst points.");

        $this->thirst += $points;

        if ($this->thirst > 100) 
        {
            $this->thirst = 100;
        }
        elseif ($this->thirst < 0) 
        {
            $this->thirst = 0;
        }
    }

    public function sleep() 
    {
        if(! $this->isDead()) {
            $this->age++;
            $this->changeHunger(rand(5, 15));
            $this->changeThirst(rand(5, 15));
            $this->changeMood(rand(-80, 80));

            if($this->hunger >= 100)
            {
                $this->changeHealth(rand(-30, -10));
            }

            if($this->thirst >= 100)
            {
                $this->changeHealth(rand(-30, -10));
            }

            if($this->mood <= 0)
            {
                $this->changeHealth(rand(-20, 0));
            }

            // Chance de créer un enfant if age > 10
            if ($this->age > 10) {
                $chance = rand(0, 100);
                if ($chance < 20) {
                    $game = Game::getInstance();
                    $baby = new Animal($this->icon, "{$this->name} Junior");
                    $game->addAnimal($baby);
                    $game->addMessage("{$this->name} had a baby!");
                }
            }
        }
    }

    public function consume(Provision $provision)
    {
        if(! $this->isDead()) {
            $this->changeHealth($provision->getHealthPoints());
            $this->changeMood($provision->getMoodPoints());
            $this->changeHunger($provision->getHungerPoints());
            $this->changeThirst($provision->getThirstPoints());
        }
    }
}