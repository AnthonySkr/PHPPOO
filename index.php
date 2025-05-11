<?php
spl_autoload_register(function($className) {

    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $filename = str_replace('Classes/', __DIR__ . '/classes/', $className) . '.php';

    if (file_exists($filename)) {
        require $filename;
    }
});

session_start();

use Classes\Game;

use Classes\Animal\Animal;

use Classes\Provision\Provision;
use Classes\Provision\Burger;
use Classes\Provision\Cola;
use Classes\Provision\Water;
use Classes\Provision\Watermelon;

// Je récupère Game en session
$game = $_SESSION['game'] ?? Game::getInstance();

if (isset($_POST['action'])) {
    // Si j'ai une action, je la traite

    switch ($_POST['action']) {

        case 'createAnimal':
            // Je crée un animal
            $animal = new Animal($_POST['icon'], $_POST['name']);
            $game->addAnimal($animal);
            break;

        case 'reset':
            // Je réinitialise le jeu
            $game = null;
            break;

        case 'night':
            $game->night();
            break;

        case 'provision':
            $game->addProvision();
            break;

        case 'feedAnimal':
            $game-> feedAnimal($_POST['animal'], $_POST['provision']);

            break;
        case 'healAnimal':
            $game->healAnimal($_POST['animal']);
            break;
        case 'petAnimal':
            $game->petAnimal($_POST['animal']);
            break;
    }

    // Puis je termine par une redirection
    header('Location: index.php');
} else {
    // Sinon j'affiche l'interface
    require('interface.php');
    $game->clearMessages();
}

// Je sauvegarde Game en session
$_SESSION['game'] = $game;