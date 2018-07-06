<?php
  require_once('../../../module/config.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));
  // $dataParams = json_decode($_POST['data']);

  $id = isset($dataParams->idPin) ? $db->real_escape_string($dataParams->idPin): '';
 
  $idBuku = isset($dataParams->idBuku) ? $db->real_escape_string($dataParams->idBuku): '';
  $kode = isset($dataParams->kode) ? $db->real_escape_string($dataParams->kode): '';
  $idMember = isset($dataParams->idMember) ? $db->real_escape_string($dataParams->idMember): '';
  $idUser = isset($dataParams->idUser) ? $db->real_escape_string($dataParams->idUser): '';
  $jaminan = isset($dataParams->jaminan) ? $db->real_escape_string($dataParams->jaminan): '';
 
  $tglKembali = isset($dataParams->tglKembali)&&!empty($dataParams->tglKembali) ? date("Y-m-d",strtotime($db->real_escape_string($dataParams->tglKembali))): '';
  $tglPinjam = isset($dataParams->tglPinjam)&&!empty($dataParams->tglPinjam) ? date("Y-m-d",strtotime($db->real_escape_string($dataParams->tglPinjam))): '';

  
  $act = '';
  $error = '';
   
 
  if(empty($tglKembali)){
    $error .= 'Tanggal kembali harus diisi<br>';
  }
  if(empty($tglKembali)){
    $error .= 'Tanggal kembali harus diisi<br>';
  }
  if(empty($idMember)){
    $error .= 'Member harus diisi<br>';
  }
  if(empty($idBuku)){
    $error .= 'Buku harus diisi<br>';
  }
  if(empty($jaminan)){
    $error .= 'Jaminan harus diisi<br>';
  }
   
  if($error != '') {
    die(json_encode(array('success'=>false, 'message'=>$error)));
  }
  
  if(empty($id))
  {
    $query = $db->query("INSERT INTO peminjaman VALUES ('','$kode','$tglPinjam','$tglKembali','$jaminan','$idUser','$idMember','$idBuku')");
    $act = 'Menambah';
  }
  else
  {
    $act = 'Mengedit';
    $query = $db->query("UPDATE peminjaman set 
                                          kode = '$kode',
                                          tglPinjam = '$tglPinjam',
                                          tglKembali = '$tglKembali',
                                          jaminan = '$jaminan',
                                          idMember = '$idMember',
                                          idBuku = '$idBuku'
                                          where idPin = $id
                                          ");
      
  }
  
    

  $success = array('success' => true, 'message'=>$act.' peminjaman sukses' );
  $failed = array('success' => false, 'message'=>$act.' peminjaman gagal' );

  print_r(json_encode($query ? $success : $failed));


?>