<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/maha/module/config.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/maha/module/function.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));
 
  $id = isset($dataParams->id) ? $db->real_escape_string($dataParams->id): '';
  $jenis = isset($dataParams->jenis) ? $db->real_escape_string($dataParams->jenis): '';
  $userId = isset($dataParams->userId) ? $db->real_escape_string($dataParams->userId): '';


  

  $check = $db->query("SELECT _jenisID from invent_ where _jenisID = '$id'");
  if($check->num_rows)
  {
    die(json_encode(array('success'=>false, 'message'=>'Jenis digunakan pada inventaris')));
  } 
  else
  {
    $sql = "DELETE FROM jenis_invt_ WHERE _jenisID = ?";
    $stmt = $db->prepare($sql) or die($db->error);
    $stmt->bind_param('s', $id);
    $executeAction = $stmt->execute() or die($db->error);

    if($executeAction) {
      print_r(json_encode(array('success'=>true, 'message'=>'hapus jenis sukses')));
      $historyMessage = 'manghapus jenis '.$jenis;
      //createHistory($db, $historyMessage, $userId);
    }else{
      print_r(json_encode(array('success'=>false, 'message'=>'hapus jenis gagal')));
    }
  }   
?>