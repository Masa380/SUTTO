<?php
    //データベース名がテストに変わっていることに注意
    define('DB_USERNAME','root');
    define('BD_PASSWORD','');
    define('PDO_DSN','mysql:host=localhost; dbname=flat_db;charset=utf8' ); 

try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $spot_id = array(21,22,23,24,25,26,27);
    $spot_cate = array(2,2,1,1,1,2,2);
    $spot_name = array('ひばり食堂','安芸しらす食堂','高知パシフィックホテル','ザ クラウンパレス新阪急高知','三翠園','道の駅 なぶら土佐佐賀','道の駅 あぐり窪川');
    $spot_latitude = array(33.764472,33.502194,33.565222,33.558056,33.556139,33.086833,33.23125);
    $spot_longitude = array(133.663917,133.88075,133.543833,133.53375,133.53375,133.101667,133.149306);
    $spot_telephone = array('0887-72-0769','0887-34-8810','088-884-0777','088-873-1111','088-822-0131','0880-55-3325','0880-22-8848');
    $spot_address = array('〒789-0312 高知県長岡郡大豊町高須２２６','〒784-0020 高知県安芸市西浜３４１１−４６','〒780-0053 高知県高知市駅前町１−１５','〒780-8561 高知県高知市本町４丁目２−５０','〒780-0862 高知県高知市鷹匠町１丁目３−３５','〒789-1721 高知県幡多郡幡多郡黒潮町佐賀１３５０','〒786-0026 高知県高岡郡四万十町平串２８４−１');
    $spot_businesshour = array('11:30~17:30','11~00~15:30','','','','8:00~18:00','8:00~18:00');
    $spot_url  = array("https://www.otoyo-kankou.com/gurume/hibari/","http://akisuisan.com/","kochi-pacific.co.jp","https://www.crownpalais.jp/kochi/","https://www.sansuien.co.jp/","http://nabura-tosasaga.com/","http://aguri-kubokawa.co.jp/");
    /*
    echo count($spot_cate);
    echo "<br>";
    echo count($spot_name);echo "<br>";
    echo count($spot_latitude );echo "<br>";
    echo count($spot_longitude);echo "<br>";
    echo count($spot_telephone);echo "<br>";
    echo count($spot_address);echo "<br>";
    echo count($spot_businesshour);echo "<br>";
    echo count($spot_url);echo "<br>";
     */
    for($i=0; $i < count($spot_id); $i++){
        $stmt = $db->prepare("insert into spot ( spot_id, spot_category_id, spot_name, prefecture_id, spot_latitude, spot_longitude, spot_telephoe, spot_address, spot_businesshours, spot_url,spot_favorite_flag,spot_photo_id) values (:sp_id, :sp_cate, :sp_name, :pre_id, :sp_lati, :sp_lon, :sp_tele, :sp_add, :sp_busi, :sp_url, :sp_fav, :photo_id)");
        $stmt->execute([ ':sp_id'=>$spot_id[$i], ':sp_cate'=>$spot_cate[$i], ':sp_name'=> $spot_name[$i], ':pre_id'=>39, ':sp_lati'=>$spot_latitude[$i] , ':sp_lon'=>$spot_longitude[$i], ':sp_add'=> $spot_address[$i],':sp_tele'=>$spot_telephone[$i], ':sp_busi'=>$spot_businesshour[$i], ':sp_url'=>$spot_url[$i], ':sp_fav'=>0,':photo_id'=>1]);
    echo "insert:$spot_name[$i]";
    echo "<br>";
    }
    
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>