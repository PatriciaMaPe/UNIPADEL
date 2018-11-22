<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/UsuarioRegistrado.php");
//require_once(__DIR__."/../model/establecerPistas.php");
require_once(__DIR__."/../model/GestionarReservas.php");

/**
*
*
* @author Victor
*/
class GestionarReservasMapper {

	private $db;
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}


	public function findByFecha($fec){
		$stmt = $this->db->prepare("SELECT idPista,horario,disponibilidad FROM horario WHERE fecha=?");
		$stmt->execute(array($fec));
		$pistas = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$horas=array();
		foreach($pistas as $hora){
			array_push($horas, new GestionarReservas(NULL,$pistas["disponibilidad"],$pistas["idPista"],$pistas["horario"]));
		}
		return $horas;
		//return new GestionarReservas($pistas['idPista']);
		//return new GestionarReservas(NULL,$pistas["disponibilidad"],$pistas["idPista"],$pistas["horario"]);
		//return new GestionarReservas($verPistas["idPista"],$verPistas["horario"],$verPistas["disponibilidad"]);
	}

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

		public function update(Post $post) {
			$stmt = $this->db->prepare("UPDATE posts set title=?, content=? where id=?");
			$stmt->execute(array($post->getTitle(), $post->getContent(), $post->getId()));
		}

		public function delete(Post $post) {
			$stmt = $this->db->prepare("DELETE from posts WHERE id=?");
			$stmt->execute(array($post->getId()));
		}
	}
