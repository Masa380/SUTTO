<?php
    //define('DB_DATABASE','test_sb');
    define('DB_USERNAME','root');
    define('BD_PASSWORD','');
    define('PDO_DSN','mysql:host=localhost; dbname=flat_db;charset=utf8' ); 

try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //$user_id = 1;
    $user_id = $_POST['user_id'];
    
    $stmt = $db->prepare("select show_plan_id,show_plan_name from show_plan where user_id = ? ");
    $stmt->execute([$user_id]);
  
    while($value=$stmt->fetch(PDO::FETCH_ASSOC)){
        echo "$value[show_plan_id],";
        
        echo "$value[show_plan_name],";
    }

} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>