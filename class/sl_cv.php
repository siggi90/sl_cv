<?

class sl_cv {
	private $sql;
	private $statement;
	private $user_id;
	
	private $list_start = 5;
	private $language;
	
	public $function_access = array(
		'admin' => array(
			'_page',
			'_user',
			'_image',
			'_publication',
			'_publication_category',
			'_news',
			'delete_*',
			'_news_image',
			'_settings'
		)
	);
	
	function __construct($sql, $statement, $user_id) {
		$this->sql = $sql;
		$this->statement = $statement;
		$this->user_id = $user_id;
		
		
		$this->statement->set_callback(function($value) {
			$value = str_replace(array("<pre>","</pre>","<div>","</div>"), "", $value);
			$pattern = "/<p[^>]*><\\/p[^>]*>/"; 
			$value = preg_replace($pattern, '', $value); 
			return $value;
		});
		
		if(isset($_SESSION['language'])) {
			$this->language = $_SESSION['language'];
		} else {
			$query = "SELECT value FROM settings WHERE property = 'language'";
			$row = $this->sql->get_row($query, 1);
			$this->language = $row['value'];	
			$_SESSION['language'] = $this->language;
		}
	}
	
	function delete_publication_categorie($id) {
		$query = "DELETE FROM publication_categories WHERE id = ".$id;
		$this->sql->execute($query);	
	}
	
	function set_language($value) {
		//$this->set_property("language", $value);
		$_SESSION['language'] = $value;
		$this->language = $value;	
	}
	
	function set_property($property, $value) {
		$query = "DELETE FROM settings WHERE property = '".$property."'";
		$this->sql->execute($query);
		$query = "INSERT INTO settings (property, value) VALUES('".$property."', '".$value."')";
		$this->sql->execute($query);	
	}
	
	function get_introduction() {
		$suffix = "";
		if($this->language != 0) {
			$suffix = "_2";	
		}
		
		$query = "SELECT value as introduction FROM settings WHERE property = 'introduction".$suffix."'";
		return $this->sql->get_row($query, 1);	
	}
	
	function get_index() {
		$query = "SELECT * FROM settings WHERE property = 'title'";
		$result = $this->sql->get_row($query, 1);
		return array(
			$result['property'] => $result['value']
		);
	}
	
	function get_menu_index_main() {
		$query;
		if($this->language == 0) {
			$query = "SELECT id, title FROM pages";	
		} else {
			$query = "SELECT id, title_2 as title FROM pages";	
		}
		$rows = $this->sql->get_rows($query, 1);
			
		$results = array();
		foreach($rows as $row) {
			$results[] = array(
				'id' => $row['id'],
				'title' => $row['title'],
				'page' => 'custom_page'
			);	
		}
		$results[] = array('id' => 'news');
		$results[] = array('id' => 'publications');
		$results[] = array('id' => 'images');
	
	
		$page_order = array();
		$query = "SELECT * FROM menu_order ORDER BY order_value ASC";
		$rows = $this->sql->get_rows($query, 1);
		foreach($rows as $row) {
			$page_order[$row['page_id']] = $row['order_value'];	
		}
		
		return array(
			'pages' => $results,
			'order' => $page_order	
		);
	}
	
	function page_order_table() {
		$query = "SELECT * FROM pages";
		$rows = $this->sql->get_rows($query, 1);
		$rows[] = array('id' => 'news', 'title' => 'News');
		$rows[] = array('id' => 'publications', 'title' => 'Publications');
		$rows[] = array('id' => 'images', 'title' => 'Images');
		
		foreach($rows as $key => $row) {
			$query = "SELECT * FROM menu_order WHERE page_id = '".$row['id']."'";
			$result = $this->sql->get_row($query, 1);
			if($result != NULL) {
				$rows[$key]['order'] = $result['order_value'];	
			} else {
				$rows[$key]['order'] = -1;	
			}
		}
		usort($rows, function($a, $b) {
			return $a['order'] > $b['order'];
		});
		return $rows;
	}
	
