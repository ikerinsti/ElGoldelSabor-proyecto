<?php
include_once 'Database/Database.php';
include_once 'Descuento.php';

class DescuentoDAO
{
    public static function getDescuentoById($id_descuento)
    {
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT * FROM descuento WHERE id_descuento = ?");
        $stmt->bind_param("i", $id_descuento);
        $stmt->execute();
        $results = $stmt->get_result();

        $descuento = $results->fetch_object('Descuento');
        $stmt->close();
        $conn->close();
        return $descuento;
    }
    public static function getDescuentoByAmbito($ambito)
    {
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT * FROM descuento WHERE ambito = ? ORDER BY nombre ASC");
        $stmt->bind_param("s", $ambito);
        $stmt->execute();
        $results = $stmt->get_result();
        $descuentos = [];
        while ($row = $results->fetch_object('Descuento')) {
            $descuentos[] = $row;
        }

        $stmt->close();
        $conn->close();
        return $descuentos;
    }
    public static function getDescuentos()
    {
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT * FROM descuento");
        $stmt->execute();
        $results = $stmt->get_result();

        $descuentos = [];
        while ($row = $results->fetch_object('Descuento')) {
            $descuentos[] = $row;
        }

        $stmt->close();
        $conn->close();
        return $descuentos;
    }
}
