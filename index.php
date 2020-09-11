<?
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="/icofont.min.css">
<title></title>
<link rel="alternate" type="application/rss+xml" 
  title="RSS Feed" 
  href="rss_feed.php?lang=en" />
<script type='text/javascript' src='/jquery.js'></script>
<script type='text/javascript' src='/jquery-ui.min.js'></script>
<script type='text/javascript' src='app.js'></script>
<script type='text/javascript' src='/dropzone/dropzone.js'></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<style type='text/css'>
	@import "/css/base.css";
	@import "/dropzone/basic.css";
	@import "/dropzone/dropzone.css";
	
	
	body { /*green*/
		/*background: url('/images/rancrypt_back_2.png');*/
		/*background-position:left;*/
		/*background-position:25% 10%;
		/*background-size:150%;*/
		word-wrap: break-word;
		/*background: url('/images/green.png');*/
		background:rgba(0,0,0,1);
		font-family: 'HelveticaNeue-UltraLight', 'Helvetica Neue UltraLight', 'Helvetica Neue', Arial, Helvetica, sans-serif !important;
	}	
	
	p, span {
		font-family: 'HelveticaNeue-UltraLight', 'Helvetica Neue UltraLight', 'Helvetica Neue', Arial, Helvetica, sans-serif !important;
	}
	
	.body_container {
	 	background:  rgb(132, 250, 224);
		/*background:linear-gradient(30deg, rgba(250,138,54,0.7) 0%, rgba(79, 0, 19, 0.7) 88%);*/
		background:linear-gradient(30deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.7) 88%);
	}
	
	.secondary_back {
		/*background:linear-gradient(30deg, rgba(250,138,54,0.7) 0%, rgba(0,0,0,0.7) 88%); /*linear-gradient(30deg, rgba(250,138,54,0.7) 0%, rgba(0,7,254,0) 88%);*/
		/*background:linear-gradient(129deg, rgb(132, 250, 224) 0%, rgb(255, 197, 254) 108%);*/
		background:linear-gradient(129deg, rgb(91, 42, 12) 0%, rgb(255, 197, 254) 108%);
		position:fixed;
		top:0px;
		bottom:0px;
		left:0px;
		right:0px;	
	}
	
	.menu_button {
		font-size:20px;	
	}
	
	
	.content.list_element > p {
		margin:5px;
	}
	
	.content.list_element {
		padding-bottom:5px;	
	}
		
	.content.list_element p {
		margin:0px;	
		padding:0px;
	}
	
	.content.list_element span {
		margin:0px;	
		padding:0px;
	}
	
	
	.main_title {
		padding:50px;
		margin-bottom:0px !important;	
		z-index:1;
	}
	
	.logo {
		width: 120px;
		height:120px;
		background-size: cover;	
		margin-left: 120px;
	}
	
	.site_options {
		position:absolute;
		right:0px;	
		z-index:9;	
	}
	
	.site_options > div {
		float:left;
	}
	
	.site_options img {
		width:45px;
	}
	
	.site_options > div {
		margin:20px;
		margin-left:0px;	
	}
	
	.site_links {
		color:#fff;	
		position: absolute;
		right: 0px;
		top: 130px;
		z-index:9;
	}
	
	.site_links > div {
		float:left;	
		padding-right:30px;
	}
	
	svg {
		fill:teal;	
	}
	
	.department_container {
		margin-top: 25px;
		float: left;
		position: absolute;
		z-index: 999;
	}
	
	.department_container > a > img {
		width:130px;
		margin-top:25px;
		margin-left:5px;
	}
</style>
</head>

<body>
<!---->
<div class='secondary_back'>
</div>
<div class='body_container blur'><!--blur-->
    <!--<div class='title_wrap'><div class='title'>Streamline</div> <div class='sub_logo'>noob software</div></div>-->
    	<div class='department_container'>
            <?
				if(!isset($_SESSION['language']) || $_SESSION['language'] == 0) {
					echo "<a href='https://english.hi.is/faculty_of_social_work'>";
				} else {
					echo "<a href='https://www.hi.is/felagsradgjafardeild'>";
				}
			?>
            <img style="" src='images/dep.png' />
            </a>
        </div>
            
   		<?	include 'user_bar.php'; ?>
        <div class='site_options'>
            <div class='second_language_button'><img src='images/second_language_flag.png' /></div>
            <div class='english_language_button'><img src='images/un_flag.png' /></div>
            
        </div>
        <div class='site_links'>
        </div>
        <div class='body_wrap'>
            <div id='body_frame' class='frame'>
            
            </div>
            <!--<div class='menu_top'>
                <div class='menu_button'>Articles</div>
                <div class='menu_button'>New Article</div>
            </div>-->
        </div>	
</div>
<? include 'common.php'; ?>
<div class='dummy_div' style='display:none;'></div>
</body>
</html>