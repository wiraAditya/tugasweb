<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/maha/module/config.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/maha/module/function.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));

  $sql="SELECT * FROM jenis_invt_ ORDER BY _jenisID DESC";

  $executeSql = $db->query($sql);
  if($executeSql->num_rows){
    while ($row =  $executeSql->fetch_assoc()) {
      $asset[] = $row; 
    }
    die(json_encode(array('success'=>true, 'jenis'=>$asset)));      
  }else {
    die(json_encode(array('success'=>false, 'jenis'=>null )));
  }

?>