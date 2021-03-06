<?php
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
mb_http_input('UTF-8');
mb_regex_encoding('UTF-8'); 


function savePaste($data) {
	//Connect MySQL
	include("config.php");
	$db = new PDO('mysql:host='.$mysql_host.';dbname='.$mysql_db.';charset=utf8', $mysql_user, $mysql_pass);
	
	//Create scan entry
	$st = $db->prepare("INSERT INTO pastes(`created`, `ip`) VALUES (UNIX_TIMESTAMP(), :ip)");
	$st->bindValue(":ip", $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
	$st->execute();
	
	//Get id and create key
	$id = $db->lastInsertId();
	$key = sha1("bestpony" . $id);
	$st = $db->prepare("UPDATE pastes SET `key`=:key WHERE id=:id LIMIT 1");
	$st->bindValue(":key", $key, PDO::PARAM_STR);
	$st->bindValue(":id", $id, PDO::PARAM_INT);
	$st->execute();
	
	//Save data segments
        $data = str_replace("\r\n", "\n", $data);
        $seq = 0;
	for($pos = 0; $pos < mb_strlen($data); $pos += 1024) {
		$st = $db->prepare("INSERT INTO pasteData(`id`, `sequence`, `data`) VALUES (:id, :sequence, :data)");
		$st->bindValue(":id", $id, PDO::PARAM_INT);
		$st->bindValue(":sequence", $seq, PDO::PARAM_INT);
		$st->bindValue(":data", mb_substr($data, $pos, 1024), PDO::PARAM_STR);
		$st->execute();
                $seq++;
	}
	
	return $key;
}


function getPasteInfo($key) {
	//Connect MySQL
	include("config.php");
	$db = new PDO('mysql:host='.$mysql_host.';dbname='.$mysql_db.';charset=utf8', $mysql_user, $mysql_pass);
	
	//Get ID and check existence
	$st = $db->prepare("SELECT * FROM pastes WHERE `key`=:key");
	$st->bindValue(":key", $key);
	$st->execute();
	$rows = $st->fetchAll(PDO::FETCH_ASSOC);
	
	return $rows[0];
}


function getPaste($key) {
	//Connect MySQL
	include("config.php");
	$db = new PDO('mysql:host='.$mysql_host.';dbname='.$mysql_db.';charset=utf8', $mysql_user, $mysql_pass);
	
	//Get ID and check existence
	$st = $db->prepare("SELECT * FROM pastes WHERE `key`=:key");
	$st->bindValue(":key", $key);
	$st->execute();
	$rows = $st->fetchAll(PDO::FETCH_ASSOC);
	
	if(count($rows) < 1) {
		return false;
	}
	
	$id = $rows[0]['id'];
	
	$st = $db->prepare("SELECT data FROM pasteData WHERE id=:id ORDER BY sequence ASC");
	$st->bindValue(":id", $id);
	$st->execute();
	$rows = $st->fetchAll(PDO::FETCH_ASSOC);
	
	$paste = "";
	foreach($rows as $row) {
		$paste .= $row['data'];
	}
	
	return $paste;
}

?>