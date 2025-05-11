<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo</title>
    <link rel="stylesheet" href="styles/interface.css">
</head>
<body>
<div class="info-bar">
        Points restants : <?= $game->getPoints() ?> | Jour actuel : <?= $game->getDays() ?>
    </div>
    
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="reset">
        <button type="submit">Reset</button>
    </form>

    <form action="index.php" method="post">
        <input type="hidden" name="action" value="night">
        <button type="submit">Passer la nuit</button>
    </form>

    <form action="index.php" method="post">
        <input type="hidden" name="action" value="createAnimal">
        <input type="text" name="name" placeholder="Animal name" required>
        <select name="icon">
            <option>🐻</option>
            <option>🐼</option>
            <option>🐨</option>
            <option>🐯</option>
            <option>🦁</option>
            <option>🐮</option>
        </select>
        <button type="submit">GO</button>
    </form>

    <?php foreach ($game->getMessages() as $message) : ?>
        <div>
            <?= $message ?>
        </div>
    <?php endforeach; ?>

    <h2>Animals</h2>
    <div class="animals">
        <?php foreach ($game->getAnimals() as $index => $animal): ?>
            <div class="animal-card">             
                <?= $animal->getName() ?>
                <?= $animal->getIcon() ?>
                <div>
                    <div>Age: <?= $animal->getAge() ?></div>
                    <div>Health: <?= $animal->getHealth() ?></div>
                    <div>Mood: <?= $animal->getMood() ?></div>
                    <div>Hunger: <?= $animal->getHunger() ?></div>
                    <div>Thirst: <?= $animal->getThirst() ?></div>
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
                        <button type="submit">Feed</button>
                    </form>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="healAnimal">
                        <input type="hidden" name="animal" value="<?= $index ?>">
                        <button type="submit">Heal</button>
                    </form>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="petAnimal">
                        <input type="hidden" name="animal" value="<?= $index ?>">
                        <button type="submit">Pet</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <h2>Provisions</h2>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="provision">
        <button type="submit">Chercher une provision</button>
    </form>

    <div class="provisions">
        <?php foreach ($game->getProvisions() as $index => $provision): ?>
            <div class="provision-card">                
                <?= $provision->getName() ?>
                <?= $provision->getIcon() ?>
                <div>
                    <div>Health Points: <?= $provision->getHealthPoints() ?></div>
                    <div>Mood Points: <?= $provision->getMoodPoints() ?></div>
                    <div>Hunger Points: <?= $provision->getHungerPoints() ?></div>
                    <div>Thirst Points: <?= $provision->getThirstPoints() ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <pre>
    <?php print_r($game); ?>
    </pre>
</body>
</html>