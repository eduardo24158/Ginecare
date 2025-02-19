<?php
require("../conexion.php");
require('../controller/session_a.php');
//include('controller/session_l.php');

if (isset($_GET['receiver_id'])) {
    $sender_id = $sid;
    $receiver_id = $_GET['receiver_id'];

    $stmt = $pdo->prepare('SELECT * FROM messages WHERE (sender_id = :sender_id 
    AND receiver_id = :receiver_id) OR (sender_id = :receiver_id 
    AND receiver_id = :sender_id  ) ORDER BY fecha ASC ');

    $stmt->bindParam(':sender_id', $sender_id);
    $stmt->bindParam(':receiver_id', $receiver_id);
    $stmt->execute();
    $mensajes = $stmt->fetchAll();


    $stmtl = $pdo->prepare('UPDATE messages SET leido = 1 WHERE (sender_id = :receiver_id 
    AND receiver_id = :sender_id  ) AND leido = 0');

    $stmtl->bindParam(':sender_id', $sender_id);
    $stmtl->bindParam(':receiver_id', $receiver_id);
    $stmtl->execute();

    $stmtle = $pdo->prepare('SELECT leido FROM  messages WHERE (sender_id = :sender_id 
    AND receiver_id = :receiver_id  )');

    $stmtle->bindParam(':sender_id', $sender_id);
    $stmtle->bindParam(':receiver_id', $receiver_id);
    $stmtle->execute();
    $read = $stmtle->fetchColumn();

    $stmtn = $pdo->prepare('SELECT e.nombre FROM messages m JOIN empleados e ON (m.receiver_id=e.id) 
WHERE receiver_id = :receiver_id');

    $stmtn->bindParam(':receiver_id', $receiver_id);
    $stmtn->execute();
    $name = $stmtn->fetchColumn();

    $stmta = $pdo->prepare('SELECT e.apellido FROM messages m JOIN empleados e ON (m.receiver_id=e.id) 
WHERE receiver_id = :receiver_id');

    $stmta->bindParam(':receiver_id', $receiver_id);
    $stmta->execute();
    $surname = $stmta->fetchColumn();

    $cname =  $name . " "  . $surname;

    foreach ($mensajes as $mensaje) {
        $class = $mensaje['sender_id'] == $sender_id ? 'sender' : 'receiver';
        $nombre = $mensaje['sender_id'] == $sender_id ? 'Tú' : 'Paciente ' . $cname;
        echo "<div class='$class'><strong>" . htmlspecialchars($nombre) . ": </strong> " .
            htmlspecialchars($mensaje['mensajitos']) . "</div> <br> <div class='$class'>Enviado: " . htmlspecialchars($mensaje['fecha']) . "</div> <br> ";
          

    }
}
