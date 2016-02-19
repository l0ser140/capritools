<?php
include("config.php");	

function formatstr($str) 
    {
        $str = trim($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str);
        return $str;
    }
    
$start = filter_input(INPUT_GET, 'start', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$end = filter_input(INPUT_GET, 'end', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);

if ($mysqli->connect_errno) {
    printf("Connection error: %s\n", $mysqli->connect_error);
    exit();
}

$start = $mysqli->real_escape_string($start);
if ($result = $mysqli->query("SELECT * FROM `mapSolarSystems` WHERE solarSystemName='$start'")) {
    $row_cnt = $result->num_rows;
    if($row_cnt != 1)
    {
        echo 0;
        $mysqli->close();
        exit();
    }
    else
    {
        $start_row = $result->fetch_array(MYSQLI_ASSOC);
        $result->close();
    }
} else {
    echo 0;
    $mysqli->close();
    exit();
}

$end = $mysqli->real_escape_string($end);
if ($result = $mysqli->query("SELECT * FROM `mapSolarSystems` WHERE solarSystemName='$end'")) {
    $row_cnt = $result->num_rows;
    if($row_cnt != 1)
    {
        echo 0;
        $mysqli->close();
        exit();
    }
    else
    {
        $end_row = $result->fetch_array(MYSQLI_ASSOC);
        $result->close();
    }
} else {
    echo 0;
    $mysqli->close();
    exit();
}

$mysqli->close();

$distance = sqrt(pow($start_row['x']-$end_row['x'], 2) + pow($start_row['y']-$end_row['y'], 2) + pow($start_row['z']-$end_row['z'], 2)) / 9460730472580800;

echo $distance;
?>