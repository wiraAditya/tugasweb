<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/maha/module/config.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/maha/module/function.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));
  // $dataParams = json_decode($_POST['data']);

  $id = isset($dataParams->id) ? $db->real_escape_string($dataParams->id): '';
  $jenis = isset($dataParams->jenis) ? $db->real_escape_string($dataParams->jenis): '';
  $no = isset($dataParams->no) ? $db->real_escape_string($dataParams->no): '';
  $status = isset($dataParams->status) ? $db->real_escape_string($dataParams->status): '0';
  $userId = isset($dataParams->userId) ? $db->real_escape_string($dataParams->userId): '';
  
  $act = '';
  $error = '';
    
  if(empty($jenis)){
    $error .= 'Jenis harus diisi<br>';
  }
  if(empty($no)){
    $error .= 'No harus diisi<br>';
  }

   
  if($error != '') {
    die(json_encode(array('success'=>false, 'message'=>$error)));
  }
  
  if(empty($id))
  {
    
    $sql = "INSERT INTO jenis_invt_ (_jenis, _no,_status) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql) or die($db->error);
    $stmt->bind_param('sss', $jenis,$no,$status);
    $executeAction = $stmt->execute() or die($db->error);

    $act = 'Menambah';
  }
  else
  {
    $sql = "UPDATE jenis_invt_ SET _jenis=?, _no=?, _status=? WHERE _jenisID=?";
    $stmt = $db->prepare($sql) or die($db->error);
    $stmt->bind_param('ssss', $jenis,$no,$status,$id);
    $executeAction = $stmt->execute() or die($db->error);
    
    $act = 'Mengubah';
  }
  
  $historyMessage = $act.' jenis '.$jenis;
    
  //createHistory($db, $historyMessage, $userId);

  $success = array('success' => true, 'message'=>$act.' jenis sukses' );
  $failed = array('success' => false, 'message'=>$act.' jenis gagal' );

  print_r(json_encode($executeAction ? $success : $failed));


?>