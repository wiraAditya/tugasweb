<?php
  require_once('../../../module/config.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));
 
  $id = isset($dataParams->id) ? $db->real_escape_string($dataParams->id): '';
   if (empty($id)) {
    die(json_encode(array('success'=>false, 'message'=>'hapus member gagal')));
   }
  $sql = $db->query("DELETE from member  WHERE idMember = $id");
  
  if($sql) {
    print_r(json_encode(array('success'=>true, 'message'=>'hapus member sukses')));
  }else{
    print_r(json_encode(array('success'=>false, 'message'=>'hapus member gagal')));
  }
?>