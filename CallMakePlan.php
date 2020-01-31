<?php
    //前と内容変更していますby中村
    //了解いたしましたby宮尾
    define('DB_USERNAME','root');
    define('BD_PASSWORD','');
    define('PDO_DSN','mysql:host=localhost; dbname=flat_db;charset=utf8' ); 

try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //$show_id = 54;
    $show_id = $_POST['show_plan_id'];

    $stmtshow = $db->prepare("select show_plan_memo, show_plan_start, show_plan_end,show_plan_flag from show_plan where show_plan_id = ? ");
    $stmtshow->execute([$show_id]);
    $valueshow=$stmtshow->fetch(PDO::FETCH_ASSOC);
    echo "$valueshow[show_plan_memo],$valueshow[show_plan_start],$valueshow[show_plan_end],$valueshow[show_plan_flag],";
    //echo "<br>";

    $stmt = $db->prepare("select spot_id ,make_plan_id, make_plan_date from make_plan where show_plan_id = $show_id order by make_plan_date asc");
    $stmt->execute();
  
    while($value=$stmt->fetch(PDO::FETCH_ASSOC)){
        //echo "mpi=$value[make_plan_id],";
        //echo "spi=$value[spot_id],";
        $spot = $value["spot_id"];
        $makeid = $value["make_plan_id"];
        
        $stmtsp = $db->prepare("select spot_name from spot where spot_id = $spot ");
        $stmtsp->execute();
        $valuesp=$stmtsp->fetch(PDO::FETCH_ASSOC);
        
        $stmtfare = $db->prepare("select fare_cash1 from fare where make_plan_id = $makeid ");
        $stmtfare->execute();
        $valuefare=$stmtfare->fetch(PDO::FETCH_ASSOC);

        $stmttime = $db->prepare("select time_start, time_end from time where make_plan_id = $makeid ");
        $stmttime->execute();
        $valuetime=$stmttime->fetch(PDO::FETCH_ASSOC);

        echo "$value[make_plan_date],$spot,$valuesp[spot_name],$valuefare[fare_cash1],$valuetime[time_start],$valuetime[time_end],";
        //echo "<br>";
        
    }


} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>