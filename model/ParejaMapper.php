<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");



/**
* Class PostMapper
*
* Database interface for Pareja entities
*
* @author Patricia
*/
class ParejaMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function getUsuariosPareja($idPareja){
		$stmt = $this->db->prepare("SELECT capitan, deportista from Pareja where idPareja=?");
		$stmt->execute(array($idPareja));
		$pareja_db = $stmt->fetch(PDO::FETCH_ASSOC);

		$pareja= array();
		array_push($pareja, $pareja_db['capitan']);
		array_push($pareja, $pareja_db['deportista']);

		return $pareja;
	}

	/**
	* Recuperamos los distintos ids que tiene una pareja dependiendo de la liga
	*/
	public function getIdPareja($usuario){
		$stmt = $this->db->prepare("SELECT idPareja from Pareja where capitan=? OR deportista=?");
		$stmt->execute(array($usuario,$usuario));
		$idsPareja_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$idsPareja = array();
		foreach ($idsPareja_db as $idPareja) {
			array_push($idsPareja, $idPareja['idPareja']);
		}

		return $idsPareja;
	}

	public function generarEnfrentamientosRegular($grupoId,$campeonatoId, $categoriaId){
		//Comprobacion numero minimo de participantes: Regular->minimo de 8 participantes
		$numParticipantes = $this->comprobarNumMinParticipantes($grupoId,'regular');
		if($numParticipantes<8){
			return "<div class='alert alert-warning' role='alert'>No hay suficientes participantes para realizar los enfrentamientos:
			minimo 8 participantes</div>";

		}

		$numEnfrentamientos = $this->combrobarEnfrentamientos($grupoId, 'regular');
		if($numEnfrentamientos>0){
			return "<div class='alert alert-info' role='alert'>Ya se han realizado los enfrentamientos de este grupo</div>";
		}else{

		$stmt = $this->db->prepare("SELECT idPareja FROM Pareja WHERE GrupoidGrupo=? AND GrupotipoLiga='regular'");
		$stmt->execute(array($grupoId));
		$parejas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$parejas= array();


		foreach ($parejas_db as $par) {
			$pareja = new Pareja($par["idPareja"]);
			array_push($parejas, $pareja);
		}

		for($i=0; $i<sizeof($parejas);$i++) {
			$stmt = $this->db->prepare("INSERT INTO Enfrentamiento( ParejaidPareja1, ParejaidPareja2,
			resultado, set1, set2, set3, GrupoidGrupo, GrupotipoLiga) values (?,?,?,?,?,?,?,?)");
			$stmt->execute(array($parejas[$i]->getIdPareja(), $parejas[$i]->getIdPareja(), 0, "-", "-", "-", $grupoId, 'regular'));

			for($j=0; $j<sizeof($parejas);$j++) {
				if($parejas[$i]->getIdPareja()!=$parejas[$j]->getIdPareja()){
					$stmt->execute(array($parejas[$i]->getIdPareja(), $parejas[$j]->getIdPareja(), 0, "-", "-", "-", $grupoId, 'regular'));
				}

			}
		}
			//return $this->db->lastInsertId();
		}
	}

