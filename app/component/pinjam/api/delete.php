<?php
  require_once('../../../module/config.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));
 
  $id = isset($dataParams->id) ? $db->real_escape_string($dataParams->id): '';
   if (empty($id)) {
    die(json_encode(array('success'=>false, 'message'=>'hapus peminjaman gagal')));
   }
  $sql2 = $db->query("DELETE from peminjaman  WHERE idPin = $id");
  
  if($sql2) {
    print_r(json_encode(array('success'=>true, 'message'=>'hapus peminjaman sukses')));
  }else{
    print_r(json_encode(array('success'=>false, 'message'=>'hapus peminjaman gagal')));
  }
?>