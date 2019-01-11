<?php
// file: model/CategoriaMapper.php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Categoria.php");
/**
 * Class CampeonatoMapper
 *
 */
class CategoriaMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  /*
  public function save(Categoria $categoria) {
    $stmt = $this->db->prepare("INSERT INTO Categoria(nivel, tipo) values (?,?)");
    $stmt->execute(array($categoria->getNivel(), $categoria->getTipo()));
    //return $this->db->lastInsertId();
  }
   */
  
  public function save(Categoria $categoria) {
    $stmt = $this->db->prepare("INSERT INTO Categoria(nivel, tipo, maxParticipantes) values (?,?,?)");
    $stmt->execute(array($categoria->getNivel(), $categoria->getTipo(), $categoria->getMaxParticipantes()));
    return $this->db->lastInsertId();
  }

    public function findById($idCategorias) {
        
        $categoria = NULL;
        
        foreach ($idCategorias as $idCategoria) {

            $stmt = $this->db->prepare("SELECT * FROM Categoria WHERE idCategoria = $idCategoria[CategoriaidCategoria]");
            $stmt->execute();
            $categoria[$idCategoria["CategoriaidCategoria"]] = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $categoria;
    }
    
    public function findCategoria($idCategoria,$nivel,$tipo){
    
        $stmt = $this->db->prepare("SELECT * FROM Categoria WHERE idCategoria = $idCategoria AND nivel = $nivel AND tipo = '$tipo' ");
            
        $stmt->execute();
        $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

        return $categoria;
    }

    public function findByTipoNivel($idCampeonato, $nivel, $tipo) {

        $stmt = $this->db->prepare("SELECT CategoriaidCategoria FROM Campeonato_Categoria WHERE  CampeonatoidCampeonato = $idCampeonato");
        $stmt->execute();
        $idCategorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categoria = NULL;
        
        foreach ($idCategorias as $idCategoria) {

            $stmt = $this->db->prepare("SELECT * FROM Categoria WHERE idCategoria = $idCategoria[CategoriaidCategoria] AND nivel = $nivel AND tipo = '$tipo' ");
            $stmt->execute();
            $categoria_aux = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($categoria_aux != false) {
                $categoria = $categoria_aux;
            }
        }        

        return $categoria;
    }
}
