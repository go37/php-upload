<?php

// Je vérifie que le formulaire est soumis, comme pour tout traitement de formulaire.

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // chemin vers un dossier sur le serveur qui va recevoir les fichiers transférés (attention ce dossier doit être accessible en écriture)

    $uploadDir = 'uploads/';

    // le nom de fichier sur le serveur est celui du nom d'origine du fichier sur le poste du client (mais d'autre stratégies de nommage sont possibles)

    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);


    // on déplace le fichier temporaire vers le nouvel emplacement sur le serveur. Ca y est, le fichier est uploadé

    move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de votre profil</title>
</head>

<body>
    <form action="uploaded.php" method="post" enctype="multipart/form-data">
        <label for="imageUpload">Upload an profile image</label>
        <input type="file" name="avatar" id="imageUpload" />
        <button name="send">Send</button>
    </form>
</body>

</html>
