<?php
    //define('DB_DATABASE','test_sb');
    define('DB_USERNAME','root');
    define('BD_PASSWORD','');
    define('PDO_DSN','mysql:host=localhost; dbname=flat_db;charset=utf8' ); 

try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $comment = $_POST['comment'];
    $planFlag = 1;
    $splan_id = $_POST['show_plan_id'];
/*
    $comment = '投稿したよ';
    $planFlag = 1;
    $splan_id = 32;
*/

    
    $smtp = $db->prepare("update show_plan set comment = :comment,show_plan_flag = :sp_flag where show_plan_id = :sp_id");
    $smtp->execute([':comment' => $comment,':sp_flag' => $planFlag,'sp_id' => $splan_id]);
    echo "complete";

} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>