	function page_order_set_order($v) {
		var_dump($v);
		foreach($v as $key => $value) {
			if($value != '-1') {
				$query = "DELETE FROM menu_order WHERE page_id = '".$value."'";
				$this->sql->execute($query);
				$query = "INSERT INTO menu_order (page_id, order_value) VALUES('".$value."', ".$key.")";
				$this->sql->execute($query);
			}
		}
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
		$this->statement->generate($v, "pages");
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
		/*if($user_id != -1) {
			$this->user_id = $user_id;
			$_SESSION['user_id'] = $user_id;
		}*/
		return $user_id;
	}
	
	function _image($v) {
		$this->statement->generate($v, "images");
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
			$description = $row['description'];
			if($this->language != 0) {
				$description = $row['description_2'];
			}
			$results[] = array(
				'id' => $row['id'],
				'image' => $row['id'].$row['extension'],
				'content' => $description
			);	
		}
		return $results;
	}
	
	function get_edit_image($id) {
		$query = "SELECT id, description, description_2 FROM images WHERE id = ".$id;
		return $this->sql->get_row($query, 1);	
	}
	
	function delete_image($id) {
		$query = "DELETE FROM images WHERE id = ".$id;
		$this->sql->execute($query);	
	}
	
	function publications_table($search_term, $offset, $category_id) {
		$query = "SELECT id, publication, created, link  FROM publications WHERE category_id = ".$category_id." ORDER BY created DESC";
		return $this->sql->get_rows($query, 1);	
	}
	
	function publications_list($search_term, $offset, $category_id=-1) {
		$query = "SELECT id, link, publication as content FROM publications"; //%M %d
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
				$rows[$key]['download'] = "<a href='uploads/".$files[0]['id'].$files[0]['extension']."'>".$files[0]['filename']."</a>";
			}
		}
		return $rows;
	}
	
	function publication_categories_table($search_term, $offset) {
		$query = "SELECT id, category_name FROM publication_categories";
		return $this->sql->get_rows($query, 1);	
	}
	
	function publication_categories_options() {
		if($this->language == 0) {
			$query = "SELECT id as id, category_name as value FROM publication_categories WHERE (SELECT COUNT(*) FROM publications WHERE publications.category_id = publication_categories.id) > 0 ORDER BY category_name DESC";
			$rows = $this->sql->get_rows($query, 1);
			
			$rows[] = array('id' => '-1', 'value' => 'By year');
			return array_reverse($rows);
		} else {
			$query = "SELECT id as id, category_name_2 as value FROM publication_categories WHERE (SELECT COUNT(*) FROM publications WHERE publications.category_id = publication_categories.id) > 0 ORDER BY category_name DESC";
			$rows = $this->sql->get_rows($query, 1);
			
			$rows[] = array('id' => '-1', 'value' => 'Eftir ártali');
			return array_reverse($rows);
		}
	}
	
	function get_publication_categorie($id) {
		$query = "SELECT * FROM publication_categories WHERE id = ".$id;
		return $this->sql->get_row($query, 1);	
	}
	
	function get_category_select() {
		$query = "SELECT id, category_name as title FROM publication_categories";	
		return $this->sql->get_rows($query, 1);
	}
	
	function _publication_category($v) {
		$this->statement->generate($v, "publication_categories");
		$this->sql->execute($this->statement->get());
		$id = $this->sql->last_id($v);
		return $id;
	}
	
	function _publication($v) {
		$this->statement->generate($v, "publications");
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
		if($publication_id != -1) {
			$query = "SELECT * FROM publication_files WHERE publication_id = ".$publication_id;
			return $this->sql->get_rows($query, 1);
		} else {
			return array();	
		}
	}
	
	function delete_publication_file($id) {
		$query = "DELETE FROM publication_files WHERE id = ".$id;
		$this->sql->execute($query);	
	}
	
	function _publication_file($v) {
		$this->statement->generate($v, "publication_files");
		$this->sql->execute($this->statement->get());
		$id = $this->sql->last_id($v);
		return $id;
	}
	
	function _news($v) {
		$this->statement->generate($v, "news");
		$this->sql->execute($this->statement->get());
		$id = $this->sql->last_id($v);
		return $id;
	}
	
	function news_table($search_term, $offset) {
		$query = "SELECT id, title FROM news ORDER BY id DESC";
		return $this->sql->get_rows($query, 1);	
	}
	
	function delete_new($id) {
		$query = "DELETE FROM news WHERE id = ".$id;
		$this->sql->execute($query);
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
	
	function news_list($search_term, $offset, $language=NULL) {
		if($language == NULL) {
			$language = $this->language;	
		}
		if($language == 0) {
			$query = "SELECT id, title, content, created FROM news ORDER BY id DESC LIMIT ".($offset+$this->list_start);
		} else {
			$query = "SELECT id, title_2 as title, content_2 as content, created FROM news ORDER BY id DESC LIMIT ".($offset+$this->list_start);
		}
		$rows = $this->sql->get_rows($query, 1);	
		foreach($rows as $key => $row) {
			$query = "SELECT * FROM news_images WHERE news_id = ".$row['id']." ORDER BY id DESC LIMIT 1";
			$image = $this->sql->get_row($query, 1);
			if($image != NULL) {
				$rows[$key]['image'] = $image['id'].$image['extension'];	
			}
		}
		return $rows;
	}
	
	function _news_image($v) {
		$this->statement->generate($v, "news_images");
		$this->sql->execute($this->statement->get());
		$id = $this->sql->last_id($v);
		return $id;
	}
	
	function site_links() {
		$return_value = "";
		$language = "en";
		if($this->language != 0) {
			$language = "lang";	
		}
		$return_value .= '<div class="rss_feed tooltip"><a href="rss_feed.php?language='.$language.'"><i class="icofont-ui-rss"></i></a><span class="tooltiptext">RSS Feed</span></div>';
		
		$query = "SELECT * FROM settings WHERE property = 'facebook'";
		$row = $this->sql->get_row($query, 1);
		if($row != NULL && $row['value'] != "") {
			$return_value .= '<div class="facebook tooltip"><a href="'.$row['value'].'"><i class="icofont-facebook"></i></a><span class="tooltiptext">Facebook</span></div>';
		}
		
		$query = "SELECT * FROM settings WHERE property = 'research_gate'";
		$row = $this->sql->get_row($query, 1);
		if($row != NULL && $row['value'] != "") {
			$return_value .= '<div class="research_gate tooltip"><a href="'.$row['value'].'"><img src="images/researchgate_white.png" width="27px"/></a><span class="tooltiptext">ResearchGate</span></div>';
		}
		
		$query = "SELECT * FROM settings WHERE property = 'orcid'";
		$row = $this->sql->get_row($query, 1);
		if($row != NULL && $row['value'] != "") {
			$return_value .= '<div class="orcid tooltip"><a href="'.$row['value'].'"><img src="images/orcid.png" width="27px"/></a><span class="tooltiptext">ORCID</span></div>';
		}
		return $return_value;
	}
	
	function site_info($language) {
		$result = array();
		
		$appendix = "";
		
		if($language != 0) {
			$appendix = "_2";	
		}
		
		$query = "SELECT * FROM settings WHERE property = 'title".$appendix."'";
		$row = $this->sql->get_row($query, 1);
		
		$result['title'] = $row['value'];
		
		$query = "SELECT * FROM settings WHERE property = 'description".$appendix."'";
		$row = $this->sql->get_row($query, 1);
		
		$result['description'] = $row['value'];
		
		$query = "SELECT * FROM settings WHERE property = 'url'";
		$row = $this->sql->get_row($query, 1);
		
		$result['url'] = $row['value'];
		
		return $result;
	}
	
	function _settings($v) {
		foreach($v as $key => $value) {
			$values = array(
				'property' => $key,
				'value' => $value
			);
			$query = "DELETE FROM settings WHERE property = '".$key."'";
			$this->sql->execute($query);
			$this->statement->generate($values, "settings");
			$this->sql->execute($this->statement->get());
			$id = $this->sql->last_id($values);
		}
	}
	
	function get_settings() {
		$query = "SELECT * FROM settings";
		$rows = $this->sql->get_rows($query, 1);	
		$result = array();
		foreach($rows as $row) {
			$result[$row['property']] = $row['value'];	
		}
		return $result;
	}
	
	function get_state() {
		return array(
			'language' => $this->language
		);	
	}
}

?>