<?php
ini_set("display_errors", 1);
header('Content-Type: text/html; charset=utf-8');

echo 'Versión Actual de PHP: ' . phpversion() . '<br>';

// Configuración para Docker
$servername = "db"; // Nombre del servicio en docker-compose
$username = "root";
$password = "Senha123"; // Debe coincidir con docker-compose.yml
$database = "meubanco";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Insertar datos de ejemplo
$random_id = rand(1, 999);
$random_text = substr(md5(rand()), 0, 7);
$host = gethostname();

$sql = "INSERT INTO dados (AlunoID, Nome, Sobrenome, Endereco, Cidade, Host) 
        VALUES ('$random_id', '$random_text', '$random_text', '$random_text', '$random_text', '$host')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo registro creado con éxito<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Mostrar todos los registros
$result = $conn->query("SELECT * FROM dados LIMIT 10");
if ($result->num_rows > 0) {
    echo "<h3>Últimos registros:</h3>";
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["AlunoID"]. " - Nombre: " . $row["Nome"]. "<br>";
    }
} else {
    echo "0 resultados";
}

$conn->close();
?>
