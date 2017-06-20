    <?php
require_once ("connect_db.php");
?>
<html>
    <head>
        <title>Index</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
            .nwm{
                margin-top: -7px!important;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="col-lg-4">
                    <h1>Teams</h1>
                    <ul class="list-group">
                    <?php
                    foreach($conn->query("SELECT * FROM teams") as $row) {
                        echo '<li class="list-group-item"><a href="teams.php?id=' . $row["id"] . '">' .
                                $row["name"] . "</a><a class='btn btn-default pull-right nwm' href='edit_team.php?id=".$row["id"]."'>Edit</a><a class='btn btn-default pull-right nwm' style='margin-right:5px;' href='delete_team.php?id=".$row["id"]."'>Delete</a>"."</li>";
                    }
                    ?>
                    </ul>
            </div>
        
            <div class="col-lg-4">
                    <h1>Classes</h1>
                    <ul class="list-group">
                    <?php
                    foreach($conn->query("SELECT * FROM classes") as $row) {
                        echo '<li class="list-group-item"><a href="classes.php?id=' . $row["id"] . '">' .
                                $row["name"] . "</a><br>"."</li>";
                    }
                    ?>
                    </ul>
            </div>
            
            <div class="col-lg-4">
                    <h1>Players</h1>
                    <ul class="list-group">
                    <?php
                    foreach($conn->query("SELECT * FROM players") as $row) {
                        echo '<li class="list-group-item"><a href="players.php?id=' . $row["id"] . '">' .
                                $row["name"] . "</a><a class='btn btn-default pull-right nwm' href='delete_player.php?id=".$row["id"]."'>Delete</a>"."</li>";
                    }
                    ?>
                        <li class="list-group-item">
                            <a class="btn btn-primary" href="add_player.php">Add player</a>
                        </li>
                </ul>
            </div>
            
        </div>
    </body>
</html>