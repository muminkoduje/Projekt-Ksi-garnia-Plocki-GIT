<html>
<head>
<body>
<?php
// Dane logowania do bazy danych
$host = "localhost";          // Host, na którym działa MySQL
$username = "root";           // Domyślny użytkownik phpMyAdmin
$password = "";               // Domyślne hasło (puste, chyba że zmieniono)
$database = "ksiegarnia";     // Nazwa bazy danych

// Połączenie z MySQL
$conn = new mysqli($host, $username, $password, $database);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}
echo "Połączono z bazą danych!";
?>
</body>
</head>
</html>


