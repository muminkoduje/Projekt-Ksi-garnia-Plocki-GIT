<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "ksiegarnia"; 

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Błąd połączenia: " . $conn->connect_error);
    }

    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $username = $_POST['Username'];
    $email = $_POST['email'];
    $password = $_POST['Password'];

    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password)) {
        echo "Hasło musi zawierać co najmniej 8 znaków oraz 1 dużą literę.";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Podaj poprawny adres email.";
        exit();
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (Username, Mail, FirstName, LastName, PasswordHash, AccountCreationDate) 
            VALUES (?, ?, ?, ?, ?, NOW())";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssss", $username, $email, $firstName, $lastName, $passwordHash);

        if ($stmt->execute()) {
            echo "Konto zostało utworzone pomyślnie.";
        } else {
            echo "Wystąpił błąd podczas rejestracji: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Wystąpił błąd w zapytaniu: " . $conn->error;
    }

    $conn->close();
}
?>