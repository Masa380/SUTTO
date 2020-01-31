<?php
    //define('DB_DATABASE','test_sb');
    define('DB_USERNAME','root');
    define('BD_PASSWORD','');
    define('PDO_DSN','mysql:host=localhost; dbname=flat_db;charset=utf8' ); 

    $spotid1 = $_POST['spot_id1'];
    $spotid2 = $_POST['spot_id2'];
    //$spotid1 = 1;
    //$spotid2 = 2;

try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $db->prepare("select spot_name, spot_latitude, spot_longitude from spot where spot_id = ?");
    $stmt->execute([$spotid1]);

   // $spot = $stmt->fetchAll(PDO::FETCH_ASSOC);//キーと値のペアの配列で帰ってくるオプション
   while($value=$stmt->fetch(PDO::FETCH_ASSOC)){
       echo "$value[spot_name],";
       
       echo "$value[spot_latitude],";
       
       echo "$value[spot_longitude],";
   }

   $stmt = $db->prepare("select spot_name, spot_latitude, spot_longitude from spot where spot_id = ?");
   $stmt->execute([$spotid2]);

  // $spot = $stmt->fetchAll(PDO::FETCH_ASSOC);//キーと値のペアの配列で帰ってくるオプション
  while($value=$stmt->fetch(PDO::FETCH_ASSOC)){
      echo "$value[spot_name],";
      
      echo "$value[spot_latitude],";
      
      echo "$value[spot_longitude],";
  }


} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>