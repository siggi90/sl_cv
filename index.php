<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="/icofont.min.css">
<title>Loading</title>
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
		background:rgba(185,32,32,1);
		font-family: 'HelveticaNeue-UltraLight', 'Helvetica Neue UltraLight', 'Helvetica Neue', Arial, Helvetica, sans-serif !important;
	}	
	
	.body_container {
	 	background:  rgb(132, 250, 224);
		background:linear-gradient(30deg, rgba(250,138,54,0.7) 0%, rgba(79, 0, 19, 0.7) 88%);
	}
	
	.secondary_back {
		/*background:linear-gradient(30deg, rgba(250,138,54,0.7) 0%, rgba(0,0,0,0.7) 88%); /*linear-gradient(30deg, rgba(250,138,54,0.7) 0%, rgba(0,7,254,0) 88%);*/
		background:linear-gradient(129deg, rgb(132, 250, 224) 0%, rgb(255, 197, 254) 108%);
		position:fixed;
		top:0px;
		bottom:0px;
		left:0px;
		right:0px;	
	}
	
	.menu_button {
		font-size:20px;	
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
		padding:20px;
		padding-left:0px;
	}
	
	.site_links {
		color:#fff;	
		position: absolute;
		right: 0px;
		top: 90px;
		z-index:9;
	}
	
	.site_links > div {
		float:left;	
		padding-right:30px;
	}
	
	svg {
		fill:teal;	
	}
</style>
</head>

<body>
<!---->
<div class='secondary_back'>
</div>
<div class='body_container blur'><!--blur-->
    <!--<div class='title_wrap'><div class='title'>Streamline</div> <div class='sub_logo'>noob software</div></div>-->
   		<?	include 'user_bar.php'; ?>
        <div class='site_options'>
            <div class='second_language_button'><img src='images/second_language_flag.png' /></div>
            <div class='english_language_button'><img src='images/un_flag.png' /></div>
        </div>
        <div class='site_links'>
            <div class='rss_feed'><i class="icofont-ui-rss" style=''></i><!-- RSS--></div><!--color:#ee802f;-->
            <div class='rss_feed'><i class="icofont-facebook" style=''></i><!-- Facebook--></div>
            <div class='rss_feed'><img src="images/researchgate_white.png" width="27px"/><!-- <span style="top:-3px; position:relative;">ResearchGate</span>--></div>
            <div class='rss_feed'><img src="images/orcid.png" width="27px"/><!-- <span style="top:-3px; position:relative;">ORCID</span>--></div>
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
<div class='calendar_popover' style='display:none;'></div>
<? include 'common.php'; ?>
<div class='dummy_div' style='display:none;'></div>
</body>
</html>