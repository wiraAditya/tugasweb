<?php
  require_once('../../../module/config.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));
  // $dataParams = json_decode($_POST['data']);

  $id = isset($dataParams->idUser) ? $db->real_escape_string($dataParams->idUser): '';
  $un = isset($dataParams->un) ? $db->real_escape_string($dataParams->un): '';
  $pw = isset($dataParams->pw) ? $db->real_escape_string($dataParams->pw): '';
  $nama = isset($dataParams->nama) ? $db->real_escape_string($dataParams->nama): '';
  $alamat = isset($dataParams->alamat) ? $db->real_escape_string($dataParams->alamat): '';
  $telp = isset($dataParams->telp) ? $db->real_escape_string($dataParams->telp): '';
  $role = isset($dataParams->role) ? $db->real_escape_string($dataParams->role): '';
  
  $act = '';
  $error = '';
    
  if(empty($un)){
    $error .= 'Username harus diisi<br>';
  }
  if(empty($id)){
    if (empty($pw)) {
      $error .= 'Password harus diisi<br>';
    }
  }
  if(empty($nama)){
    $error .= 'Nama harus diisi<br>';
  }
  if(empty($alamat)){
    $error .= 'Alamat harus diisi<br>';
  }
  if(empty($telp)){
    $error .= 'Telp harus diisi<br>';
  }

   
  if($error != '') {
    die(json_encode(array('success'=>false, 'message'=>$error)));
  }
  
  if(empty($id))
  {
    $check = $db->query("SELECT idUser from petugas where un='$un'");
    if ($check->num_rows) {
      die(json_encode(array('success'=>false, 'message'=>"username telah tersedia")));
    }
    $pw = md5($pw);
    $query = $db->query("INSERT INTO petugas VALUES ('','$un','$pw','$nama','$alamat','$telp','$role',1)");
    $act = 'Menambah';
  }
  else
  {
    $act = 'Mengedit';
    $check = $db->query("SELECT idUser from petugas where un='$un' and idUser != $id");
    if ($check->num_rows) {
      die(json_encode(array('success'=>false, 'message'=>"username telah tersedia")));
    }
    $set = (!empty($pw))?", pw='".md5($pw)."'" : "";
    $query = $db->query("UPDATE petugas set 
                                          un='$un',
                                          nama = '$nama',
                                          alamat = '$alamat',
                                          telp = '$telp',
                                          role = '$role' 
                                          $set
                                          where idUser = $id
                                          ");
  }
  
    

  $success = array('success' => true, 'message'=>$act.' user sukses' );
  $failed = array('success' => false, 'message'=>$act.' user gagal' );

  print_r(json_encode($query ? $success : $failed));


?>