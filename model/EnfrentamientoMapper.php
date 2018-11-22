<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/UsuarioRegistrado.php");
require_once(__DIR__."/../model/Pareja.php");
require_once(__DIR__."/../model/Enfrentamiento.php");

/**
* Class PostMapper
*
* Database interface for Post entities
*
* @author Patricia
*/
class EnfrentamientoMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Retrieves all posts
	*
	* Note: Comments are not added to the Post instances
	*
	* @throws PDOException if a database error occurs
	* @return mixed Array of Post instances (without comments)
	*/
	public function findAllByGrupoLiga($grupoId, $tipoLiga) {
		$stmt = $this->db->prepare("SELECT * FROM Enfrentamiento WHERE GrupoidGrupo=? AND GrupotipoLiga=?");
		$stmt->execute(array($grupoId, $tipoLiga));
		$enfrentamientos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$enfrentamientos = array();

		foreach ($enfrentamientos_db as $enfrentamiento) {
			$pareja1 = new Pareja($enfrentamiento["ParejaidPareja1"]);
			$pareja2 = new Pareja($enfrentamiento["ParejaidPareja2"]);
			array_push($enfrentamientos, new Enfrentamiento($enfrentamiento["idEnfrentamiento"],
			$pareja1, $pareja2, $enfrentamiento["set1"], $enfrentamiento["set2"], $enfrentamiento["set3"],
			$enfrentamiento["resultado"], new Grupo($enfrentamiento["GrupoidGrupo"],NULL, NULL, $enfrentamiento["GrupotipoLiga"])));
		}


		return $enfrentamientos;
	}

	/**
	* Retrieves all posts
	*
	* Note: Comments are not added to the Post instances
	*
	* @throws PDOException if a database error occurs
	* @return mixed Array of Post instances (without comments)
	*/
	public function findAllParejas($grupoId, $tipoLiga) {
		$stmt = $this->db->prepare("SELECT idPareja, capitan, deportista FROM Pareja WHERE GrupoidGrupo=? AND GrupotipoLiga=?");
		$stmt->execute(array($grupoId, $tipoLiga));
		$parejas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$parejas = array();

		foreach ($parejas_db as $pareja) {
			array_push($parejas, new Pareja($pareja["idPareja"],
														new UsuarioRegistrado($pareja["capitan"]),
														new UsuarioRegistrado($pareja["deportista"])));
		}

		return $parejas;
	}

	/**
	* Loads a Post from the database given its id
	*
	* Note: Comments are not added to the Post
	*
	* @throws PDOException if a database error occurs
	* @return Post The Post instances (without comments). NULL
	* if the Post is not found
	*/
	public function findByIdPareja($grupoId, $tipoLiga){
		$parejas = $this->findAllParejas($grupoId, $tipoLiga);
		$enfrentamientos = array();

		foreach ($parejas as $pareja) {
			$pareja1Id = $pareja->getIdPareja();
			$stmt = $this->db->prepare("SELECT * FROM Enfrentamiento WHERE GrupoidGrupo=? AND GrupotipoLiga=?
				AND ParejaidPareja1=? ORDER BY ParejaidPareja2");
			$stmt->execute(array($grupoId, $tipoLiga, $pareja1Id));
			$enfrentamientoPareja1_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$enfrentamientosPareja = array();

			foreach ($enfrentamientoPareja1_db as $enfrentamiento) {
				$pareja1 = new Pareja($enfrentamiento["ParejaidPareja1"]);
				$pareja2 = new Pareja($enfrentamiento["ParejaidPareja2"]);
				array_push($enfrentamientosPareja, new Enfrentamiento($enfrentamiento["idEnfrentamiento"],
				$pareja1, $pareja2, $enfrentamiento["set1"], $enfrentamiento["set2"], $enfrentamiento["set3"],
				$enfrentamiento["resultado"], new Grupo($enfrentamiento["GrupoidGrupo"],NULL, NULL, $enfrentamiento["GrupotipoLiga"])));
			}

				array_push($enfrentamientos, $enfrentamientosPareja);

		}

		return $enfrentamientos;
	}




	/**
	* Loads a Post from the database given its id
	*
	* Note: Comments are not added to the Post
	*
	* @throws PDOException if a database error occurs
	* @return Post The Post instances (without comments). NULL
	* if the Post is not found
	*/
	public function findByIdEnfrentamiento($enfrentamientoId){
		$stmt = $this->db->prepare("SELECT * FROM Enfrentamiento WHERE idEnfrentamiento=?");
		$stmt->execute(array($enfrentamientoId));
		$enfrentamiento = $stmt->fetch(PDO::FETCH_ASSOC);

		if($enfrentamiento != null) {
			return new Enfrentamiento(
			$enfrentamiento["idEnfrentamiento"],
			new Pareja($enfrentamiento["ParejaidPareja1"]),
			new Pareja($enfrentamiento["ParejaidPareja2"]),
			$enfrentamiento["set1"],
			$enfrentamiento["set2"],
			$enfrentamiento["set3"],
			$enfrentamiento["resultado"]);
		} else {
			return NULL;
		}
	}


	public function recogerResultados($idPareja1, $idPareja2, $set1, $set2, $set3){
		$sets1 = explode( '-', $set1 );
		$sets2 = explode( '-', $set2 );
		$sets3 = explode( '-', $set3 );


		$this->update($idPareja1, $idPareja2, $sets1, $sets2, $sets3);

	}

	public function update($idPareja1, $idPareja2, $sets1, $sets2, $sets3) {
		$stmt = $this->db->prepare("UPDATE Enfrentamiento set set1=?, set2=?, set3=?
			WHERE ParejaidPareja1=? AND ParejaidPareja2=?");
		$stmt->execute(array( trim($sets1[0]) . "-" . trim($sets1[1]),
													trim($sets2[0]) . "-" . trim($sets2[1]),
													trim($sets3[0]) . "-" . trim($sets3[1]),
													$idPareja1, $idPareja2));
		$stmt->execute(array( trim($sets1[1]) . "-" . trim($sets1[0]),
													trim($sets2[1]) . "-" . trim($sets2[0]),
													trim($sets3[1]) . "-" . trim($sets3[0]),
													$idPareja2, $idPareja1));

		$this->actualizarResultado($idPareja1, $idPareja2);

	}


	public function actualizarResultado($idPareja1, $idPareja2) {

		$stmt = $this->db->prepare("SELECT * FROM Enfrentamiento WHERE ParejaidPareja1=? AND ParejaidPareja2=?");
		$stmt->execute(array($idPareja1, $idPareja2));
		$enfrentamiento = $stmt->fetch(PDO::FETCH_ASSOC);


		if($enfrentamiento != null) {
				$set1 = $enfrentamiento['set1'];
				$set2 = $enfrentamiento['set2'];
				$set3 = $enfrentamiento['set3'];

				$sets1 = explode( '-', $set1 );
				$sets2 = explode( '-', $set2 );
				$sets3 = explode( '-', $set3 );

				$puntosSet1P1=0;
				$puntosSet1P2=0;
				$puntosSet2P1=0;
				$puntosSet2P2=0;
				$puntosSet3P1=0;
				$puntosSet3P2=0;

				//Puntos set1
				if($sets1[0]>$sets1[1]){
					$puntosSet1P1=1;
					$puntosSet1P2=0;
				}elseif($sets1[0]<$sets1[1]){
					$puntosSet1P1=0;
					$puntosSet1P2=1;
				}else{
					$puntosSet1P1=1;
					$puntosSet1P2=1;
				}

				//Puntos set2
				if($sets2[0]>$sets2[1]){
					$puntosSet2P1=1;
					$puntosSet2P2=0;
				}elseif($sets2[0]<$sets2[1]){
					$puntosSet2P1=0;
					$puntosSet2P2=1;
				}else{
					$puntosSet2P1=1;
					$puntosSet2P2=1;
				}

				//Puntos set3
				if($sets3[0]>$sets3[1]){
					$puntosSet3P1=1;
					$puntosSet3P2=0;
				}elseif($sets3[0]<$sets3[1]){
					$puntosSet3P1=0;
					$puntosSet3P2=1;
				}else{
					$puntosSet3P1=1;
					$puntosSet3P2=1;
				}

				$totalPartidoP1=$puntosSet1P1 + $puntosSet2P1 + $puntosSet3P1;
				$totalPartidoP2=$puntosSet1P2 + $puntosSet2P2 + $puntosSet3P2;


				$stmt = $this->db->prepare("UPDATE Enfrentamiento set resultado=?
					WHERE ParejaidPareja1=? AND ParejaidPareja2=?");
				$stmt->execute(array($totalPartidoP1,$idPareja1, $idPareja2));
				$stmt->execute(array($totalPartidoP2,$idPareja2, $idPareja1));


		} else {
			return NULL;
		}


	}



	/**
	* Loads a Post from the database given its id
	*
	* It includes all the comments
	*
	* @throws PDOException if a database error occurs
	* @return Post The Post instances (without comments). NULL
	* if the Post is not found
	*/
	public function findByIdWithComments($postid){
		$stmt = $this->db->prepare("SELECT
			P.id as 'post.id',
			P.title as 'post.title',
			P.content as 'post.content',
			P.author as 'post.author',
			C.id as 'comment.id',
			C.content as 'comment.content',
			C.post as 'comment.post',
			C.author as 'comment.author'

			FROM posts P LEFT OUTER JOIN comments C
			ON P.id = C.post
			WHERE
			P.id=? ");

			$stmt->execute(array($postid));
			$post_wt_comments= $stmt->fetchAll(PDO::FETCH_ASSOC);

			if (sizeof($post_wt_comments) > 0) {
				$post = new Post($post_wt_comments[0]["post.id"],
				$post_wt_comments[0]["post.title"],
				$post_wt_comments[0]["post.content"],
				new User($post_wt_comments[0]["post.author"]));
				$comments_array = array();
				if ($post_wt_comments[0]["comment.id"]!=null) {
					foreach ($post_wt_comments as $comment){
						$comment = new Comment( $comment["comment.id"],
						$comment["comment.content"],
						new User($comment["comment.author"]),
						$post);
						array_push($comments_array, $comment);
					}
				}
				$post->setComments($comments_array);

				return $post;
			}else {
				return NULL;
			}
		}

		/**
		* Saves a Post into the database
		*
		* @param Post $post The post to be saved
		* @throws PDOException if a database error occurs
		* @return int The mew post id
		*/
		public function save(Post $post) {
			$stmt = $this->db->prepare("INSERT INTO posts(title, content, author) values (?,?,?)");
			$stmt->execute(array($post->getTitle(), $post->getContent(), $post->getAuthor()->getUsername()));
			return $this->db->lastInsertId();
		}


		/**
		* Deletes a Post into the database
		*
		* @param Post $post The post to be deleted
		* @throws PDOException if a database error occurs
		* @return void
		*/
		public function delete(Post $post) {
			$stmt = $this->db->prepare("DELETE from posts WHERE id=?");
			$stmt->execute(array($post->getId()));
		}

	}
