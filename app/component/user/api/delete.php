<?php
  require_once('../../../module/config.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));
 
  $id = isset($dataParams->id) ? $db->real_escape_string($dataParams->id): '';
   if (empty($id)) {
    die(json_encode(array('success'=>false, 'message'=>'hapus user gagal')));
   }
  $sql = $db->query("UPDATE petugas set status=0 WHERE idUser = $id");
  
  if($sql) {
    print_r(json_encode(array('success'=>true, 'message'=>'hapus user sukses')));
  }else{
    print_r(json_encode(array('success'=>false, 'message'=>'hapus user gagal')));
  }
?>