# Tamagotchi Game

Ce projet est un mini-jeu de type Tamagotchi développé en **PHP orienté objet**. Le joueur peut gérer un zoo virtuel en créant des animaux, en les nourrissant, en les soignant, et en les faisant interagir. Chaque action coûte des points d'action, et les animaux évoluent au fil des jours.

## ✨ Fonctionnalités

-  **Créer des animaux** : Donnez un nom et une icône à vos animaux.
-  **Nourrir les animaux** : Utilisez des provisions pour réduire leur faim et leur soif.
-  **Soigner les animaux** : Restaurez leur santé.
-  **Caresser les animaux** : Améliorez leur humeur.
-  **Faire jouer les animaux ensemble** : Augmentez leur humeur et donnez une chance de reproduction.
-  **Passer la nuit** : Les animaux vieillissent et leurs besoins augmentent.

## 🎮 Règles du jeu

-  Chaque jour, le joueur dispose de **3 points d'action**.
-  Les actions disponibles et leurs coûts :
   -  **Nourrir un animal** : 1 point
   -  **Soigner un animal** : 3 points
   -  **Caresser un animal** : 2 points
   -  **Chercher des provisions** : 1 point
   -  **Faire jouer deux animaux ensemble** : 1 point
   -  **Créer un nouvel animal** : 1 point
-  Les animaux ont les caractéristiques suivantes :
   -  **Faim** : 0 à 100 (100 = très faim)
   -  **Soif** : 0 à 100 (100 = très soif)
   -  **Santé** : 0 à 100 (0 = mort)
   -  **Humeur** : 0 à 100 (0 = très triste)
   -  **Âge** : en jours

## 🗂️ Structure du projet

index.php
interface.php
README.md
classes/
├── Game.php
├── Animal/
│ └── Animal.php
├── Provision/
│ ├── Provision.php
│ ├── Watermelon.php
│ ├── Water.php
│ ├── Burger.php
│ └── Cola.php
styles/
└── interface.css

### Description des fichiers

-  **`index.php`** : Point d'entrée principal du jeu. Gère les actions du joueur et affiche l'interface.
-  **`interface.php`** : Interface utilisateur HTML pour interagir avec le jeu.
-  **`classes/`** : Contient toutes les classes PHP utilisées dans le projet.
   -  **`Game.php`** : Gère la logique principale du jeu.
   -  **`Animal/Animal.php`** : Définit les animaux et leurs comportements.
   -  **`Provision/`** : Contient les différentes provisions (eau, pastèque, etc.).
-  **`styles/interface.css`** : Feuille de style pour l'interface utilisateur.

## 🚀 Installation

1. Clonez ce dépôt sur votre machine locale :
   `git clone <url-du-repo>`
2. Lancez le serveur PHP intégré :
   `php -S localhost:8000`
3. Accédez au jeu via votre navigateur :
   `http://localhost:8000/index.php`

## 🕹️ Utilisation

-  Créer un animal : Donnez-lui un nom et une icône.
-  Gérer vos animaux : Nourrissez-les, soignez-les, ou faites-les jouer.
-  Passer la nuit : Les animaux vieillissent et leurs besoins augmentent.
-  Chercher des provisions : Trouvez des ressources pour nourrir vos animaux.
