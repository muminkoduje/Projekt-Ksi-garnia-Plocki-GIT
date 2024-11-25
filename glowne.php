<?php

$conn = mysqli_connect("","","","");
if ($conn){
    echo"Połączono";
}
else{
    echo "Nie połączono";
}
?>

<?php

$conn = sqlsrv_connect(serverName: "",connectionInfo: "");

if ($conn){
    echo"Połączono";
}
else{
    echo "Nie połączono";
}

?>