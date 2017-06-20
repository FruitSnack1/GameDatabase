<?php
require_once ("connect_db.php");

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = (int) $_GET["id"];
} else {
    $id = NULL;
}
?>
<html>
    <head>
        <title>Edit Team </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    </head>
    <body>
        <div class="container">
            <h1>Edit Team <?php
            $query = $conn->prepare("SELECT name FROM teams WHERE id=$id");
            $query->execute();
            $name = $query->fetch();
            echo $name["name"];
        ?></h1>


            <div class="input-group col-lg-5" style="padding-top:5px">
                <input type="text" name="name" required="required" class="form-control" placeholder="Team name..." id="name">
                <span class="input-group-btn">
                    <button type="submit" name="submit" class="btn btn-defalut">Submit</button>
                </span>
            </div>
        </div>
    </body>
</html>
<?php

//
//if (isset($_POST["nazev"])) {
//    if (strlen($_POST["nazev"]) < 3) {
//        echo "Název trafiky musí být delší než 3 znaky.";
//    } else {
//        $nazev = filter_var($_POST["nazev"], FILTER_SANITIZE_STRING);
//        if ($id == NULL) {
//            $query = $conn->prepare("INSERT INTO trafiky VALUES (NULL, ?)");
//            $query->bindParam(1, $nazev, PDO::PARAM_STR);
//        } else {
//            $query = $conn->prepare("UPDATE trafiky SET "
//                    . " nazev = ? WHERE id = ?");
//            $query->bindParam(1, $nazev, PDO::PARAM_STR);
//            $query->bindParam(2, $id, PDO::PARAM_INT);
//        }
//        if ($query->execute()) {
//            echo "Pridano";
//        } else {
//            echo "Nepridano";
//        }
//    }
//}
//if ($id != NULL) {
//    $query = $conn->prepare("SELECT * FROM trafiky WHERE id=?");
//    $query->bindParam(1, $id, PDO::PARAM_INT);
//    $query->execute();
//    $trafika = $query->fetch();
//    if ($trafika) {
//        echo "Upravuješ trafiku - " . $trafika["nazev"] . "<br>";
//    } else {
//        die("Tahle trafika neexistuje");
//    }
//}
//
?>



<?php 

