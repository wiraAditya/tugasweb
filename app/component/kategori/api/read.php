<?php
  require_once('../../../module/config.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));

  $sql="SELECT * FROM kategoribuku  ORDER BY idKategori DESC";

  $executeSql = $db->query($sql);
  if($executeSql->num_rows){
    while ($row =  $executeSql->fetch_assoc()) {
      $member[] = $row; 
    }
    die(json_encode(array('success'=>true, 'kategori'=>$member)));      
  }else {
    die(json_encode(array('success'=>false, 'kategori'=>null )));
  }

?>