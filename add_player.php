<?php
require_once ("connect_db.php");
?>
<html>
    <head>
        <title>Add player</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
        <style>
            .slc{
                margin-right: 5px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Add Player</h1>
            <?php
            if (isset($_POST["submit"])) {
                if (isset($_POST["name"]) && strlen($_POST["name"]) > 3) {
                    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
                    if (isset($_POST["team"]) && is_numeric($_POST["team"])) {
                        $team = filter_var($_POST["team"], FILTER_SANITIZE_NUMBER_INT);
                        if (isset($_POST["class"]) && is_numeric($_POST["class"])) {
                            $class = filter_var($_POST["class"], FILTER_SANITIZE_NUMBER_INT);
                            $query = $conn->prepare("INSERT INTO players VALUES (NULL, ?, ?, ?)");
                            $query->bindParam(1, $name, PDO::PARAM_STR);
                            $query->bindParam(2, $class, PDO::PARAM_INT);
                            $query->bindParam(3, $team, PDO::PARAM_INT);
                            if ($query->execute()) {
                                echo "Player added";
                                header('Location: http://localhost:8080/pokus/index.php');
                            } else {
                                echo "Player was not added";
                            }
                        } else {
                            echo '<div class="alert alert-danger" role="alert">';
                            echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
                            echo '<span class="sr-only">Error:</span>';
                            echo 'Team error';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">';
                        echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
                        echo '<span class="sr-only">Error:</span>';
                        echo 'Class error';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
                    echo '<span class="sr-only">Error:</span>';
                    echo 'Name must be longer than 3 letters';
                    echo '</div>';
                }
            }
            $query = $conn->prepare("SELECT * FROM teams");
            $query->execute();
            ?>
            <form method="POST">
                <div style="padding-top:5px">
                    <label for="team" class="label label-default slc" style="min-width:50px;">
                    Team
                </label>
                <select name="team" id="team" class="selectpicker slc">
                    <?php foreach ($query->fetchAll() as $row) { ?>
                        <option value='<?php echo $row["id"]; ?>'>
                            <?php echo $row["name"]; ?>
                        </option>
                    <?php } ?>
                </select>
                </div>
                <div style="padding-top:5px">
                <label for="class" class="label label-default slc" >
                    Class
                </label>
                <select name="class" id="class" class="selectpicker slc">
                    <?php
                    $query = $conn->prepare("SELECT * FROM classes");
                    $query->execute();
                    foreach ($query->fetchAll() as $row) {
                        ?>
                        <option value='<?php echo $row["id"]; ?>'>
                            <?php echo $row["name"]; ?>
                        </option>
                    <?php } ?>
                </select>
                </div>
                <div>
                
                    <div class="input-group col-lg-5" style="padding-top:5px">
                    <input type="text" name="name" required="required" class="form-control" placeholder="Players name..." id="name">
                    <span class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-defalut">Submit</button>
                        
                    </span>
                    
                </div>
                </div>
            </form>
        </div>
        
        <script src="jquery-3.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="bootstrap-select.js" type="text/javascript"></script>
    </body>
</html>