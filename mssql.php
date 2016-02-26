<?php 
phpinfo();
$serverName = "192.168.1.100,1433"; //serverName\instanceName, portNumber (default is 1433)
$connectionInfo = array( "Database"=>"BookaCottageDb", "UID"=>"sa", "PWD"=>"BigNone123");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
echo "<pre>";
if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>