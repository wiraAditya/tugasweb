<?php
  require_once('../../../module/config.php');
  header('Content-Type: application/json');

  $dataParams = json_decode(file_get_contents('php://input'));
  $kembali = isset($dataParams->kembali) ? $db->real_escape_string($dataParams->kembali): '';
  $id = isset($dataParams->idPin) ? $db->real_escape_string($dataParams->idPin): '';
$join="";
  $where = "";

  $join = (!empty($kembali))?"  LEFT JOIN pengembalian c on a.idPin =c.idPin  ":"";
  $where.=(!empty($kembali))?" and c.idPin is null" : "";
  $where.=(!empty($id))?" or a.idPin =$id" : "";
  
  $sql="SELECT a.*,b.nama as member FROM peminjaman a 
          inner join member b on a.idMember=b.idMember $join where 1=1 $where
           group by idPin ORDER BY a.idPin  DESC";

  $executeSql = $db->query($sql);
  if($executeSql->num_rows){
    while ($row =  $executeSql->fetch_assoc()) {
      $pinjam[] = $row; 
    }
    foreach ($pinjam as $key => $value) {
      // print_r($value['tglPinjam']);
      $pinjam[$key]['tglPinjam'] = date("m/d/Y",strtotime($value['tglPinjam']));
      $pinjam[$key]['tglKembali'] = date("m/d/Y",strtotime($value['tglKembali']));
    }
    die(json_encode(array('success'=>true, 'pinjam'=>$pinjam)));      
  }else {
    // die(json_encode(array('success'=>false, 'pinjam'=>null )));
  }

?>