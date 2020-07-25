<?

class sl_cv {
	private $sql;
	private $statement;
	private $user_id;
	
	private $list_start = 5;
	
	function __construct($sql, $statement, $user_id) {
		$this->sql = $sql;
		$this->statement = $statement;
		$this->user_id = $user_id;
	}
	
	/*function downloads_table($search_term, $offset) {
		$query = "SELECT downloads.id as id, app.apps.name as image, downloads.title as title, downloads.description as description, href FROM downloads, app.apps WHERE downloads.app_id = app.apps.id";	
		return $this->sql->get_rows($query, 1);
	}
	
	function web_applications_table($search_term, $offset) {
		$query = "SELECT web_applications.id as id, app.apps.name as image, web_applications.title as title, web_applications.description as description, href FROM web_applications, app.apps WHERE web_applications.app_id = app.apps.id";	
		return $this->sql->get_rows($query, 1);
	}
	
	function email_validation($value) {
		$query = "SELECT COUNT(*) as count FROM app.users WHERE email = '".$value."'";
		$count = $this->sql->get_row($query)['count'];
		return !($count > 0);	
	}*/
	
	function get_menu_index_main() {
		$query = "SELECT id, title FROM pages";	
		$rows = $this->sql->get_rows($query, 1);
		
		$results = array();
		$results[] = array('id' => 'news');
		foreach($rows as $row) {
			$results[] = array(
				'id' => $row['id'],
				'title' => $row['title'],
				'page' => 'custom_page'
			);	
		}
		$results[] = array('id' => 'publications');
		$results[] = array('id' => 'images');
		return $results;
	}
	
	function pages_table() {
		$query = "SELECT * FROM pages";
		return $this->sql->get_rows($query, 1);	
	}
	
	function _page($v) {
		$this->statement->generate($v, "sl_cv.pages");
		$this->sql->execute($this->statement->get());
		$id = $this->sql->last_id($v);
		return $id;
	}
	
	function get_page($id) {
		$query = "SELECT * FROM pages WHERE id = ".$id;
		return $this->sql->get_row($query, 1);	
	}
	
	function delete_page($id) {
		$query = "DELETE FROM pages WHERE id = ".$id;
		$this->sql->execute($query);	
	}
	
	function _user($v) {
		if($this->user_id != -1) {
			$v['id'] = $this->user_id;	
		}
		$this->statement->generate($v, "app.users");
		$this->sql->execute($this->statement->get());
		$user_id = $this->sql->last_id($v);	
		if($user_id != -1) {
			$this->user_id = $user_id;
			$_SESSION['user_id'] = $user_id;
		}
		return $user_id;
	}
	
	function _image($v) {
		$this->statement->generate($v, "sl_cv.images");
		$this->sql->execute($this->statement->get());
		$id = $this->sql->last_id($v);
		return $id;
	}
	
	function images_list($search_term, $offset) {
		$query = "SELECT * FROM images ORDER BY id DESC LIMIT ".($offset+$this->list_start);
		$rows = $this->sql->get_rows($query, 1);
		
		$results = array();
		
		foreach($rows as $row) {
			$results[] = array(
				'id' => $row['id'],
				'image' => $row['id'].$row['extension'],
				'description' => $row['description']
			);	
		}
		return $results;
	}
	
	function get_edit_image($id) {
		$query = "SELECT id, description FROM images WHERE id = ".$id;
		return $this->sql->get_row($query, 1);	
	}
	
	function delete_image($id) {
		$query = "DELETE FROM images WHERE id = ".$id;
		$this->sql->execute($query);	
	}
	
	function publications_table($search_term, $offset, $category_id) {
		$query = "SELECT id, publication, DATE_FORMAT(created, '%M %d %Y') as created, link  FROM publications WHERE category_id = ".$category_id;
		return $this->sql->get_rows($query, 1);	
	}
	
	function publication_categories_table($search_term, $offset) {
		$query = "SELECT * FROM publication_categories";
		return $this->sql->get_rows($query, 1);	
	}
	
	function get_publication_categorie($id) {
		$query = "SELECT * FROM publication_categories WHERE id = ".$id;
		return $this->sql->get_row($query, 1);	
	}
	
	function _publication_category($v) {
		$this->statement->generate($v, "sl_cv.publication_categories");
		$this->sql->execute($this->statement->get());
		$id = $this->sql->last_id($v);
		return $id;
	}
	
	function _publication($v) {
		$this->statement->generate($v, "sl_cv.publications");
		$this->sql->execute($this->statement->get());
		$id = $this->sql->last_id($v);
		return $id;
	}
	
	function get_publication($id) {
		$query = "SELECT id, publication, DATE_FORMAT(created, '%Y-%m-%d') as created, link  FROM publications WHERE id = ".$id;
		return $this->sql->get_row($query, 1);	
	}
	
	function delete_publication($id) {
		$query = "DELETE FROM publications WHERE id = ".$id;
		$this->sql->execute($query);	
	}
}

?>