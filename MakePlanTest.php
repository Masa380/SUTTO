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
    $startday = $_POST['show_plan_start'];
    $endday = $_POST['show_plan_end'];

    $spotid = $_POST['spot_id'];
    $mp_date = $_POST['my_plan_date'];

    $fare = $_POST["fare_cash1"];

    $starttime = $_POST["time_start"];
    $endtime = $_POST["time_end"];
    */

    //show_plan用データ
    $userid = 1;
    $name = "test_plan4";
    $memo = "自動で全部入るやつ";
    $startday = '2020-01-17';
    $endday = '2020-01-18';
    //make_plan用データ
    $spotid = array(1, 2, 3);
    $mp_date = array(1, 2, 3);
    //fare用データ
    $fare = array(100, 200, 3000);
    //time用データ
    $starttime = array(1010, 1522,1900);
    $endtime = array(1522,1900, 2000);
    $traffic_id = array(1,2,3);

    $stmt = $db->prepare("insert into show_plan ( user_id, show_plan_name, show_plan_memo, show_plan_start, show_plan_end, show_plan_flag) values ( :u_id, :name, :memo, :start, :end, :flag)");
    $stmt->execute([ ':u_id'=>$userid,  ':name'=>$name, ':memo'=>$memo, ':start'=>$startday, ':end'=>$endday, ':flag'=>0]);
    
    //echo "inserted: show_plan";
    //echo "<br>";

    $stmtsp = $db->prepare("select show_plan_id from show_plan where user_id = $userid order by  show_plan_id desc limit 1 ");
    $stmtsp->execute();
    $valuesp=$stmtsp->fetch(PDO::FETCH_ASSOC);
    $show_id = $valuesp["show_plan_id"];
    //echo "select show_plan_id: $valuesp[show_plan_id]" ;
    //echo "<br>";


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
    echo "insertet yourplan!";
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>