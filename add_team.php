<?php
require_once ("connect_db.php");
?>
<html>
    <head>
        <title>Add player</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    </head>
    <body>
        <div class="container">
            <h1>Add Team</h1>
            <form method="POST">

                <div>
                
                    <div class="input-group col-lg-5" style="padding-top:5px">
                    <input type="text" name="name" required="required" class="form-control" placeholder="Team name..." id="name">
                    <span class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-defalut">Submit</button>
                        
                    </span>
                    
                </div>
                </div>
            </form>
        </div>
        <?php
            if (isset($_POST["submit"])) {
                if (isset($_POST["name"]) && strlen($_POST["name"]) > 3) {
                    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
                    
                        
                            $query = $conn->prepare("INSERT INTO teams VALUES (NULL, ?)");
                            $query->bindParam(1, $name, PDO::PARAM_STR);
                            if ($query->execute()) {
                                echo "Team added";
                                header('Location: http://localhost:8080/pokus/index.php');
                            } else {
                                echo "Team was not added";
                            }
                }else{
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
    </body>
</html>