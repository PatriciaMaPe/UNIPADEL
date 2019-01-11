<?php

// file: model/GrupoMapper.php
require_once(__DIR__ . "/../core/PDOConnection.php");

require_once(__DIR__ . "/../model/Campeonato.php");
require_once(__DIR__ . "/../model/Categoria.php");
require_once(__DIR__ . "/../model/Grupo.php");

/**
 * Class GrupoMapper
 *
 * Database interface for Grupo entities
 *
 * @author Patricia
 */
class GrupoMapper {

    /**
     * Reference to the PDO connection
     * @var PDO
     */
    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    /**
     *
     */
    public function findAll() {
        $stmt = $this->db->query("SELECT Grupo.*, Categoria.nivel, Categoria.tipo
			FROM `Grupo`, `Categoria` WHERE Categoria.idCategoria = Grupo.Campeonato_CategoriaCategoriaidCategoria
			ORDER BY Grupo.Campeonato_CategoriaCampeonatoidCampeonato, Grupo.idGrupo, CASE Grupo.tipoLiga
			WHEN'regular' THEN 0
			WHEN 'cuartos' THEN 1
			WHEN 'semifinal' THEN 2
			WHEN 'final' THEN 3
			ELSE 4
			END ASC");
        $gruposCampeonato_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Order by case when firstname like 'jack' then 0 else 1 end
        $grupos = array();

        foreach ($gruposCampeonato_db as $grupo) {
            $campeonato = new Campeonato($grupo["Campeonato_CategoriaCampeonatoidCampeonato"]);
            $categoria = new Categoria($grupo["Campeonato_CategoriaCategoriaidCategoria"], $grupo["nivel"], $grupo["tipo"]);
            array_push($grupos, new Grupo($grupo["idGrupo"], $campeonato, $categoria, $grupo["tipoLiga"]));
        }

        return $grupos;
    }
    
    
    //Funcion Nacho
    
    public function findByCampeonatoCategoria($idCampeonato, $idCategoria) {
        $stmt = $this->db->prepare("SELECT idGrupo FROM Grupo WHERE tipoLiga = 'regular' AND Campeonato_CategoriaCampeonatoidCampeonato = $idCampeonato AND Campeonato_CategoriaCategoriaidCategoria = $idCategoria ");
        $stmt->execute();
        $grupos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $grupos;
    }

}
