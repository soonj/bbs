﻿<?php include './caches/header_html.php';?>
<body>
		<div id="Wrapper" class="clearFix">
			<div class="sign_div clearFix fl">
				<div class="sep20"></div>        
				<div class="signin_box fl clearFix">
					<div class="cell fl" >
						<strong>欢迎老司机回家</strong>
					</div>	

<!--	登录表单	-->					
					<form action="<?=WEB_SITE;?>/signin.php" method="post">
						<div class="signin fl">
							<div class="signin_bar"> 
								<input type="text" maxlength="40" name="username" id="QAQ" placeholder="用户名" />
							</div>
								
						</div>
						<div class="signin fl">
							<div class="signin_bar"> 
							<input type="password" maxlength="40" name="password" id="QAQ" placeholder="密码" />
							</div>
						</div>
						<div class="signin fl clearFix">
							<div class="signin_bar" style="width:125px"> 
								<input type="text" maxlength="40" name="check_img" id="QAQ" placeholder="验证码" class="fl" style="width:100px"/>
							</div>		
							<img src="<?=WEB_SITE;?>/code.php" class="fr" style="margin-top:2px"/>
							<a href="" class="fr" style="margin-top:10px">看不清？</a>
						</div>
							<div class="signin fl">
								<input type="submit" class="super normal button" value="登录"/>
								<input type="reset" class="super normal button" value="重置"/>
							</div>
						</form>
						<div class="inner fr">
							<a href="<?=WEB_SITE;?>/signup.php">还没账号？&nbsp;现在去注册</a>
						</div>
				</div>       
				
				<div class="Logobar fr">
					<a href="<?=WEB_SITE;?>/index.php" name="top" title="Alliance">
						<img src="<?=DOMAIN_RESOURCE;?>/imgs/logo.png" border="0" align="default" alt="Alliance" width="200" height="65" />
					</a>
				</div>			
			</div>		
		</div>
	</body>
</html>