//TODO Crear la clasificacion y update de grupo
	public function generarRankingRegular($grupoId, $campeonatoId, $categoriaId, $tipoLiga){
		//comprobar fin enfrentamientos
		$clasificacionRegular = $this->combrobarRanking($campeonatoId, $tipoLiga);
		if($clasificacionRegular>0){
			$this->borrarClasificacion($campeonatoId, $tipoLiga);
		}

		$numPartidosNoJugados = $this->comprobarFinPartidosLiga($grupoId,$tipoLiga);
		if($numPartidosNoJugados==0){
			$grupoid = $this->crearGrupo($grupoId,$campeonatoId, $categoriaId, 'cuartos');
		}

		//Devuelve parejas y su grupo en el campeonato
		$stmt = $this->db->prepare("SELECT distinct(idPareja), GrupoidGrupo FROM Pareja, Grupo
			WHERE GrupoidGrupo=? AND GrupotipoLiga=? AND Grupo.Campeonato_CategoriaCampeonatoidCampeonato=?");
		$stmt->execute(array($grupoId,'regular',$campeonatoId));
		$parejas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		//Comprueba si existe el campeonato regular del grupo en alguna clasificacion
		$stmt = $this->db->prepare("SELECT CampeonatoidCampeonato FROM Clasificacion
			WHERE CampeonatoidCampeonato=? AND GrupotipoLiga ='regular' AND GrupoidGrupo=?");
		$stmt->execute(array($campeonatoId,'regular',$grupoId));
		$clasificacion_db = $stmt->fetch(PDO::FETCH_ASSOC);

		if($clasificacion_db==NULL){
			foreach ($parejas_db as $par) {
				$stmt = $this->db->prepare("SELECT sum(resultado) AS puntosTotal FROM Enfrentamiento, Grupo
					WHERE GrupotipoLiga='regular' AND Grupo.idGrupo=? AND ParejaidPareja1=?
					AND Grupo.Campeonato_CategoriaCampeonatoidCampeonato =?");
					$stmt->execute(array($par['GrupoidGrupo'], $par['idPareja'], $campeonatoId));
					$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
					//insertar
					$stmt = $this->db->prepare("INSERT INTO Clasificacion(ParejaidPareja,
						 resultado, GrupoidGrupo, GrupotipoLiga, CampeonatoidCampeonato) values (?,?,?,?,?)");
					$stmt->execute(array($par['idPareja'], $resultado['puntosTotal'], $par['GrupoidGrupo'], 'regular', $campeonatoId));

			}
		}

			return $this->db->lastInsertId();
			//return $parejas;
	}

 //TODO comprobar que se ha finalizado la liga regular
 //TODO generar nuevas parejas
	public function generarEnfrentamientosCuartos($grupoId, $campeonatoId, $categoriaId){
		$numEnfrentamientos = $this->combrobarEnfrentamientos($grupoId, 'cuartos');
		if($numEnfrentamientos>0){
			return "<div class='alert alert-info' role='alert'>Ya se han realizado los enfrentamientos de este grupo</div>";
		}else{
		$stmt = $this->db->prepare("SELECT ParejaidPareja FROM Clasificacion
			WHERE CampeonatoidCampeonato=? AND GrupotipoLiga=? AND GrupoidGrupo=? ORDER BY resultado DESC");
		$stmt->execute(array($campeonatoId, 'regular', $grupoId));
		$parejas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$parejas= array();
		$parejasCuartos= array();
		if(sizeof($parejas_db)>=8){
			for($i=0; $i<8;$i++) {
				array_push($parejas, $parejas_db[$i]);
			}

			foreach ($parejas as $par) {
				$pareja = new Pareja($par["ParejaidPareja"]);
				array_push($parejasCuartos, $pareja);
			}
		}else{
			return "<div class='alert alert-warning' role='alert'>No hay suficientes parejas para realizar los cuartos</div>";

		}

		//insertar las parejeas en cuartos
		//$grupoid = $this->crearGrupo($campeonatoId, $categoriaId, 'cuartos');
		$this->insertar($parejas, $grupoId, 'cuartos');

		$stmt = $this->db->prepare("SELECT idPareja FROM Pareja
			WHERE  GrupotipoLiga=? AND GrupoidGrupo=?");
		$stmt->execute(array('cuartos', $grupoId));
		$parejas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$parejasC= array();
		foreach ($parejas_db as $par) {
			$pareja = new Pareja($par["idPareja"]);
			array_push($parejasC, $pareja);
		}

		$stmt = $this->db->prepare("INSERT INTO Enfrentamiento(ParejaidPareja1, ParejaidPareja2,
		resultado, set1, set2, set3, GrupoidGrupo, GrupotipoLiga) VALUES (?,?,?,?,?,?,?,?)");


		for($i=0; $i<4;$i++) {
			$stmt->execute(array($parejasC[$i]->getIdPareja(), $parejasC[sizeof($parejasC)-($i+1)]->getIdPareja(), 0, "-", "-", "-", $grupoId, 'cuartos'));
			$stmt->execute(array($parejasC[sizeof($parejasC)-($i+1)]->getIdPareja(), $parejasC[$i]->getIdPareja(), 0, "-", "-", "-", $grupoId, 'cuartos'));

		}

	}

	}


	//TODO mostrar pagina de clasificacion despues de generarla
		public function generarRankingCuartos($grupoId, $campeonatoId, $categoriaId, $tipoLiga){
			$clasificacionCuartos = $this->combrobarRanking($campeonatoId, $tipoLiga);
			if($clasificacionCuartos>0){
				$this->borrarClasificacion($campeonatoId, $tipoLiga);
			}



			$numPartidosNoJugados = $this->comprobarFinPartidosLiga($grupoId,$tipoLiga);
			if($numPartidosNoJugados==0){
				//Creamos grupo para la proxima liga
				$grupoid = $this->crearGrupo($grupoId, $campeonatoId, $categoriaId, 'semifinal');
			}

			$stmt = $this->db->prepare("SELECT ParejaidPareja1, resultado, Grupo.idGrupo FROM Enfrentamiento, Grupo
				WHERE GrupotipoLiga='cuartos' AND Grupo.Campeonato_CategoriaCampeonatoidCampeonato = ?
				 group by ParejaidPareja1 ORDER BY resultado DESC");
			$stmt->execute(array($campeonatoId));
			$parejas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$parejasSemifinales= array();
			if(sizeof($parejas_db)>=8){
				for($i=0; $i<8;$i++) {
					array_push($parejasSemifinales, $parejas_db[$i]);
				}
			}


			//Comprobamos si ya existe clasificacion para cuartos del campeonato
			$stmt = $this->db->prepare("SELECT CampeonatoidCampeonato FROM Clasificacion
				WHERE CampeonatoidCampeonato=? AND GrupotipoLiga ='cuartos'");
			$stmt->execute(array($campeonatoId));
			$clasificacion_db = $stmt->fetch(PDO::FETCH_ASSOC);

			//Si no existe insertamos las parejas
			if($clasificacion_db==NULL){
				foreach ($parejasSemifinales as $pareja) {
						$stmt = $this->db->prepare("INSERT INTO Clasificacion(ParejaidPareja,
							 resultado, GrupoidGrupo, GrupotipoLiga, CampeonatoidCampeonato) values (?,?,?,?,?)");
						$stmt->execute(array($pareja['ParejaidPareja1'], $pareja['resultado'], $pareja['idGrupo'], 'cuartos', $campeonatoId));

				}
			}


		}



	public function crearGrupo($grupoId, $campeonatoId, $categoriaId, $tipoLiga){
		$stmt = $this->db->prepare("SELECT idGrupo FROM Grupo
			WHERE Campeonato_CategoriaCampeonatoidCampeonato=? AND Campeonato_CategoriaCategoriaidCategoria=?
			AND  tipoLiga=? AND idGrupo=?");
		$stmt->execute(array($campeonatoId, $categoriaId, $tipoLiga, $grupoId));
		$grupoid_db = $stmt->fetch(PDO::FETCH_ASSOC);

		if($grupoid_db==NULL){
			$stmt = $this->db->prepare("INSERT INTO Grupo (idGrupo, tipoLiga, Campeonato_CategoriaCampeonatoidCampeonato,
				Campeonato_CategoriaCategoriaidCategoria) VALUES (?,?,?,?);");
			$stmt->execute(array($grupoId,$tipoLiga, $campeonatoId, $categoriaId));
			$registro = $this->db->lastInsertId();
		}

	}

	public function comprobarNumMinParticipantes($grupoId,$tipoLiga){
		$stmt = $this->db->prepare("SELECT count(idPareja) FROM Pareja
			WHERE GrupoidGrupo=? AND GrupotipoLiga=?");
		$stmt->execute(array($grupoId, $tipoLiga));
		$numParticipantes = $stmt->fetch(PDO::FETCH_ASSOC);

		return $numParticipantes['count(idPareja)'];
	}

	public function comprobarFinPartidosLiga($grupoId,$tipoLiga){
		$stmt = $this->db->prepare("SELECT count(*) FROM Enfrentamiento
			WHERE GrupoidGrupo=? AND GrupotipoLiga=? AND (set1='-' OR set2='-' OR set3='-') AND ParejaidPareja1!=ParejaidPareja2");
		$stmt->execute(array($grupoId, $tipoLiga));
		$numPartidosNoJugados = $stmt->fetch(PDO::FETCH_ASSOC);

		return $numPartidosNoJugados['count(*)'];
	}

	public function combrobarEnfrentamientos($grupoId, $tipoLiga){
		$stmt = $this->db->prepare("SELECT count(GrupoidGrupo) FROM Enfrentamiento
			WHERE GrupoidGrupo=? AND GrupotipoLiga=?");
		$stmt->execute(array($grupoId, $tipoLiga));
		$numEnfrentamientos = $stmt->fetch(PDO::FETCH_ASSOC);

		return $numEnfrentamientos['count(GrupoidGrupo)'];
	}


	public function combrobarRanking($campeonatoId, $tipoLiga){
		$stmt = $this->db->prepare("SELECT count(*) FROM Clasificacion
			WHERE CampeonatoidCampeonato=? AND GrupotipoLiga=?");
		$stmt->execute(array($campeonatoId, $tipoLiga));
		$clasificacion = $stmt->fetch(PDO::FETCH_ASSOC);

		return $clasificacion['count(*)'];
	}


	public function insertar($parejas, $grupoid, $tipoLiga){

		foreach ($parejas as $pareja) {
			$stmt = $this->db->prepare("SELECT * FROM Pareja WHERE idPareja=?");
			$stmt->execute(array($pareja['ParejaidPareja']));
			$infoPareja = $stmt->fetch(PDO::FETCH_ASSOC);

			$stmt = $this->db->prepare("INSERT INTO Pareja(capitan,
			deportista, GrupoidGrupo, GrupotipoLiga) values (?,?,?,?)");

			$stmt->execute(array($infoPareja['capitan'], $infoPareja['deportista'],$grupoid, $tipoLiga));
		}

	}


	public function borrarClasificacion($campeonatoId, $tipoLiga){
		$stmt = $this->db->prepare("DELETE FROM Clasificacion
			WHERE CampeonatoidCampeonato=? AND GrupotipoLiga=?");
		$stmt->execute(array($campeonatoId, $tipoLiga));

	}


	public function generarEnfrentamientosSemifinales($grupoId, $campeonatoId, $categoriaId){
		//$clasificacionSemiFinales = $this->combrobarRanking($campeonatoId, 'semifinal');
		//if($clasificacionSemiFinales>0){
			//throw new Exception("Ya se han realizado la clasificacion semifinales del campeonato: " . $campeonatoId);
		//}

		$numEnfrentamientos = $this->combrobarEnfrentamientos($grupoId, 'semifinal');
		if($numEnfrentamientos>0){
			return "<div class='alert alert-info' role='alert'>Ya se han realizado los enfrentamientos de este grupo</div>";
		}else{
		$stmt = $this->db->prepare("SELECT ParejaidPareja FROM Clasificacion
			WHERE CampeonatoidCampeonato=? AND GrupotipoLiga='cuartos' ORDER BY resultado DESC");
		$stmt->execute(array($campeonatoId));
		$parejas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$parejas = array();
		$parejasSemifinales= array();

		if(sizeof($parejas_db)>=4){
			for($i=0; $i<4;$i++) {
				array_push($parejas, $parejas_db[$i]);
			}

			//Se reordena los arrays aleatoriamente
			shuffle($parejas);

			foreach ($parejas as $par) {
				$pareja = new Pareja($par["ParejaidPareja"]);
				array_push($parejasSemifinales, $pareja);
			}
		}else{
			return "<div class='alert alert-warning' role='alert'>No hay suficientes parejas</div>";

		}

		$this->insertar($parejas, $grupoId, 'semifinal');

		$stmt = $this->db->prepare("SELECT idPareja FROM Pareja
			WHERE  GrupotipoLiga=? AND GrupoidGrupo=?");
		$stmt->execute(array('semifinal', $grupoId));
		$parejas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$parejasS= array();
		foreach ($parejas_db as $par) {
			$pareja = new Pareja($par["idPareja"]);
			array_push($parejasS, $pareja);
		}

		$stmt = $this->db->prepare("INSERT INTO Enfrentamiento(ParejaidPareja1, ParejaidPareja2,
		resultado, set1, set2, set3, GrupoidGrupo, GrupotipoLiga) values (?,?,?,?,?,?,?,?)");

		for($i=0; $i<2;$i++) {
			$stmt->execute(array($parejasS[$i]->getIdPareja(), $parejasS[sizeof($parejasS)-($i+1)]->getIdPareja(), 0, "-", "-", "-", $grupoId, 'semifinal'));
			$stmt->execute(array($parejasS[sizeof($parejasS)-($i+1)]->getIdPareja(), $parejasS[$i]->getIdPareja(), 0, "-", "-", "-", $grupoId, 'semifinal'));

		}

		}
	}


		public function generarRankingSemifinales($grupoId, $campeonatoId, $categoriaId){
			$clasificacionSemifinal = $this->combrobarRanking($campeonatoId, 'semifinal');
			if($clasificacionSemifinal>0){
				$this->borrarClasificacion($campeonatoId, 'semifinal');
			}

			$numPartidosNoJugados = $this->comprobarFinPartidosLiga($grupoId,'semifinal');
			if($numPartidosNoJugados==0){
			//Creamos grupo para la proxima liga
			$grupoid = $this->crearGrupo($grupoId, $campeonatoId, $categoriaId, 'final');
			}

			$stmt = $this->db->prepare("SELECT ParejaidPareja1, resultado, Grupo.idGrupo FROM Enfrentamiento, Grupo
				WHERE GrupotipoLiga='semifinal' AND Grupo.Campeonato_CategoriaCampeonatoidCampeonato = ?
				 group by ParejaidPareja1 ORDER BY resultado DESC");
			$stmt->execute(array($campeonatoId));
			$parejas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$parejasSemifinales= array();
			if(sizeof($parejas_db)>=4){
				for($i=0; $i<4;$i++) {
					array_push($parejasSemifinales, $parejas_db[$i]);
				}
			}


			//Comprobamos si ya existe clasificacion para semifinales del campeonato
			$stmt = $this->db->prepare("SELECT CampeonatoidCampeonato FROM Clasificacion
				WHERE CampeonatoidCampeonato=? AND GrupotipoLiga ='semifinal'");
			$stmt->execute(array($campeonatoId));
			$clasificacion_db = $stmt->fetch(PDO::FETCH_ASSOC);

			//Si no existe insertamos las parejas
			if($clasificacion_db==NULL){
				foreach ($parejasSemifinales as $pareja) {
						$stmt = $this->db->prepare("INSERT INTO Clasificacion(ParejaidPareja,
							 resultado, GrupoidGrupo, GrupotipoLiga, CampeonatoidCampeonato) values (?,?,?,?,?)");
						$stmt->execute(array($pareja['ParejaidPareja1'], $pareja['resultado'], $pareja['idGrupo'], 'semifinal', $campeonatoId));

				}
			}

				return $this->db->lastInsertId();
		}

		public function generarEnfrentamientosFinales($grupoId, $campeonatoId, $categoriaId){
			//$clasificacionFinales = $this->combrobarRanking($campeonatoId, 'final');
			//if($clasificacionFinales>0){
				//throw new Exception("Ya se han realizado la clasificacion final del campeonato: " . $campeonatoId);
			//}
			$numEnfrentamientos = $this->combrobarEnfrentamientos($grupoId, 'final');
			if($numEnfrentamientos>0){
				return "<div class='alert alert-info' role='alert'>Ya se han realizado los enfrentamientos de este grupo</div>";
			}else{
			$stmt = $this->db->prepare("SELECT ParejaidPareja FROM Clasificacion
				WHERE CampeonatoidCampeonato=? AND GrupotipoLiga='semifinal' ORDER BY resultado DESC");
			$stmt->execute(array($campeonatoId));
			$parejas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$parejas = array();
			$parejasFinales= array();

			if(sizeof($parejas_db)>=2){
				for($i=0; $i<2;$i++) {
					array_push($parejas, $parejas_db[$i]);
				}

				//Se reordena los arrays aleatoriamente
				//shuffle($parejas);

				foreach ($parejas as $par) {
					$pareja = new Pareja($par["ParejaidPareja"]);
					array_push($parejasFinales, $pareja);
				}
			}else{
				return "<div class='alert alert-warning' role='alert'>No hay suficientes parejas para realizar las finales</div>";

			}

			$this->insertar($parejas, $grupoId, 'final');

			$stmt = $this->db->prepare("SELECT idPareja FROM Pareja
				WHERE  GrupotipoLiga=? AND GrupoidGrupo=?");
			$stmt->execute(array('final', $grupoId));
			$parejas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$parejasF= array();
			foreach ($parejas_db as $par) {
				$pareja = new Pareja($par["idPareja"]);
				array_push($parejasF, $pareja);
			}

			$stmt = $this->db->prepare("INSERT INTO Enfrentamiento(ParejaidPareja1, ParejaidPareja2,
			resultado, set1, set2, set3, GrupoidGrupo, GrupotipoLiga) values (?,?,?,?,?,?,?,?)");

			$stmt->execute(array($parejasF[0]->getIdPareja(), $parejasF[1]->getIdPareja(), 0, "-", "-", "-", $grupoId, 'final'));
			$stmt->execute(array($parejasF[1]->getIdPareja(), $parejasF[0]->getIdPareja(), 0, "-", "-", "-", $grupoId, 'final'));


			}
		}



			public function generarRankingFinales($grupoId, $campeonatoId, $categoriaId,$tipoLiga){
				$clasificacionFinal = $this->combrobarRanking($campeonatoId, $tipoLiga);
				if($clasificacionFinal>0){
					$this->borrarClasificacion($campeonatoId, $tipoLiga);
				}

				$stmt = $this->db->prepare("SELECT ParejaidPareja1, resultado, Grupo.idGrupo FROM Enfrentamiento, Grupo
					WHERE GrupotipoLiga='final' AND Grupo.Campeonato_CategoriaCampeonatoidCampeonato = ?
					 group by ParejaidPareja1 ORDER BY resultado DESC");
				$stmt->execute(array($campeonatoId));
				$parejas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$parejasFinales= array();
				if(sizeof($parejas_db)>=2){
					for($i=0; $i<2;$i++) {
						array_push($parejasFinales, $parejas_db[$i]);
					}
				}


				//Comprobamos si ya existe clasificacion para semifinales del campeonato
				$stmt = $this->db->prepare("SELECT CampeonatoidCampeonato FROM Clasificacion
					WHERE CampeonatoidCampeonato=? AND GrupotipoLiga ='final'");
				$stmt->execute(array($campeonatoId));
				$clasificacion_db = $stmt->fetch(PDO::FETCH_ASSOC);

				//Si no existe insertamos las parejas
				if($clasificacion_db==NULL){
					foreach ($parejasFinales as $pareja) {
							$stmt = $this->db->prepare("INSERT INTO Clasificacion(ParejaidPareja,
								 resultado, GrupoidGrupo, GrupotipoLiga, CampeonatoidCampeonato) values (?,?,?,?,?)");
							$stmt->execute(array($pareja['ParejaidPareja1'], $pareja['resultado'], $pareja['idGrupo'], 'final', $campeonatoId));

					}
				}

					return $this->db->lastInsertId();
			}


    //Funciones Nacho

    public function countByGrupo($idGrupo) {

        $stmt = $this->db->prepare("SELECT COUNT(*) as cont FROM Pareja WHERE GrupoidGrupo = $idGrupo ");
        $stmt->execute();
        $numParejas = $stmt->fetch(PDO::FETCH_ASSOC);

        return $numParejas;
    }

    public function addPareja($capitan, $deportista, $grupoId, $tipoLiga) {
        $stmt = $this->db->prepare("INSERT INTO Pareja(capitan,deportista,GrupoidGrupo,GrupotipoLiga) values (?,?,?,?)");
        $stmt->execute(array($capitan, $deportista, $grupoId, $tipoLiga));
        return $this->db->lastInsertId();
    }

    public function findDupledA($deportista, $grupoId, $tipoLiga) {

        //$stmt = $this->db->prepare("SELECT COUNT(*) as cont FROM Pareja WHERE capitan = '$deportista' AND GrupoidGrupo = $grupoId AND GrupotipoLiga = '$tipoLiga'");
				$stmt = $this->db->prepare("SELECT COUNT(*) as cont FROM Pareja WHERE capitan = ? AND GrupoidGrupo = ? AND GrupotipoLiga = ?");

				$stmt->execute(array($deportista, $grupoId, $tipoLiga));
        $numParejas = $stmt->fetch(PDO::FETCH_ASSOC);

        return $numParejas;
    }

    public function findDupledB($deportista, $grupoId, $tipoLiga) {

        //$stmt = $this->db->prepare("SELECT COUNT(*) as cont FROM Pareja WHERE deportista = '$deportista' AND GrupoidGrupo = $grupoId AND GrupotipoLiga = '$tipoLiga'");
				$stmt = $this->db->prepare("SELECT COUNT(*) as cont FROM Pareja WHERE deportista = ? AND GrupoidGrupo = ? AND GrupotipoLiga = ?");

				$stmt->execute(array($deportista, $grupoId, $tipoLiga));
        $numParejas = $stmt->fetch(PDO::FETCH_ASSOC);

        return $numParejas;
    }


    	public function crearGrupoB($campeonatoId, $categoriaId, $tipoLiga){
			//$stmt = $this->db->prepare("SELECT idGrupo FROM Grupo
				//WHERE Campeonato_CategoriaCampeonatoidCampeonato = $campeonatoId
				//AND Campeonato_CategoriaCategoriaidCategoria = $categoriaId
				//AND  tipoLiga = '$tipoLiga'");
				$stmt = $this->db->prepare("SELECT idGrupo FROM Grupo
					WHERE Campeonato_CategoriaCampeonatoidCampeonato = ?
					AND Campeonato_CategoriaCategoriaidCategoria = ?
					AND  tipoLiga = ?");
			$stmt->execute(array($campeonatoId, $categoriaId, $tipoLiga));
			$grupoid_db = $stmt->fetch(PDO::FETCH_ASSOC);


		if($grupoid_db==NULL){
			$stmt = $this->db->prepare("INSERT INTO Grupo (tipoLiga, Campeonato_CategoriaCampeonatoidCampeonato,
				Campeonato_CategoriaCategoriaidCategoria) VALUES (?,?,?);");
			$stmt->execute(array($tipoLiga, $campeonatoId, $categoriaId));
			$registro = $this->db->lastInsertId();

		}
			return $this->db->lastInsertId();
	}
	
		public function findByIdPareja($parejaId){
		$stmt = $this->db->prepare("SELECT * from Pareja where idPareja=?");
		$stmt->execute(array($parejaId));
		$pareja = $stmt->fetch(PDO::FETCH_ASSOC);

		return new Pareja($pareja['idPareja'], new UsuarioRegistrado($pareja['capitan']), new UsuarioRegistrado($pareja['deportista']));
	}


}
