    <?php
require_once ("connect_db.php");

if(isset($_GET["id"]) && is_numeric($_GET["id"])){
    $id = (int) $_GET["id"];
}else{
    $id = NULL;
}
?>
<html>
    <head>
        <title>Classes</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
    </head>
    <body>
        <div class="container">
        <h1>Class <?php
            $query = $conn->prepare("SELECT name FROM classes WHERE id=$id");
            $query->execute();
            $name = $query->fetch();
            echo $name["name"];
        ?></h1>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Team</th>
            </tr>
        <?php
        foreach($conn->query("SELECT * FROM players WHERE id_class=$id") as $row) {
            echo "<tr>";
            echo "<td>".$row["id"]."</td>"; 
            echo "<td>".$row["name"]."</td>";
            $query = $conn->prepare("SELECT name FROM teams WHERE id=?");
            $query->bindParam(1, $row["id_team"], PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetch();
            echo "<td>".$result["name"]."</td>";
            echo "<tr>";
        }
        ?>
        </table>
        </div>
    </body>
</html>