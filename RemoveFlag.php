<?php
    //define('DB_DATABASE','test_sb');
    define('DB_USERNAME','root');
    define('BD_PASSWORD','');
    define('PDO_DSN','mysql:host=localhost; dbname=flat_db;charset=utf8' ); 

try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
/*
    $show_id = 32;
*/

    $show_id = $_POST['show_plan_id'];
    
    $smtp = $db->prepare("update show_plan set show_plan_flag = 0 where show_plan_id = $show_id");
    $smtp->execute();
    echo "complete";

} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>