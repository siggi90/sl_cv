<?

header("Content-Type: application/rss+xml; charset=ISO-8859-1");
include 'app.php';

$app = new app();

$language = "en";
if(isset($_GET['language'])) {
	$language = strtolower($_GET['language']);
}

$rss = new rss();

if($language == "en") {
	$language = 0;	
} else {
	$language = 1;
}


$row = $app->sl_cv->site_info($language);

$rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
$rssfeed .= '<rss version="2.0">';
$rssfeed .= '<channel>';
$rssfeed .= '<title>'.$rss->mb_htmlentities($row['title'], false).'</title>';
$rssfeed .= '<link>'.$row['url'].'</link>';
$rssfeed .= '<description>'.$rss->mb_htmlentities($row['description'], false).'</description>';
if($language == 0) {
	$rssfeed .= '<language>en-us</language>';
}

$url = $row['url'];
//$rssfeed .= '<copyright>Copyright (C) 2009 mywebsite.com</copyright>';



$rows = $app->sl_cv->news_list(NULL, NULL, $language);

foreach($rows as $row) {
	$rssfeed .= '<item>';
	$rssfeed .= '<title>'.$rss->mb_htmlentities(strip_tags($row['title']), false).'</title>';
	$rssfeed .= '<description>'.$rss->mb_htmlentities(strip_tags($row['content']), false).'</description>';
	$link = $url;
	if(isset($row['link']) && $row['link'] != NULL && $row['link'] != "") {
		$link = $row['link'];	
	}
	$rssfeed .= '<link>'.$link. '</link>';
	$rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($row['created'])) . '</pubDate>';
	$rssfeed .= '</item>';
}

$rssfeed .= '</channel>';
$rssfeed .= '</rss>';

echo $rssfeed;