<?php
  require_once('../../../module/config.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));

  $sql="SELECT * FROM buku a inner join kategoribuku b on a.idKategori=b.idKategori  where a.status =1 ORDER BY idBuku  DESC";

  $executeSql = $db->query($sql);
  if($executeSql->num_rows){
    while ($row =  $executeSql->fetch_assoc()) {
      $buku[] = $row; 
    }
    die(json_encode(array('success'=>true, 'buku'=>$buku)));      
  }else {
    die(json_encode(array('success'=>false, 'buku'=>null )));
  }

?>