<?php
  require_once('../../../module/config.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));
  // $dataParams = json_decode($_POST['data']);

  $id = isset($dataParams->idKategori) ? $db->real_escape_string($dataParams->idKategori): '';
  $kategori = isset($dataParams->kategori) ? $db->real_escape_string($dataParams->kategori): '';
  
  $act = '';
  $error = '';
   
 
  if(empty($kategori)){
    $error .= 'Kategori harus diisi<br>';
  }
  if($error != '') {
    die(json_encode(array('success'=>false, 'message'=>$error)));
  }
  
  if(empty($id))
  {
    $query = $db->query("INSERT INTO kategoribuku VALUES ('','$kategori')");
    $act = 'Menambah';
  }
  else
  {
    $act = 'Mengedit';
    $query = $db->query("UPDATE kategoribuku set 
                                          kategori = '$kategori'
                                          where idKategori = $id
                                          ");
  }
  
    

  $success = array('success' => true, 'message'=>$act.' kategori sukses' );
  $failed = array('success' => false, 'message'=>$act.' kategori gagal' );

  print_r(json_encode($query ? $success : $failed));


?>