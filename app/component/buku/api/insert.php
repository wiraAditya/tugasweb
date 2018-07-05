<?php
  require_once('../../../module/config.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));
  // $dataParams = json_decode($_POST['data']);

  $id = isset($dataParams->idBuku) ? $db->real_escape_string($dataParams->idBuku): '';
  $judul = isset($dataParams->judul) ? $db->real_escape_string($dataParams->judul): '';
  $idKategori = isset($dataParams->idKategori) ? $db->real_escape_string($dataParams->idKategori): '';
  $penerbit = isset($dataParams->penerbit) ? $db->real_escape_string($dataParams->penerbit): '';
  
  $act = '';
  $error = '';
   
 
  if(empty($judul)){
    $error .= 'Judul harus diisi<br>';
  }
  if(empty($idKategori)){
    $error .= 'Kategori harus diisi<br>';
  }
  if(empty($penerbit)){
    $error .= 'Penerbit harus diisi<br>';
  }

  if($error != '') {
    die(json_encode(array('success'=>false, 'message'=>$error)));
  }
  
  if(empty($id))
  {
    $query = $db->query("INSERT INTO buku VALUES ('','$judul','$idKategori','$penerbit',1)");
    $act = 'Menambah';
  }
  else
  {
    $act = 'Mengedit';
    $query = $db->query("UPDATE member set 
                                          judul = '$judul',
                                          idKategori = '$idKategori',
                                          penerbit = '$penerbit',
                                          where idBuku = $id
                                          ");
  }
  
    

  $success = array('success' => true, 'message'=>$act.' buku sukses' );
  $failed = array('success' => false, 'message'=>$act.' buku gagal' );

  print_r(json_encode($query ? $success : $failed));


?>