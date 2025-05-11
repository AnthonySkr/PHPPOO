<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo</title>
    <link rel="stylesheet" href="styles/interface.css">
</head>
<body>
    <header class="info-bar">
        <div>Points restants : <?= $game->getPoints() ?></div>
        <div>Jour actuel : <?= $game->getDays() ?></div>
    </header>

    <main>
        <section class="actions">
            <form action="index.php" method="post">
                <input type="hidden" name="action" value="reset">
                <button type="submit" class="btn btn-danger">Reset</button>
            </form>

            <form action="index.php" method="post">
                <input type="hidden" name="action" value="night">
                <button type="submit" class="btn btn-primary">Passer la nuit</button>
            </form>

            <form action="index.php" method="post">
                <input type="hidden" name="action" value="playTogether">
                <button type="submit" class="btn btn-warning">Faire jouer tous les animaux</button>
            </form>

            <form action="index.php" method="post" class="create-animal-form">
                <input type="hidden" name="action" value="createAnimal">
                <input type="text" name="name" placeholder="Nom de l'animal" required>
                <select name="icon">
                    <option>🐻</option>
                    <option>🐼</option>
                    <option>🐨</option>
                    <option>🐯</option>
                    <option>🦁</option>
                    <option>🐮</option>
                </select>
                <button type="submit" class="btn btn-success">Créer</button>
            </form>
        </section>

        <section class="messages">
            <?php foreach ($game->getMessages() as $message) : ?>
                <div class="message">
                    <?= $message ?>
                </div>
            <?php endforeach; ?>
        </section>

        <section class="animals">
            <h2>Animaux</h2>
            <div class="animal-list">
                <?php foreach ($game->getAnimals() as $index => $animal): ?>
                    <div class="animal-card <?= $animal->isDead() ? 'dead' : '' ?>">
                        <h3><?= $animal->getName() ?> <?= $animal->getIcon() ?></h3>
                        <div class="animal-stats">
                            <div>Âge : <?= $animal->getAge() ?></div>
                            <div>Santé : <?= $animal->getHealth() ?></div>
                            <div>Humeur : <?= $animal->getMood() ?></div>
                            <div>Faim : <?= $animal->getHunger() ?></div>
                            <div>Soif : <?= $animal->getThirst() ?></div>
                        </div>
                        <?php if ($animal->isDead()): ?>
                            <div class="animal-status">Cet animal est mort et ne peut plus être interagi avec.</div>
                        <?php else: ?>
                            <div class="animal-actions">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="action" value="feedAnimal">
                                    <input type="hidden" name="animal" value="<?= $index ?>">
                                    <select name="provision">
                                        <?php foreach ($game->getProvisions() as $provisionIndex => $provision): ?>
                                            <option value="<?= $provisionIndex ?>"><?= $provision->getIcon() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Nourrir</button>
                                </form>
                                <form action="index.php" method="post">
                                    <input type="hidden" name="action" value="healAnimal">
                                    <input type="hidden" name="animal" value="<?= $index ?>">
                                    <button type="submit" class="btn btn-warning">Soigner</button>
                                </form>
                                <form action="index.php" method="post">
                                    <input type="hidden" name="action" value="petAnimal">
                                    <input type="hidden" name="animal" value="<?= $index ?>">
                                    <button type="submit" class="btn btn-secondary">Caresser</button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="provisions">
            <h2>Provisions</h2>
            <form action="index.php" method="post">
                <input type="hidden" name="action" value="provision">
                <button type="submit" class="btn btn-success">Chercher une provision</button>
            </form>
            <div class="provision-list">
                <?php foreach ($game->getProvisions() as $index => $provision): ?>
                    <div class="provision-card">
                        <h3><?= $provision->getName() ?> <?= $provision->getIcon() ?></h3>
                        <div class="provision-stats">
                            <div>Points de santé : <?= $provision->getHealthPoints() ?></div>
                            <div>Points d'humeur : <?= $provision->getMoodPoints() ?></div>
                            <div>Points de faim : <?= $provision->getHungerPoints() ?></div>
                            <div>Points de soif : <?= $provision->getThirstPoints() ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <footer>
        <!--
        <pre>
            <?php print_r($game); ?>
        </pre>
        -->
                <div class="game-rules">
            <h3>Tamagotchi Game — Règles du jeu</h3>
            <p>Gérez un zoo virtuel : créez, nourrissez, soignez et faites interagir vos animaux. Chaque jour, vous disposez de <strong>3 points d'action</strong> en plus de ceux restant du jour précédent.</p>
        
            <h4>Actions disponibles</h4>
            <ul>
                <li><strong>Créer un animal</strong> : 1 point — Ajoutez un nouvel animal à votre zoo avec un nom et une icône.</li>
                <li><strong>Nourrir un animal</strong> : 1 point — Utilisez une provision pour réduire la faim d'un animal.</li>
                <li><strong>Soigner un animal</strong> : 3 points — Restaurez la santé d'un animal malade ou blessé.</li>
                <li><strong>Caresser un animal</strong> : 2 points — Améliorez l'humeur d'un animal en le caressant.</li>
                <li><strong>Faire jouer tous les animaux</strong> : 5 points — Améliorez l'humeur de tous les animaux vivants.</li>
                <li><strong>Chercher des provisions</strong> : 1 point — Ajoutez une nouvelle provision à votre inventaire (aléatoire).</li>
            </ul>
        
            <h4>Ce qu'il peut se passer pendant la nuit</h4>
            <ul>
                <li>Les animaux consomment des ressources (faim et soif augmentent).</li>
                <li>Les animaux vieillissent d'un jour.</li>
                <li>Les animaux malades ou affamés peuvent perdre de la santé.</li>
                <li>Les points d'action non utilisés sont reportés au jour suivant.</li>
            </ul>
        
            <h4>Caractéristiques des animaux</h4>
            <ul>
                <li><strong>Faim</strong> : 0 à 100 (100 = très faim, l'animal perd de la santé).</li>
                <li><strong>Soif</strong> : 0 à 100 (100 = très soif, l'animal perd de la santé).</li>
                <li><strong>Santé</strong> : 0 à 100 (0 = mort).</li>
                <li><strong>Humeur</strong> : 0 à 100 (0 = très triste).</li>
                <li><strong>Âge</strong> : en jours (les animaux vieillissent chaque nuit).</li>
            </ul>
        
            <h4>Objectif</h4>
            <p>Entretenez vos animaux, faites-les interagir et veillez à leur bien-être au fil des jours. N'oubliez pas de passer la nuit pour faire avancer le temps.</p>
        
            <p><em>Bon jeu ! 🐾</em></p>
        </div>
    </footer>
</body>
</html>