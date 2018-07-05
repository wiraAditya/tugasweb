<?php
  require_once('../../../module/config.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));

  $sql="SELECT * FROM peminjaman a 
          inner join member b on a.idMember=b.idMember
          inner join user c on a.idUser = c.idUser ORDER BY idMember DESC";

  $executeSql = $db->query($sql);
  if($executeSql->num_rows){
    while ($row =  $executeSql->fetch_assoc()) {
      $pinjam[] = $row; 
    }
    die(json_encode(array('success'=>true, 'pinjam'=>$pinjam)));      
  }else {
    die(json_encode(array('success'=>false, 'pinjam'=>null )));
  }

?>