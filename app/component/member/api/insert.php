<?php
  require_once('../../../module/config.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));
  // $dataParams = json_decode($_POST['data']);

  $id = isset($dataParams->idMember) ? $db->real_escape_string($dataParams->idMember): '';
  $nama = isset($dataParams->nama) ? $db->real_escape_string($dataParams->nama): '';
  $alamat = isset($dataParams->alamat) ? $db->real_escape_string($dataParams->alamat): '';
  $noKtp = isset($dataParams->noKtp) ? $db->real_escape_string($dataParams->noKtp): '';
  $telp = isset($dataParams->telp) ? $db->real_escape_string($dataParams->telp): '';
  
  $act = '';
  $error = '';
   
 
  if(empty($nama)){
    $error .= 'Nama harus diisi<br>';
  }
  if(empty($noKtp)){
    $error .= 'No Ktp harus diisi<br>';
  }
  if(empty($telp)){
    $error .= 'Telp harus diisi<br>';
  }

   
  if($error != '') {
    die(json_encode(array('success'=>false, 'message'=>$error)));
  }
  
  if(empty($id))
  {
    $query = $db->query("INSERT INTO member VALUES ('','$nama','$alamat','$noKtp','$telp')");
    $act = 'Menambah';
  }
  else
  {
    $act = 'Mengedit';
    $query = $db->query("UPDATE member set 
                                          nama = '$nama',
                                          alamat = '$alamat',
                                          noTelp = '$telp',
                                          noKtp = '$noKtp' 
                                          where idMember = $id
                                          ");
  }
  
    

  $success = array('success' => true, 'message'=>$act.' member sukses' );
  $failed = array('success' => false, 'message'=>$act.' member gagal' );

  print_r(json_encode($query ? $success : $failed));


?>