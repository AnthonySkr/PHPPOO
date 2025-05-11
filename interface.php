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
                    <div class="animal-card">
                        <h3><?= $animal->getName() ?> <?= $animal->getIcon() ?></h3>
                        <div class="animal-stats">
                            <div>Âge : <?= $animal->getAge() ?></div>
                            <div>Santé : <?= $animal->getHealth() ?></div>
                            <div>Humeur : <?= $animal->getMood() ?></div>
                            <div>Faim : <?= $animal->getHunger() ?></div>
                            <div>Soif : <?= $animal->getThirst() ?></div>
                        </div>
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
        <pre>
            <?php print_r($game); ?>
        </pre>
    </footer>
</body>
</html>