<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");



/**
* Class PostMapper
*
* Database interface for Post entities
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



	public function generarEnfrentamientosRegular($grupoId){
		//Comprobaciones:  existe clasificacion,
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
			return $this->db->lastInsertId();
			//return $parejas;
	}

	public function generarEnfrentamientosCuartos($grupoId){
		$stmt = $this->db->prepare("SELECT ParejaidPareja1, resultado FROM Enfrentamiento WHERE GrupoidGrupo=? order by resultado desc");
		$stmt->execute(array($grupoId));
		$parejas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$parejas= array();

		for($i=0; $i<8;$i++) {
			$pareja = new Pareja($parejas_db[$i]->idPareja());
			array_push($parejas, $pareja);
		}

		$stmt = $this->db->prepare("INSERT INTO Enfrentamiento(ParejaidPareja1, ParejaidPareja2,
		resultado, set1, set2, set3, GrupoidGrupo) values (?,?,?,?,?,?,?)");

		for($i=0; $i<8;$i++) {
			$stmt->execute(array($parejas_db[$i]->idPareja(), $parejas_db[($parejas_db-$i)]->idPareja(), "-", "-", "-", "-", $grupoId));
		}
		return $this->db->lastInsertId();
			//return $parejas;
	}

	public function generarEnfrentamientosSemifinales($grupoId){

	}

	/**
	* Retrieves all posts
	*
	* Note: Comments are not added to the Post instances
	*
	* @throws PDOException if a database error occurs
	* @return mixed Array of Post instances (without comments)
	*/
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM Pareja, UsuarioRegistrado  WHERE UsuarioRegistrado.usuario = posts.author");
		$posts_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$posts = array();

		foreach ($posts_db as $post) {
			$author = new User($post["username"]);
			array_push($posts, new Post($post["id"], $post["title"], $post["content"], $author));
		}

		return $posts;
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
	public function findById($parejaId){
		$stmt = $this->db->prepare("SELECT * FROM Pareja WHERE idPareja=?");
		$stmt->execute(array($parejaId));
		$pareja = $stmt->fetch(PDO::FETCH_ASSOC);

		if($pareja != null) {
			return new Pareja(
			$pareja["idPareja"],
			new UsuarioRegistrado($pareja["capitan"]),
			new UsuarioRegistrado($pareja["deportista"]),
			$pareja["GrupoidGrupo"]);
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
		* Updates a Post in the database
		*
		* @param Post $post The post to be updated
		* @throws PDOException if a database error occurs
		* @return void
		*/
		public function update(Post $post) {
			$stmt = $this->db->prepare("UPDATE posts set title=?, content=? where id=?");
			$stmt->execute(array($post->getTitle(), $post->getContent(), $post->getId()));
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
