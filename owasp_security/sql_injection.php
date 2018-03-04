<?php

// try this: http://test.dev/owasp_security/sql_injection.php?id=5' OR 1='1

$conn = new mysqli('localhost', 'devel', 'withc--', 'epayment_clone_001');

$id = isset($_GET['id']) ? $_GET['id'] : 1;
$query = "SELECT * FROM accounts WHERE IdAccount = '{$id}'";

if ($result = $conn->query($query)) {

    while ($row = $result->fetch_assoc()) {
        var_dump($row['IdAccount']);
    }

    $result->free();
}

$conn->close();
