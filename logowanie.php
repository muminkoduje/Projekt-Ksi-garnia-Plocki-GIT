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

    // Pobierz dane z formularza
    $login = isset($_POST['Login']) ? trim($_POST['Login']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Sprawdź, czy pola są wypełnione
    if (!empty($login) && !empty($password)) {
        $sql = "SELECT User_ID, Username, PasswordHash FROM users WHERE Username=?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $login);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['PasswordHash'])) {
                    session_start();
                    $_SESSION['user_id'] = $user['User_ID'];
                    $_SESSION['username'] = $user['Username'];
                    header("Location: główne.html");
                    exit();
                } else {
                    echo "<p>Błędne dane logowania!</p>";
                }
            } else {
                echo "<p>Nie znaleziono użytkownika.</p>";
            }
        } else {
            echo "<p>Wystąpił błąd w zapytaniu: " . $conn->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Uzupełnij wszystkie pola!</p>";
    }

    $conn->close();
}
?>