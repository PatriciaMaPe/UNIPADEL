<?php
class Enfrentamiento {

    private $idEnfrentamiento;
    private $idPareja;
    private $resultado;
    private $set1;
    private $set2;
    private $set3;
    private $idGrupo;

    /*public function __construct($idEnfrentamiento="" , $idPareja="", $resultado="" , $set1="" , $set2="esp", $set3="empleado", $idGrupo="empleado") {
        $this->idEnfrentamiento = $idEnfrentamiento;
        $this->idPareja = $idPareja;
        $this->resultado = $resultado;
        $this->set1 = $set1;
        $this->set2 = $set2;
        $this->set3 = $set3;
        $this->idGrupo = $idGrupo;
    }*/

public function listarEmpleados(){
        $db = new Database();

        $result = $db->consulta("SELECT * FROM Usuario WHERE Tipo='empleado'");
        $arrayEmpleados = array();
        while ($row_usuario = mysqli_fetch_assoc($result))
            $arrayEmpleados[] = $row_usuario;

        $db->desconectar();
        return $arrayEmpleados;
    }

}


?>
