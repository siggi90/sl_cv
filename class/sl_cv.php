<?

class sl_cv {
	private $sql;
	private $statement;
	private $user_id;
	
	private $list_start = 5;
	private $language;
	
	function __construct($sql, $statement, $user_id) {
		$this->sql = $sql;
		$this->statement = $statement;
		$this->user_id = $user_id;
		
		if(isset($_SESSION['language'])) {
			$this->language = $_SESSION['language'];
		} else {
			$query = "SELECT value FROM settings WHERE property = 'language'";
			$row = $this->sql->get_row($query, 1);
			$this->language = $row['value'];	
		}
	}
	
	function set_language($value) {
		//$this->set_property("language", $value);
		$_SESSION['language'] = $value;
		$this->language = $value;	
	}
	
	function get_language() {
		var_dump($_SESSION['language']);	
	}
	
	function set_property($property, $value) {
		$query = "DELETE FROM settings WHERE property = '".$property."'";
		$this->sql->execute($query);
		$query = "INSERT INTO settings (property, value) VALUES('".$property."', '".$value."')";
		$this->sql->execute($query);	
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
	
	function get_custom_page($id) {
		$query = "SELECT * FROM pages WHERE id = ".$id;
		$row = $this->sql->get_row($query, 1);
		
		if($this->language == 0) {
			return array(
				'title' => $row['title'],
				'description' => $row['description'],
				'content' => $row['content']
			);
		} else {
			return array(
				'title' => $row['title_2'],
				'description' => $row['description_2'],
				'content' => $row['content_2']
			);
		}
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
	
	
	function images_display_list($search_term, $offset) {
		$query = "SELECT * FROM images ORDER BY id DESC";// DESC LIMIT ".($offset+$this->list_start);
		$rows = $this->sql->get_rows($query, 1);
		
		$results = array();
		
		foreach($rows as $row) {
			$results[] = array(
				'id' => $row['id'],
				'image' => $row['id'].$row['extension'],
				'content' => $row['description']
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
	
	function publications_list($search_term, $offset, $category_id=-1) {
		$query = "SELECT id, DATE_FORMAT(created, '%Y') as created, link, publication as content FROM publications"; //%M %d
		if($category_id != -1) {
			$query .= " WHERE category_id = ".$category_id;	
		}
		$query .= " ORDER BY created DESC";
		$rows = $this->sql->get_rows($query, 1);	
		foreach($rows as $key => $row) {
			if($row['link'] == "") {
				unset($rows[$key]['link']);
			} else {
				$rows[$key]['link'] = "<a href='".$row['link']."'>".$row['link']."</a>";
			}
			$query = "SELECT * FROM publication_files WHERE publication_id = ".$row['id'];
			$files = $this->sql->get_rows($query, 1);
			if(count($files) > 0) {
				$rows[$key]['link'] = "<a href='uploads/".$files[0]['id'].$files[0]['extension']."'>".$files[0]['filename']."</a>";
			}
		}
		return $rows;
	}
	
	function publication_categories_table($search_term, $offset) {
		$query = "SELECT * FROM publication_categories";
		return $this->sql->get_rows($query, 1);	
	}
	
	function publication_categories_options() {
		if($this->language == 0) {
			$query = "SELECT id as id, category_name as value FROM publication_categories ORDER BY category_name DESC";
			$rows = $this->sql->get_rows($query, 1);
			
			$rows[] = array('id' => '-1', 'value' => 'By year');
			return array_reverse($rows);
		} else {
			$query = "SELECT id as id, category_name_2 as value FROM publication_categories ORDER BY category_name DESC";
			$rows = $this->sql->get_rows($query, 1);
			
			$rows[] = array('id' => '-1', 'value' => 'Eftir ártali');
			return array_reverse($rows);
		}
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
		$query = "SELECT id, publication, DATE_FORMAT(created, '%Y-%m-%d') as created, link, category_id  FROM publications WHERE id = ".$id;
		return $this->sql->get_row($query, 1);	
	}
	
	function delete_publication($id) {
		$query = "DELETE FROM publications WHERE id = ".$id;
		$this->sql->execute($query);	
	}
	
	function publication_files_table($search_term, $offset, $publication_id) {
		$query = "SELECT * FROM publication_files WHERE publication_id = ".$publication_id;
		return $this->sql->get_rows($query, 1);
	}
	
	function delete_publication_file($id) {
		$query = "DELETE FROM publication_files WHERE id = ".$id;
		$this->sql->execute($query);	
	}
	
	function _publication_file($v) {
		$this->statement->generate($v, "sl_cv.publication_files");
		$this->sql->execute($this->statement->get());
		$id = $this->sql->last_id($v);
		return $id;
	}
	
	function _news($v) {
		$this->statement->generate($v, "sl_cv.news");
		$this->sql->execute($this->statement->get());
		$id = $this->sql->last_id($v);
		return $id;
	}
	
	function news_table($search_term, $offset) {
		$query = "SELECT id, title FROM news ORDER BY id DESC";
		return $this->sql->get_rows($query, 1);	
	}
	
	function get_new($id) {
		$query = "SELECT * FROM news WHERE id = ".$id;
		return $this->sql->get_row($query, 1);
	}
	
	function get_article($id) {
		$row = $this->get_new($id);	
		$query = "SELECT * FROM news_images WHERE news_id = ".$row['id']." ORDER BY id DESC LIMIT 1";
		$image = $this->sql->get_row($query, 1);
		$row['image'] = $image['id'].$image['extension'];	
		return $row;
	}
	
	function news_list($search_term, $offset) {
		if($this->language == 0) {
			$query = "SELECT id, title, content, created FROM news ORDER BY id DESC LIMIT ".($offset+$this->list_start);
		} else {
			$query = "SELECT id, title_2, content_2, created FROM news ORDER BY id DESC LIMIT ".($offset+$this->list_start);
		}
		$rows = $this->sql->get_rows($query, 1);	
		foreach($rows as $key => $row) {
			$query = "SELECT * FROM news_images WHERE news_id = ".$row['id']." ORDER BY id DESC LIMIT 1";
			$image = $this->sql->get_row($query, 1);
			$rows[$key]['image'] = $image['id'].$image['extension'];	
		}
		return $rows;
	}
	
	function _news_image($v) {
		$this->statement->generate($v, "sl_cv.news_images");
		$this->sql->execute($this->statement->get());
		$id = $this->sql->last_id($v);
		return $id;
	}
}

?>