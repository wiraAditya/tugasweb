<?php
	//tanggal bahasa indonesia
	function tgl_indo($tanggal){
		$bulan = array (
			'Undefined',
			'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);
		
		// variabel pecahkan 0 = tanggal
		// variabel pecahkan 1 = bulan
		// variabel pecahkan 2 = tahun
	 
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}

	//htmlspecialchar pada array
	function htmlspecial_array(&$variable) {
		foreach ($variable as &$value) {
    		if (!is_array($value)) { 
    			$value = htmlspecialchars($value); 
    		}else{ 
    			htmlspecial_array($value); 
    		}
		}
	}

	//delete directory and file
	function delete_directory($dirname) {
        if (is_dir($dirname))
           	$dir_handle = opendir($dirname);
		if (!$dir_handle) 
			return false;
		while($file = readdir($dir_handle)) {
		       	if ($file != "." && $file != "..") {
		            if (!is_dir($dirname."/".$file))
		                unlink($dirname."/".$file);
		            else
		                delete_directory($dirname.'/'.$file);
		       }
		}
		closedir($dir_handle);
		rmdir($dirname);
		return true;
	}

	//Check Document Office File
	function check_doc_mime( $tmpname ) {
		// MIME types: http://filext.com/faq/office_mime_types.php
		$finfo = finfo_open( FILEINFO_MIME_TYPE );
		$mtype = finfo_file( $finfo, $tmpname );
		finfo_close( $finfo );
		if( $mtype == ( "application/vnd.openxmlformats-officedocument.wordprocessingml.document" ) || 
			$mtype == ( "application/vnd.ms-excel" ) ||
			$mtype == ( "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ) || 
			$mtype == ( "application/vnd.ms-powerpoint" ) ||
			$mtype == ( "application/vnd.openxmlformats-officedocument.presentationml.presentation" ) || 
			$mtype == ( "application/pdf" ) ) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	function createHistory($db, $historyPesan, $userID) {
		$tgl = date('Y-m-d H:i:s');
		$sqlHistory = "INSERT INTO history_ (_activity, _userID, _tgl) VALUES (?,?,?)";
		$stmtHistory = $db->prepare($sqlHistory) or die($db->error);
		$stmtHistory->bind_param('sss', $historyPesan, $userID, $tgl);
		$executeSqlHistory = $stmtHistory->execute();
	}

	function notif($data){
		$ch = curl_init( "https://fcm.googleapis.com/fcm/send" );
			
			$payload = json_encode( $data );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:key=AAAAgrasEks:APA91bHh3tEqrqrJcR7Izz4RqwRRGMHvoEjqdp2JzufVySOjaYO99P9_HfKq4sjvoSHjVYUcVDjMGZl5kqNpoV2nwWo8ObuH7md_frKl0KFYjiDqMEguewtu8pPm5QeX29mwMWrFofMe'));
			# Return response instead of printing.
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result = curl_exec($ch);
			if(curl_error($ch))
			{
			    print_r(array("error"=>true,"msg"=>curl_error($ch)));
			    die(); 
			}
			curl_close($ch);
	}

	function pushNotif($db,$dataNotif,$group,$bidangid=0)
	{	
		if (!empty($group)&&empty($bidangid)) {
			$user = $db->query("SELECT token from user_ where _groupID=$group");
			if ($user->num_rows) {
				while ($row = $user->fetch_object()) {
					$data = array("notification"=>$dataNotif,
						"to" => "$row->token"
					);
					notif($data);
					
				}
			}
		}elseif (!empty($group)&&$group==4&&!empty($bidangid)) {
			$user = $db->query("SELECT token from user_ where _bidangID=$bidangid");
			if ($user->num_rows) {
				while ($row = $user->fetch_object()) {
					$data = array("notification"=>$dataNotif,
						"to" => "$row->token"
					);
					notif($data);
				}
			}
		}elseif(empty($group)&&empty($bidangid)){
			
			$data = array("notification"=>$dataNotif,
				"to" => "/topics/eOfficeAll"
			);
			notif($data);
		}
	}

?>
