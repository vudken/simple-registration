<?php
    const SECURE_CODE = 'k0MAH9@';

    $login = filter_var(trim($_POST['login'], FILTER_SANITIZE_STRING));
    $password = $_POST['password'];
    $password_confirmed = $_POST['password-confirm'];
    $secureCodeToCompare = filter_var(trim($_POST['secure-code'], FILTER_SANITIZE_STRING));

    $number = preg_match('@[0-9]@', $password);
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (mb_strlen($login) < 3 || mb_strlen($login) > 30) {
        echo "Login should be between 3 and 20 symbols";
        exit();
    }

    if (strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
        echo "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
    }

    if ($password !== $password_confirmed) {
        echo "Password confirmation doesn't match";
    }

    if ($secureCodeToCompare !== SECURE_CODE) {
        echo "Secure code is incorrect!";
    }

    $secretKey = "$6$";

    $hash = $secretKey . hash('sha512', $password);
    echo $hash;

    $conn = new mysqli('localhost', 'root', '', 'test');
    $conn->query("INSERT INTO users (login, password) VALUES ('$login', '$hash')");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "User " . $login . " registered successfully.";
    }
    $conn->close();
?>