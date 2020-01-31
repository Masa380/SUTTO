<?php
    //define('DB_DATABASE','test_sb');
    define('DB_USERNAME','root');
    define('BD_PASSWORD','');
    define('PDO_DSN','mysql:host=localhost; dbname=flat_db;charset=utf8' ); 


try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

    $flag = 1;
    
    $stmt = $db->prepare("select show_plan_id,show_plan_name from show_plan where show_plan_flag = ? order by  show_plan_id desc limit 5");
    $stmt->execute([$flag]);
  
   // $show_plan = $stmt->fetchAll(PDO::FETCH_ASSOC);//キーと値のペアの配列で帰ってくるオプション
    //foreach ($show_plan as $show_plan){
    //    var_dump($show_plan);
    //}

    while($value=$stmt->fetch(PDO::FETCH_ASSOC)){
        echo "$value[show_plan_id],";
        echo "$value[show_plan_name],";
        //echo "<br>";
        $showid = $value['show_plan_id'];
    
        $stmt2 = $db->prepare("select evaluation, comment from evaluation where show_plan_id = $showid ");
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
            echo "$ave,";
        }
        
        //echo $count;
        //echo "<br>";
    }

} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>