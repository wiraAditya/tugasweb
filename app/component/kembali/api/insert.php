<?php
  require_once('../../../module/config.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));
  // $dataParams = json_decode($_POST['data']);

  $id = isset($dataParams->idMember) ? $db->real_escape_string($dataParams->idMember): '';
  $tgKembali = isset($dataParams->tgKembali) ? $db->real_escape_string($dataParams->tgKembali): '';
  $denda = isset($dataParams->denda) ? $db->real_escape_string($dataParams->denda): '';
  $idPin = isset($dataParams->idPin) ? $db->real_escape_string($dataParams->idPin): '';
  $idUser = isset($dataParams->idUser) ? $db->real_escape_string($dataParams->idUser): '';
  
  $act = '';
  $error = '';
   
 
  if(empty($tgKembali)){
    $error .= 'Tanggal kembali harus diisi<br>';
  }
   
  if($error != '') {
    die(json_encode(array('success'=>false, 'message'=>$error)));
  }
  
  if(empty($id))
  {
    $query = $db->query("INSERT INTO pengembalian VALUES ('','$tgKembali','$denda','$idPin','$idUser')");
    $act = 'Menambah';
  }
  else
  {
    $act = 'Mengedit';
    $query = $db->query("UPDATE pengembalian set 
                                          tgKembali = '$tgKembali',
                                          denda = '$denda'
                                          where idKembali = $id
                                          ");
  }
  
    

  $success = array('success' => true, 'message'=>$act.' pengembalian sukses' );
  $failed = array('success' => false, 'message'=>$act.' pengembalian gagal' );

  print_r(json_encode($query ? $success : $failed));


?>