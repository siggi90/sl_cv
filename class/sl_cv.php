<?

class sl_cv {
	private $sql;
	private $statement;
	private $user_id;
	
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
		$query = "SELECT * FROM images ORDER BY id DESC";
		$rows = $this->sql->get_rows($query, 1);
		
		$results = array();
		
		foreach($rows as $row) {
			$results[] = array(
				'image' => $row['id'].$row['extension'],
				'description' => $row['description']
			);	
		}
		return $results;
	}
	
}

?>