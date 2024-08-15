<?php
include "conn/connect.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Proteção contra injeção SQL
    $id = $conn->real_escape_string($id);

    // Executando a consulta para desativar a reserva
    $query = "UPDATE reserva SET reserva_aceita = 0, ativa = 0 WHERE id = " . $id;

    if ($conn->query($query) === TRUE) {
        // Redirecionando de volta para a lista de reservas
        echo "Reserva cancelada";
        header("location: minhas_reservas.php");
        exit;
    } else {
        echo "Erro ao desativar a reserva: " . $conn->error;
    }
} else {
    echo "ID de reserva não fornecido.";
}

?>