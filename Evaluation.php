<?php
    //define('DB_DATABASE','test_sb');
    define('DB_USERNAME','root');
    define('BD_PASSWORD','');
    define('PDO_DSN','mysql:host=localhost; dbname=flat_db;charset=utf8' ); 

try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $spid = $_POST['show_plan_id'];
    $userid = $_POST['user_id'];
    $eva = $_POST['evaluation'];
    $com = $_POST['comment'];
    /*
    $spid =58;
    $userid = 4;
    $eva = 5;
    $com = '奨学金継続願をぎりぎりまで書いてない人がいるらしい';
    */
    $stmt = $db->prepare("insert into evaluation (show_plan_id, user_id, evaluation, comment) values ( :sp_id, :u_id, :ev , :com)");
    $stmt->execute([ ':sp_id'=>$spid, ':u_id'=>$userid, ':ev'=>$eva, ':com'=>$com]);
    echo "complete";

} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>