<?php
    //データベース名がテストに変わっていることに注意
    define('DB_USERNAME','root');
    define('BD_PASSWORD','');
    define('PDO_DSN','mysql:host=localhost; dbname=flat_db;charset=utf8' ); 

try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userid = $_POST['user_id'];
    $spotid = $_POST['spot_id'];
    $mp_date = $_POST['my_plan_date'];

    $fare = $_POST["fare_cash1"];

    $starttime = $_POST["time_start"];
    $endtime = $_POST["time_end"];
    /*

    $userid = 1;
    //make_plan用データ
    $spotid = 2;
    $mp_date = 1;
    //fare用データ
    $fare = 100;
    //time用データ
    $starttime = 1010;
    $endtime = 1522;
    $traffic_id = 1;
*/
    $stmtsp = $db->prepare("select show_plan_id from show_plan where user_id = $userid order by  show_plan_id desc limit 1 ");
    $stmtsp->execute();
    $valuesp=$stmtsp->fetch(PDO::FETCH_ASSOC);
    $show_id = $valuesp["show_plan_id"];
    //echo "select show_plan_id: $valuesp[show_plan_id]" ;
    //echo "<br>";

        $stmt = $db->prepare("insert into make_plan ( spot_id, show_plan_id, make_plan_date) values ( :s_id, :sp_id, :mp_date)");
        $stmt->execute([ ':s_id'=>$spotid, ':sp_id'=>$show_id, ':mp_date'=>$mp_date]);
        //echo "inserted: make_plan,";
        //echo "<br>";
    
        $stmtsp = $db->prepare("select make_plan_id from make_plan where show_plan_id = $show_id order by make_plan_id desc limit 1 ");
        $stmtsp->execute();
        $valuemk=$stmtsp->fetch(PDO::FETCH_ASSOC);
        $make_id = $valuemk["make_plan_id"];
        //echo "select make_plan_id: $valuemk[make_plan_id]," ;
        //echo "<br>";

        $stmt = $db->prepare("insert into fare ( fare_cash1, user_id, make_plan_id) values ( :fare, :user, :ma_id)");
        $stmt->execute([ ':fare'=>$fare, ':user'=>$userid, ':ma_id'=>$make_id]);
        //echo "inserted: fare,";
        //echo "<br>";

        $stmt = $db->prepare("insert into time (make_plan_id, spot_id, time_start, time_end,  user_id) values ( :ma_id, :sp_id, :sttime, :entime, :user)");
        $stmt->execute([':ma_id'=>$make_id, ':sp_id'=>$spotid, ':sttime'=>$starttime, ':entime'=>$endtime, ':user'=>$userid ]);
        //echo "inserted: time";
        //echo "<br>";
    echo "complete";
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>