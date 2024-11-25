<html>
<head>
<body>
<?php
$conn = sqlsrv_connect(serverName: "",connectionInfo: "");

if ($conn){
    echo"Połączono";
}
else{
    echo "Nie połączono";
}

?>
</body>
</head>
</html>


