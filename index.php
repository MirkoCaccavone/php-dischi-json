<?php

// includiamo il file functions.php per avere accesso alla variabile $albums
// che contiene i dati del file json
require_once "./functions.php";

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dischi json</title>
</head>
<body>
    <h1>
        Album
    </h1>

    <form action="server.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add_album">
        <h2>Inserisci un nuovo album</h2>
        <input type="text" name="titolo" placeholder="Titolo">
        <input type="text" name="artista" placeholder="Artista">
        <input type="text" name="anno" placeholder="Anno">
        <input type="text" name="genere" placeholder="Genere">
        <input type="file" name="cover" accept="image/*">
        <button type="submit">Aggiungi</button>
    </form>
    <div class="containerCard">
        <?php 
    foreach ($albums as $album) {
        ?>
        <div class="card">
            <img src="<?php echo $album['cover']; ?>" alt="<?php echo $album['titolo']; ?>">
            <h3><?php echo $album['titolo']; ?></h3>
            <h4><?php echo $album['artista']; ?></h4>
            <p>Anno: <?php echo $album['anno']; ?></p>
            <p>Genere: <?php echo $album['genere']; ?></p>
        </div>
        <?php
    }
    ?>

    
    </div>
</body>
</html>