<?php
    //define('DB_DATABASE','test_sb');
    define('DB_USERNAME','root');
    define('BD_PASSWORD','');
    define('PDO_DSN','mysql:host=localhost; dbname=flat_db;charset=utf8' ); 

try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    $userid = $_POST['user_id'];
    $name = $_POST['show_plan_name'];
    $memo = $_POST['show_plan_memo'];
    $startday = $_POST['show_plan_start'];
    $endday = $_POST['show_plan_end'];
    /*
     //show_plan用データ
     $userid = 1;
     $name = "test_plan2";
     $memo = "自動で全部入るやつ";
     $startday = '2020-01-18';
     $endday = '2020-01-19';
    */
    $stmt = $db->prepare("insert into show_plan ( user_id, show_plan_name, show_plan_memo, show_plan_start, show_plan_end, show_plan_flag) values ( :u_id, :name, :memo, :start, :end, :flag)");
    $stmt->execute([ ':u_id'=>$userid, ':name'=>$name, ':memo'=>$memo, ':start'=>$startday, ':end'=>$endday, ':flag'=>0]);//:s_id, :u_id, :f_id, :name, :start, :end, :flag
    echo "complete";

} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>