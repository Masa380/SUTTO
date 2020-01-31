<?php

define('DB_USERNAME','root');
define('BD_PASSWORD','');
define('PDO_DSN','mysql:host=localhost; dbname=flat_db;charset=utf8' ); 


try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //$prefecture_id = 39;
    
    $prefecture_id = $_POST['prefecture_id'];

    $stmt = $db->prepare("SELECT spot_id FROM spot WHERE prefecture_id = ?");
    $stmt->execute([$prefecture_id]);

    $s_id = [];
    while($value=$stmt->fetch(PDO::FETCH_ASSOC)){
        
        array_push($s_id, (int)$value['spot_id']);
    }
    if(is_null($value['spot_id'])){
        echo "uncomplete";
        break;
   }
    //$s_id = $value["spot_id"];
    //$s_id = $_POST['spot_id'];

    //$stmtsp = $db->prepare("select show_plan_id from make_plan where spot_id = $s_id");

    $inClause = substr(str_repeat(',?', count($s_id)), 1);
    $query = sprintf("SELECT distinct show_plan_id FROM make_plan where spot_id in (%s)", $inClause);
    $stmtsp = $db->prepare($query);
    $stmtsp->execute($s_id);
    while($valuesp=$stmtsp->fetch(PDO::FETCH_ASSOC)){
        $ss_id = $valuesp["show_plan_id"];

        //echo "$valuesp[show_plan_id],";

        $stmtsh = $db->prepare("select show_plan_id, show_plan_name,comment from show_plan where show_plan_id = $ss_id and show_plan_flag = 1");
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
   // }

    //var_dump($stmt);

} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}

?>