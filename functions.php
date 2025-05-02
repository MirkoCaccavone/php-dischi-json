<?php

// leggiamo il file .json
$json_text = file_get_contents("./albums.json");

// salviamo la struttura dei dati tradotta dal json in un array
$albums = json_decode($json_text, true);
// var_dump($albums);


?>