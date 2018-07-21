<?php

header("Content-Type:application/json");
header("HTTP/1.1 200");

function Select() {
    require_once 'MySQL.php';

    try {
        $con = new PDO($host, $user, $pass);
    } catch (PDOException $e) {
        echo "¡Error!: " . $e->getMessage() . "
";
        die();
    }
    if (isset($_GET["s"]) && isset($_GET["t"])) {
        if (in_array(strtoupper($_GET["s"]), ["SELECT", "UPDATE", "DELETE", "INSERT"])) {


            $select = $_GET["s"];

            $where = $_GET["t"] = "*";


            $query = $con->query("$select $where FROM TABLA_GRANDE");
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($resultado, JSON_PRETTY_PRINT);
            echo ($json);
        }else{
            echo"\nFaltan datos";
        }
    } else {
        echo "\nFaltan datos";
        exit;
    }
}

Select();
