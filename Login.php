<?php
    //define('DB_DATABASE','test_sb');
    define('DB_USERNAME','root');
    define('BD_PASSWORD','');
    define('PDO_DSN','mysql:host=localhost; dbname=flat_db;charset=utf8' ); 

    

try{
    $db =new PDO(PDO_DSN, DB_USERNAME, BD_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $user_id = 1;
    $user_pass = "Flat1";

    /*
    $user_id = $_POST['$user_id'];
    $user_pass = $_POST['$user_id'];
    */

    $stmt = $db->prepare("SELECT user_id,user_name, user_gender, user_age, user_login_flag FROM user WHERE user_id = ? AND user_pass = ?");
    $stmt->execute([$user_id,$user_pass]);


    $value=$stmt->fetch(PDO::FETCH_ASSOC);

        echo "$value[user_id],";
        echo "$value[user_name],";
        echo "$value[user_gender],";
        echo "$value[user_age],";



    $u_id = $value['user_id'];
    $stmt_flag = $db->prepare("UPDATE user SET user_login_flag  = 1 WHERE user_id = $u_id");
    $stmt_flag->execute();

    echo 1;

} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>

    