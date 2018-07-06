<?php
  require_once('../../../module/config.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));
  $id = isset($dataParams->idPin) ? $db->real_escape_string($dataParams->idPin): '';

  $sql="SELECT a.*,b.judul,c.kategori  FROM detpinjam a 
          inner join buku b on a.idBuku=b.idBuku
          inner join kategoribuku c on b.idKategori=c.idKategori
          where idPinjam=$id
          ORDER BY a.idDet DESC";

  $executeSql = $db->query($sql);
  if($executeSql->num_rows){
    while ($row =  $executeSql->fetch_assoc()) {
      $detail[] = $row; 
    }
    die(json_encode(array('success'=>true, 'detail'=>$detail)));      
  }else {
    die(json_encode(array('success'=>false, 'detail'=>null )));
  }

?>