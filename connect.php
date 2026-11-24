<?php
require_once __DIR__.'/bootstrap.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn=mysqli_init();
$host=getenv('DB_HOST');$user=getenv('DB_USER');$pass=getenv('DB_PASSWORD');$db=getenv('DB_NAME')?:'polymart_db';
if(!$host||!$user||$pass===false)fail('Database configuration missing.',503);
$flags=0;if($cloud){$ca=getenv('DB_SSL_CA')?:'/etc/ssl/certs/ca-certificates.crt';if(!is_readable($ca))fail('Database TLS configuration missing.',503);$conn->ssl_set(null,null,$ca,null,null);$conn->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT,true);$flags=MYSQLI_CLIENT_SSL;}
$conn->real_connect($host,$user,$pass,$db,3306,null,$flags);$conn->set_charset('utf8mb4');
if($cloud && !$conn->query("SHOW STATUS LIKE 'Ssl_cipher'")->fetch_row()[1])fail('Database TLS required.',503);
