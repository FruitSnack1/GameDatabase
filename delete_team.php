    <?php
require_once ("connect_db.php");
?>
<?php
if(isset($_GET["id"])){
    $id = (int) $_GET["id"];
}else{
    $id = NULL;
}
if($id == NULL){
    echo "This team does not exist";
}else{
    $query = $conn->prepare("DELETE FROM teams WHERE id=?");
    $query->bindParam(1, $id, PDO::PARAM_INT);
    $result = $query->execute();    
    $pr = $query->rowCount();
    if($pr == 0){
        echo "Not found";
    }else{
        header("Location: index.php?site=trafiky");
    }
}

