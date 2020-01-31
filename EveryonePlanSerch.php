<?php
    //define('DB_DATABASE','test_sb');
    define('DB_USERNAME','root');
    define('BD_PASSWORD','');
    define('PDO_DSN','mysql:host=localhost; dbname=flat_db;charset=utf8' ); 

try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $s_id = $_POST["spot_id"];
    //$s_id = 8;

    $stmt = $db->prepare("select distinct show_plan_id from make_plan where spot_id = $s_id");
    $stmt->execute();


    while($value=$stmt->fetch(PDO::FETCH_ASSOC)) {

        $ss_id = $value["show_plan_id"];

        $stmtsh = $db->prepare("select  show_plan_id,show_plan_name, comment from show_plan where show_plan_id = $ss_id and show_plan_flag = 1");
        $stmtsh->execute();
        $valuesh=$stmtsh->fetch(PDO::FETCH_ASSOC);

        if(empty($valuesh["show_plan_id"])){
            continue;
       }
       echo "$valuesh[show_plan_id],$valuesh[show_plan_name],";
       
        $stmt2 = $db->prepare("select evaluation, comment from evaluation where show_plan_id = $ss_id ");
        $stmt2->execute();
  
        $sum = 0;
        $count = 0;
        while($value2=$stmt2->fetch(PDO::FETCH_ASSOC)){
            $checkeva =  $value2["evaluation"];
            if(is_null($checkeva)){
                continue;
           }
           $sum += $checkeva; 
            //echo $a;

            $count += 1;
        }
        $ave = 0;
        $a = 0;
        if($count != 0){
            //$ave = (intdiv((double)$sum, $count));
            $ave = $sum / $count;
            $ave = floatval($ave);
            
        }
        echo "$ave,";

        if(empty($valuesh["comment"])){
            echo ",";
            continue;
       }
        echo "$valuesh[comment],";
    }
        //echo "<br>";
        


    //var_dump($stmt);

 


} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}

?>