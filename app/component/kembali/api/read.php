<?php
  require_once('../../../module/config.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));

  $sql="SELECT * FROM pengembalian a
        inner join peminjaman b on a.idPin = b.idPin
        inner join member c on b.idMember = c.idMember
        inner join petugas d on a.idUser = d.idUser ORDER BY idKembali DESC";

  $executeSql = $db->query($sql);
  if($executeSql->num_rows){
    while ($row =  $executeSql->fetch_assoc()) {
      $kembali[] = $row; 
    }
    die(json_encode(array('success'=>true, 'kembali'=>$kembali)));      
  }else {
    die(json_encode(array('success'=>false, 'kembali'=>null )));
  }

?>