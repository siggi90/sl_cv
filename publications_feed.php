<?

header("Content-Type: application/rss+xml; charset=ISO-8859-1");
include 'app.php';

$app = new app();


$rss = new rss();

$row = $app->sl_cv->site_info(0);

$rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
$rssfeed .= '<rss version="2.0">';
$rssfeed .= '<channel>';
$rssfeed .= '<title>'.$rss->mb_htmlentities($row['title'], false).'</title>';
$rssfeed .= '<link>'.$row['url'].'</link>';
$rssfeed .= '<description>'.$rss->mb_htmlentities($row['description'], false).'</description>';

$rssfeed .= '<language>en-us</language>';


$url = $row['url'];



$rows = $app->sl_cv->publications_feed();

foreach($rows as $row) {
	$rssfeed .= '<item>';
	//$rssfeed .= '<title>'.mb_htmlentities(trim(substr(strip_tags($row['content']), 0, 35))."...", false).'</title>';
	$rssfeed .= '<title>'.$rss->mb_htmlentities(strip_tags($row['content']), false).'</title>';
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