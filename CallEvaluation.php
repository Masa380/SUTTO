<?php
    //define('DB_DATABASE','test_sb');
    define('DB_USERNAME','root');
    define('BD_PASSWORD','');
    define('PDO_DSN','mysql:host=localhost; dbname=flat_db;charset=utf8' ); 

try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //$showid = 58;
    $showid = $_POST['show_plan_id'];
    
    $stmt = $db->prepare("select evaluation, comment from evaluation where show_plan_id = $showid ");
    $stmt->execute();
  
    //$count = 0;
    while($value=$stmt->fetch(PDO::FETCH_ASSOC)){
        echo "$value[evaluation],";
        echo "$value[comment],";

        //$count += 1;
    }
    //echo $count;
    
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>