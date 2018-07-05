<?php
    require_once('../../module/config.php');
  header('Content-Type: application/json');
  $data = json_decode(file_get_contents('php://input'));
  
  $username = (isset($data->username)) ? $db->real_escape_string($data->username) : '';
  $password = (isset($data->password)) ? $db->real_escape_string($data->password) : '';
  $password = md5($password);
  $sql = "SELECT idUser,nama,role from petugas where un = ? and pw = ?";
  
  $stmt = $db->prepare($sql) or die($db->error);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($idUser,$nama,$role);
    $stmt->fetch();

  $result_data = array();
  if($result = !empty($idUser)){
    $success = array(
    'success'=>true, 
    'message'=>'login sukses',
    'data'=>array(
        'idUser'=>$idUser,
        'nama'=>$nama,
        'role'=>$role
      )
    );
  }

  $false = array('success'=>false,'message'=>'Username atau password salah');

  die(json_encode(($result) ? $success  : $false));
?>  
