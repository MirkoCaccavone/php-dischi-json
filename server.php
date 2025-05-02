<?php

// Verifica se è stato caricato un file attraverso il form
if(isset($_FILES['cover'])) {
    // Definisce la cartella di destinazione per i file caricati
    $target_dir = "uploads/"; 

    // Ottiene l'estensione del file caricato e la converte in minuscolo
    $file_extension = strtolower(pathinfo($_FILES["cover"]["name"], PATHINFO_EXTENSION));
    
    // Crea un nome file univoco combinando uniqid() con l'estensione del file
    // uniqid() genera un ID univoco basato sul timestamp corrente
    $new_filename = uniqid() . '.' . $file_extension;
    
    // Combina il percorso della cartella con il nuovo nome del file
    $target_file = $target_dir . $new_filename;

    // Tenta di spostare il file dalla posizione temporanea alla cartella uploads
    if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
        // Se il caricamento ha successo, salva il percorso del file
        $cover_path = $target_file;
    } else {
        // Se il caricamento fallisce, interrompe l'esecuzione con un messaggio di errore
        die("Errore nel caricamento del file");
    }
}

// Legge il contenuto del file JSON esistente
$json_text = file_get_contents("./albums.json");

// Converte il JSON in un array PHP
$albums = json_decode($json_text);

// Crea un nuovo array associativo con i dati del form
// e lo aggiunge all'array degli album esistenti
$albums[] = [
    "titolo" => $_POST['titolo'],    // Titolo dell'album dal form
    "artista" => $_POST['artista'],  // Nome dell'artista dal form
    "anno" => $_POST['anno'],        // Anno di pubblicazione dal form
    "genere" => $_POST['genere'],    // Genere musicale dal form
    "cover" => $cover_path           // Percorso dell'immagine caricata
];

// Converte l'array aggiornato in formato JSON
$json_text = json_encode($albums);

// Salva il nuovo JSON nel file albums.json
file_put_contents('./albums.json', $json_text);

// Reindirizza l'utente alla pagina principale
header('Location: ./index.php');
?>