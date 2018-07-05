<?php
  require_once('../../../module/config.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));

  $sql="SELECT * FROM petugas where status =1 ORDER BY idUser DESC";

  $executeSql = $db->query($sql);
  if($executeSql->num_rows){
    while ($row =  $executeSql->fetch_assoc()) {
      $user[] = $row; 
    }
    die(json_encode(array('success'=>true, 'user'=>$user)));      
  }else {
    die(json_encode(array('success'=>false, 'user'=>null )));
  }

?>