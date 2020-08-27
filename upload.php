<?
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && $_SESSION['user_id'] != "-1") {
	 
	$name     = $_FILES['file']['name'];
	$tmpName  = $_FILES['file']['tmp_name'];
	$error    = $_FILES['file']['error'];
	$size     = $_FILES['file']['size'];
	$ext      = strtolower(pathinfo($name, PATHINFO_EXTENSION));
   
	switch ($error) {
		case UPLOAD_ERR_OK:
			$valid = true;
			//validate file extensions
			/*if ( !in_array($ext, array('jpg','jpeg','png','gif')) ) {
				$valid = false;
				$response = 'Invalid file extension.';
			}*/
			//validate file size
			/*if ( $size/1024/1024 > 2 ) {
				$valid = false;
				$response = 'File size is exceeding maximum allowed size.';
			}*/
			//upload file
			if ($valid) {
				
				$name_rev = strrev($name);
				$extension = strpos($name_rev, ".");
				$name_rev = substr($name_rev, 0, $extension);
				$extension = ".".strrev($name_rev);
				
				include 'app.php';
				$app = new app();
				
				if($_GET['action'] == "images") {
					$name = $app->sl_cv->_image(array(
						'description' => $name,
						'extension' => $extension
					));
				} else if($_GET['action'] == "news") {
					$name = $app->sl_cv->_news_image(array(
						'filename' => $name,
						'extension' => $extension,
						'news_id' => $_GET['news_id']
					));	
				} else if($_GET['action'] == "publication") {					
					$name = $app->sl_cv->_publication_file(array(
						'filename' => $name,
						'extension' => $extension,
						'publication_id' => $_GET['publication_id']
					));		
				}
				$name .= $extension;
				
				$targetPath =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'uploads' . DIRECTORY_SEPARATOR. $name;
				move_uploaded_file($tmpName,$targetPath);
				//header( 'Location: index.php' ) ;
				exit;
			}
			break;
		case UPLOAD_ERR_INI_SIZE:
			$response = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
			break;
		case UPLOAD_ERR_FORM_SIZE:
			$response = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
			break;
		case UPLOAD_ERR_PARTIAL:
			$response = 'The uploaded file was only partially uploaded.';
			break;
		case UPLOAD_ERR_NO_FILE:
			$response = 'No file was uploaded.';
			break;
		case UPLOAD_ERR_NO_TMP_DIR:
			$response = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
			break;
		case UPLOAD_ERR_CANT_WRITE:
			$response = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
			break;
		case UPLOAD_ERR_EXTENSION:
			$response = 'File upload stopped by extension. Introduced in PHP 5.2.0.';
			break;
		default:
			$response = 'Unknown error';
		break;
	}

	echo $response;
}
?>