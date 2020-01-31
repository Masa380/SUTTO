<?php
    
    //データベース名がテストに変わっていることに注意
    define('DB_USERNAME','root');
    define('BD_PASSWORD','');
    define('PDO_DSN','mysql:host=localhost; dbname=flat_db_test;charset=utf8' ); 

try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /*
    $userid = $_POST['user_id'];
    $name = $_POST['show_plan_name'];
    $memo = $_POST['show_plan_memo'];
    $start = $_POST['show_plan_start'];
    $end = $_POST['show_plan_end'];
    $flag = $_POST['show_plan_flag']; 

    $spotid = $_POST['spot_id'];
    $mp_date = $_POST['my_plan_date'];

    $fare = $_POST["fare_cash1"];

    $starttime = $_POST["time_start"];
    $endtime = $_POST["time_end"];
    */

    /*
    //show_plan用データ
    $show_id = 25;
    $userid = 1;
    $name = "test_plan5";
    $memo = "更新したよ";
    $startday = '2020-01-17';
    $endday = '2020-01-18';
    $flag = 0;
    //make_plan用データ
    $spotid = array(1, 2, 3);
    $mp_date = array(1, 2, 3);
    //fare用データ
    $fare = array(900, 200, 3000);
    //time用データ
    $starttime = array(1010, 1522,1900);
    $endtime = array(1522,1900, 2000);
    $traffic_id = array(1,2,3);

    $stmt = $db->prepare("update show_plan set user_id = :u_id, show_plan_name = :name, show_plan_memo = :memo, show_plan_start = :start, show_plan_end = :end, show_plan_flag = :flag where show_plan_id = :sp_id");
    $stmt->execute([ ':u_id'=>$userid,  ':name'=>$name, ':memo'=>$memo, ':start'=>$startday, ':end'=>$endday, ':flag'=>$flag, ':sp_id'=>$show_id]);
    
    //echo "updated: show_plan";
    //echo "<br>";
    
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
    
    for($i=0; $i < count($spotid); $i++){
        //echo $spotid[$i];
        $stmt = $db->prepare("insert into make_plan ( spot_id, show_plan_id, make_plan_date) values ( :s_id, :sp_id, :mp_date)");
        $stmt->execute([ ':s_id'=>$spotid[$i], ':sp_id'=>$show_id, ':mp_date'=>$mp_date[$i] ]);
        //echo "inserted: make_plan,";
        //echo "<br>";
    
        $stmtsp = $db->prepare("select make_plan_id from make_plan where show_plan_id = $show_id order by make_plan_id desc limit 1 ");
        $stmtsp->execute();
        $valuemk=$stmtsp->fetch(PDO::FETCH_ASSOC);
        $make_id = $valuemk["make_plan_id"];
        //echo "select make_plan_id: $valuemk[make_plan_id]," ;
        //echo "<br>";

        $stmt = $db->prepare("insert into fare ( fare_cash1, user_id, make_plan_id) values ( :fare, :user, :ma_id)");
        $stmt->execute([ ':fare'=>$fare[$i], ':user'=>$userid, ':ma_id'=>$make_id]);
        //echo "inserted: fare,";
        //echo "<br>";

        $stmt = $db->prepare("insert into time (make_plan_id, spot_id, time_start, time_end, traffic_category_id, user_id) values ( :ma_id, :sp_id, :sttime, :entime, :ta_cate, :user)");
        $stmt->execute([':ma_id'=>$make_id, ':sp_id'=>$spotid[$i], ':sttime'=>$starttime[$i], ':entime'=>$endtime[$i], ':ta_cate'=>$traffic_id[$i], ':user'=>$userid ]);
        //echo "inserted: time";
        //echo "<br>";
    } 
    echo "update!";*/
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>