<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // configuration générale
    $uploadDir = 'uploads/';
    $authorizedExtensions = ['jpg', 'png', 'gif', 'webp'];
    $maxFileSize = 1000000;

    // gestion de l'upload
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $uploadFile = $uploadDir . uniqid("", false) . "." . $extension;
    move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);

    // infos profil
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $age = $_POST["age"];

    if (!in_array($extension, $authorizedExtensions)) {
        $errors[] = 'Veuillez sélectionner une image de type jpg, jpeg, png ou webp !';
    }

    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        $errors[] = "Votre fichier doit faire moins de 1Mo !";
    }
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
    <?php
    if (!empty($_FILES)) {
        echo "<img src='$uploadFile' alt='image téléchargée' /><br>";
        echo "Prénom : $firstname<br>Nom : $lastname<br>Age : $age ans  <br><br>";
    }
    ?>

    <form method="post" enctype="multipart/form-data">

        <label for="firstname">Prénom :</label><br>
        <input type="text" id="firstname" name="firstname" required><br>

        <label for="lastname">Nom :</label><br>
        <input type="text" id="lastname" name="lastname" required><br>

        <label for="age">Age :</label><br>
        <input type="number" id="age" name="age" required><br>

        <label for="imageUpload">Télécharger votre avatar</label>
        <input type="file" name="avatar" id="imageUpload" />

        <button name="send">Envoyer</button>
    </form>
</body>

</html>