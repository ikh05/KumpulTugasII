<?php 

// Status Internet
if(!isset($_SESSION['internet'])){
	$_SESSION['internet'] = (bool)@fsockopen("www.google.com", '80');
}

// CDN
include_once ($_SESSION['internet'] ? "../app/config/cdn.php" : "../../vendor/config.php");


// DB
if($_SERVER['SERVER_NAME'] === 'localhost'){
	// DB localHost
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'kumpultugasii');
	define('BASE_URL', ($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/KumpulTugasII/public/'));
}else{
	// DB Hosting
	define('DB_HOST', 'sql113.infinityfree.com');
	define('DB_USER', 'if0_36479043');
	define('DB_PASS', 'Ikhsan05');
	define('DB_NAME', 'if0_36479043_amat');
	define('BASE_URL', ($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/public/'));
}


// Constant
define('C_MESSAGE', 'KTII_message');
define('C_SISWA', 'KTII_data-siswa');
define('C_GURU', "KTII_data-guru");
