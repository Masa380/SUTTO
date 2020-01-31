<?php
    define('DB_USERNAME','root');
    define('BD_PASSWORD','');
    define('PDO_DSN','mysql:host=localhost; dbname=flat_db;charset=utf8' ); 

try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //$sp_name = '%??%';
    $sp_name = $_POST['spot_name'];
    //var_dump($sp_id);
    $stmt = $db->prepare("SELECT spot_id, spot_name FROM spot WHERE spot_name LIKE ?");
    $stmt->execute([$sp_name]);
   
    while($value=$stmt->fetch(PDO::FETCH_ASSOC)){
        echo "$value[spot_id],";
        echo "$value[spot_name],";
    }

} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>
