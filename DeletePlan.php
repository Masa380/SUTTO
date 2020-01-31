<?php
    //define('DB_DATABASE','test_sb');
    define('DB_USERNAME','root');
    define('BD_PASSWORD','');
    define('PDO_DSN','mysql:host=localhost; dbname=flat_db;charset=utf8' ); 

try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $show_id = $_POST['show_plan_id'];

    
     //show_plan用データ
     //$show_id = 88;

     $stmtmp = $db->prepare("select make_plan_id from make_plan where show_plan_id = $show_id ");
     $stmtmp->execute();
     while($valuemk=$stmtmp->fetch(PDO::FETCH_ASSOC)){
         
         $make_id_del = $valuemk["make_plan_id"];
         //echo $make_id_del;
         //echo "<br>";
         
         $stmtdelfare = $db->prepare("DELETE FROM fare WHERE make_plan_id = $make_id_del");
         $stmtdelfare->execute();
         //echo "deleted: fare";
         //echo "<br>";
         $stmtdeltime = $db->prepare("DELETE FROM time WHERE make_plan_id = $make_id_del");
         $stmtdeltime->execute();
         //echo "deleted: time";
         //echo "<br>";
         $stmtdelmake = $db->prepare("DELETE FROM make_plan WHERE make_plan_id = $make_id_del");
         $stmtdelmake->execute();
         //echo "deleted: make_plan";
         //echo "<br>";
         
     }
     $stmtdelshow = $db->prepare("DELETE FROM show_plan WHERE show_plan_id = $show_id");
     $stmtdelshow->execute();
     //echo "deleted: $show_id";
     //echo "<br>";

   
    echo "complete";

} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>