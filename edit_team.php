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
            $dotaz = $query->fetch();
            echo $dotaz["name"];
        ?></h1>

            <form method="POST">
            <div class="input-group col-lg-5" style="padding-top:5px">
                <input type="text" name="name" required="required" class="form-control" placeholder="Team name..." id="name">
                <span class="input-group-btn">
                    <button type="submit" name="submit" class="btn btn-defalut">Submit</button>
                </span>
            </div>
            </form>
        </div>
    </body>

<?php
if (isset($_POST["name"])) {
    if (strlen($_POST["name"]) < 3) {
        echo '<div class="alert alert-danger" role="alert">';
        echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
        echo '<span class="sr-only">Error:</span>';
        echo 'Name must be longer than 3 letters';
        echo '</div>';
    } else {
        $name2 = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $query = $conn->prepare("UPDATE teams SET ". " name = ? WHERE id = ?");
        $query->bindParam(1, $name2, PDO::PARAM_STR);
        $query->bindParam(2, $id, PDO::PARAM_INT);
        
        if ($query->execute()) {
            echo "Team edited";
            header('Location: http://localhost:8080/pokus/index.php');
        } 
    }
}


?>
</html>
