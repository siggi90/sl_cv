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
	
</style>
</head>

<body>
<!---->
<div class='secondary_back'>
</div>
<div class='body_container blur'><!--blur-->
    <!--<div class='title_wrap'><div class='title'>Streamline</div> <div class='sub_logo'>noob software</div></div>-->
   		<?	include 'user_bar.php'; ?>
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