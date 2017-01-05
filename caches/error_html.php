<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>error</title>
    <link rel="stylesheet" type="text/css" href="<?=DOMAIN_RESOURCE;?>/css/base.css" />
	<link rel="stylesheet" type="text/css" href="<?=DOMAIN_RESOURCE;?>/css/mycss.css" />
	<link href="<?=DOMAIN_RESOURCE;?>/imgs/photo.png" rel="shortcut icon"/>

</head>
	<body>
		<div id="Wrapper" class="clearFix">
			<div class="sign_div clearFix fl">
				<div class="sep20"></div>        
				<div class="signin_box fl clearFix">
					<div class="cell fl" >
						<strong><?=$content;?></strong><br / >
						<a href="<?=$_SERVER['HTTP_REFERER'];?>">点击返回</a>
					</div>						
				</div>           		
			</div>		
		</div>
	</body>
</html>

