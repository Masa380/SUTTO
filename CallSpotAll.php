<?php
    //define('DB_DATABASE','test_sb');
    define('DB_USERNAME','root');
    define('BD_PASSWORD','');
    define('PDO_DSN','mysql:host=localhost; dbname=flat_db;charset=utf8' ); 

try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //$sp_id = 2;
    $sp_id = $_POST['spot_id'];

    $stmt = $db->prepare("select spot_telephoe, spot_address, spot_businesshours, spot_url from spot where spot_id = ? ");
    $stmt->execute([$sp_id]);

    $value=$stmt->fetch(PDO::FETCH_ASSOC);
    echo "$value[spot_telephoe],";
    echo "$value[spot_address],";
    echo "$value[spot_businesshours],";
    echo "$value[spot_url],";

    $stmtph = $db->prepare("SELECT spot_photo2_url FROM spot_photo2 WHERE spot_id = ? ");
    $stmtph->execute([$sp_id]);

    $valueph=$stmtph->fetch(PDO::FETCH_ASSOC);
    echo "$valueph[spot_photo2_url],";

} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>