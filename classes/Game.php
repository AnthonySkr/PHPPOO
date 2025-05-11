<?php

namespace Classes;

use Classes\Animal\Animal;

use Classes\Provision\Provision;
use Classes\Provision\Burger;
use Classes\Provision\Cola;
use Classes\Provision\Water;
use Classes\Provision\Watermelon;

class Game {
    private $points = 3;
    private $days = 1;
    private $unusedPoints = 0;

    private $animals = [];
    private $provisions= [];
    
    private $messages = [];
    
    private static $instance = null;

    private function __construct() {}

    public function __wakeup() 
    {
        self::$instance = $this;
    }

    // Getters
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getAnimals() 
    {
        return $this->animals;
    }

    public function getProvisions()
    {
        return $this->provisions;
    }

    public function getMessages() 
    {
        return $this->messages;
    }

    public function getPoints() 
    {
        return $this->points;
    }

    public function getDays() 
    {
        return $this->days;
    }

    // Setters
    public function addAnimal(Animal $animal) 
    {
        if ($this->consumePoints(1)) {
            $this->animals[] = $animal;
            $this->addMessage("Welcome {$animal->getName()} !");
        }
    }

    public function addProvision() 
    {
        if ($this->consumePoints(1)) {
            // Je cherche une provision
            $rand = rand(0, 100);

            if ($rand < 30) {
                $provision = new Watermelon;
            } elseif ($rand < 50) {
                $provision = new Burger;
            } elseif ($rand < 80) {
                $provision = new Cola;
            } elseif ($rand < 90) {
                $provision = new Water;
            } else {
                $this->addMessage("Vous n'avez rien trouvé !");
            }

            if (isset($provision)) {
                $this->provisions[] = $provision;
                $this->addMessage("You found a provision !");
            }
        }
    }

    public function addMessage($message) 
    {
        $this->messages[] = $message;
    }

    public function clearMessages() 
    {
        $this->messages = [];
    }

    public function night() 
    {
        $this->unusedPoints += $this->points;
        $this->points = 3 + $this->unusedPoints;
        $this->unusedPoints = 0;

        $this->days++;

        foreach ($this->animals as $id => $animal) {
            $animal->sleep();
        }

        $this->addMessage("La nuit est passée. Vous avez maintenant {$this->points} points d'action.");
    }

    public function feedAnimal($animalId, $provisionId) {
        if (!isset($this->provisions[$provisionId])) {
            $this->addMessage("Vous n'avez pas de provision valide pour nourrir cet animal !");
            return;
        }
        
        if ($this->consumePoints(1)) {
            $animal = $this->animals[$animalId];
            $provision = $this->provisions[$provisionId];

            $animal->consume($provision);
                
            unset($this->provisions[$provisionId]);
        }
    }

    public function healAnimal($animalId) 
    {
        if ($this->consumePoints(3)) {
            $animal = $this->animals[$animalId];
            $healthBoost = rand(20, 100);
            $animal->changeHealth($healthBoost);
            $this->addMessage("You healed {$animal->getName()} and restored {$healthBoost} health points!");
        }
    }

    public function petAnimal($animalId) 
    {
        if ($this->consumePoints(2)) {
            $animal = $this->animals[$animalId];
            $moodBoost = rand(0, 30);
            $animal->changeMood($moodBoost);
            $this->addMessage("You petted {$animal->getName()} and improved its mood by {$moodBoost} points!");
        }
    }

        public function playTogether()
    {
        if (count($this->animals) < 2) {
            $this->addMessage("Vous devez avoir au moins 2 animaux pour jouer ensemble !");
            return;
        }

        $aliveAnimals = array_filter($this->animals, function ($animal) {
            return !$animal->isDead();
        });

        if (count($aliveAnimals) < 2) {
            $this->addMessage("Vous devez avoir au moins 2 animaux vivants pour jouer ensemble !");
            return;
        }
    
        if ($this->consumePoints(5)) {
            foreach ($aliveAnimals as $animal) {
                $moodBoost = rand(10, 30);
                $animal->changeMood($moodBoost);
            }
    
            $this->addMessage("Les animaux ont joué ensemble et leur humeur s'est améliorée !");
        }
    }

    private function consumePoints($points) 
    {
        if ($this -> points >= $points) {
            $this->points -= $points;
            return true;
        }

        $this->addMessage("Not enough points to perform this action.");

        return false;
    }
}