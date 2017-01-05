<?php include './caches/header_html.php';?>
	<body>
		<div id="Wrapper" class="clearFix">
			<div class="sign_div clearFix fl">
				<div class="sep20"></div>        
				<div class="signin_box fl clearFix">
					<div class="cell fl" >
						<strong><?=$_COOKIE['username'];?></strong>&nbsp;&nbsp;&nbsp;个人信息修改
					</div>						
					<form action="<?=WEB_SITE;?>/settings.php" method="POST" enctype="multipart/form-data">
						<div class="signin fl">
							<div class="signin_bar"> 
							<input type="password" maxlength="40" name="password" id="QAQ" placeholder="原始密码" />
							</div>								
						</div>
						<div class="signin fl">
							<div class="signin_bar"> 
							<input type="password" maxlength="40" name="NewPassword" id="QAQ" placeholder="新密码(若不修改密码留空此处)" />
							</div>
						</div>
						<div class="signin fl">
							<div class="signin_bar"> 
							<input type="password" maxlength="40" name="reNewPassword" id="QAQ" placeholder="确认新密码" />
							</div>
						</div>

<!--头像设置-->
						<div class="Rightbar fl clearFix">
							<div class="box" style="margin-left:10px;">
								<div class="cell fl">
									<span class="item_title fl">当前头像</span>
									<div class="sep10"></div>
									<img src="<?=$result[0]['hicon'];;?>" class="avatar fl" border="1" align="left" />
								</div>	
								<div class="cell fl">	
									<span class="item_title">选择新头像</span>
									<div class="sep10"></div>
									<input type="file"  name="newHicon" />
								</div>
								
		<!--签名设置-->
								<div class="cell fl">
									<span class="item_title">我的签名</span>
									<div class="sep10"></div>
									<textarea name="gragh" maxlength="200" cols="30" rows="3"></textarea>
								</div>
		<!--信息设置-->						
								<div class="cell fl">
									<span class="item_title">个人信息</span>
									<div class="sep10"></div>
									<textarea name="info" maxlength="200" cols="30" rows="3"></textarea>
								</div>

								<div class="signin fl">
									<input type="submit" class="super normal button" value="提交"/>&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="reset" class="super normal button" value="重置"/>
									
								</div>
							</div>	
						</div>
						</form>
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