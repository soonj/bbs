<?php include './caches/header_html.php';?>
<body class="clearFix">
    <div class="Top">
        <div class="content">
            <div style="padding-top: 6px;" class="clearFix">
                <div class="top_logo_box fl ">   
                    <a href="{WEB_SITE}/index.php" name="top" title="Alliance">
                        <img src="{DOMAIN_RESOURCE}/imgs/logo.png" border="0" align="default" alt="Alliance" width="94" height="30" />
                    </a>
                </div>   
<!--    搜索框    --> 
                <div class="search fl">
					<form onsubmit="return dispatch()">
						<div class="search_bar">
							<input type="text" maxlength="40" name="q" id="q" value="" />
						</div>
					</form>
				</div>
                
        <!--    头部操作链接  -->          
                <div class="top_login_box fr">
                    <a href="{WEB_SITE}/index.php" class="top">首页</a>
					<?php if(!empty($_COOKIE['username'])):?>
					欢迎你&nbsp;&nbsp;<span class="item_title"><?=$_COOKIE['username'];?></span>&nbsp;&nbsp;
					<a href="{WEB_SITE}/settings.php" class="top">设置</a>
                    <a href="{WEB_SITE}/logout.php" class="top">退出</a>
					
					<?php else: ?>
                    <a href="{WEB_SITE}/signup.php" class="top">注册</a>
                    <a href="{WEB_SITE}/signin.php" class="top">登录</a>
					<?php endif;?>
					
                </div>   
            </div>
        </div>
    </div>
	
    <div id="Wrapper" class="clearFix">
        <div class="content clearFix">
            <div class="Leftbar fl"></div>

            <div class="Main clearFix fl">
                    <div class="sep20"></div>        
                    <div class="box fl clearFix">
					
		<!--  子节点遍历   -->
                        <div class="cell fl" >
                            <a href="/?tab=tech" class="tab">技术</a>
                            <a href="/?tab=creative" class="tab">创意</a>
                        </div>


		<!--主题TITLE遍历-->
        <?php if(!empty($data)):?>
				<?php foreach($data as $value):?>
                        <!--cellList Start-->
                        <div class="cell item fl clearFix" style="">
                            <div class="cell_one fl clearFix">
                                <div class="user_head_icon fl">
                                    <a href="/member/<?=$value['author_name'];?>">
                                        <img src="<?=$value['hicon'];?>" class="avatar" border="0" align="default" />
                                    </a>
                                </div>
                                <span class="item_title fl">
                                    <a href="t.php?post=<?=$value['pid'];?>"><?php  echo substr($value['title'],0,45);?></a>
                                </span>
                                <a class="count_soonj fr" href="t.php?post=<?=$value['pid'];?>"><?=$value['rcount'];?>
                                </a>
                                <div class="sep5"></div>
                                <span class="small fade fl">
                                    <div class="votes"></div>
                                    <a class="node" href="go/<?=$value['nodename'];?>"><?=$value['nodename'];?></a>  
                                    <strong>
                                        <a href="{WEB_SITE}/member.php?q=<?=$value['author_name'];?>"><?=$value['author_name'];?></a>
                                    </strong>  
    								<?php  echo date('Y-m-d H:i:s',$value['ctime']); ?> 
    								<?php if($value['rcount']>0 ):?>
                                        最后回复来自
                                        <a href="{WEB_SITE}/member.php?q=<?=$value['last_name'];?>"><?=$value['last_name'];?></a>
    								<?php endif;?>
                                </span>                                       
                            </div>
                        </div>
				<?php endforeach;?>
        <?php else: ?>

                        <div class="cell item fl clearFix" style="">
                            
                        </div>
        <?php endif;?>
                    <div class="inner fr">
                        &nbsp;&nbsp;
                    </div>
                </div>
            </div>

            <!--Rightbar-->
            <div class="Rightbar fr">
                <div class="sep20"></div>
                <div class="box clearFix">
                    <div class="cell">
                        <strong>ALLiANCE</strong>
                        <div class="sep5"></div>
                        <span class="fade">ALLiANCE 是一个关于分享和探索的地方</span>
                    </div>
		<!--RIGHTBAR 用户按钮.......grant7级为管理员-->			
					<?php if(!empty($_COOKIE['username']) && $_COOKIE['usergrant']==7 ):?>
					<div class="inner fl">
						<a href="{WEB_SITE}/admin/admin_site.php" class="super normal button">走，进入总控制台</a>
					</div>
					<div class="cell fl">
						<a href="{WEB_SITE}/new.php"><img src="{DOMAIN_RESOURCE}/imgs/compose.png" width="32" height="32" border="0"/><span class="item_title">来来，让我发表一个主题</span></a>
					</div>
					<div class="cell fl clearFix">
						<div class="fl" id="money">
						我的钱包：
							<a href="{WEB_SITE}/balance.php" class="balance_area" style="">
								<?=$_SESSION['coin_gold'];?> <img src="{DOMAIN_RESOURCE}/imgs/gold.png" alt="G" align="absmiddle" border="0" />
								<?=$_SESSION['coin_silver'];?> <img src="{DOMAIN_RESOURCE}/imgs/silver.png" alt="S" align="absmiddle" border="0" style="padding-bottom: 2px;" /> 
								<?=$_SESSION['coin_bronze'];?> <img src="{DOMAIN_RESOURCE}/imgs/bronze.png" alt="B" align="absmiddle" border="0" />
							</a>
						</div>
					</div>
					 
					<?php elseif(!empty($_COOKIE['username']) ):?>
					
					<div class="cell fl">
						<a href="{WEB_SITE}/new.php"><img src="{DOMAIN_RESOURCE}/imgs/compose.png" width="32" height="32" border="0"/><span class="item_title">来来，让我发表一个主题</span></a>
					</div>
					<div class="cell fl clearFix">
						<div class="fl" id="money">
						我的钱包：
							<a href="{WEB_SITE}/balance.php" class="balance_area" style="">
								<?=$_SESSION['coin_gold'];?> <img src="{DOMAIN_RESOURCE}/imgs/gold.png" alt="G" align="absmiddle" border="0" />
								<?=$_SESSION['coin_silver'];?> <img src="{DOMAIN_RESOURCE}/imgs/silver.png" alt="S" align="absmiddle" border="0" style="padding-bottom: 2px;" /> 
								<?=$_SESSION['coin_bronze'];?> <img src="{DOMAIN_RESOURCE}/imgs/bronze.png" alt="B" align="absmiddle" border="0" />
							</a>
						</div>
					</div>
					
					<?php else: ?>
					
                    <div class="inner">
                        <div class="sep5"></div>			
                        <div align="center">				
                            <div class="sep5"></div>
                            <div class="sep10"></div>
							<a href="{WEB_SITE}/signup.php" class="super normal button">现在注册</a>
                            <div class="sep5"></div>
                            <div class="sep10"></div>
                            已注册用户请 &nbsp;<a href="{WEB_SITE}/signin.html">登录</a>
                        </div>
                    </div>
					
					<?php endif;?>
					
                </div>

                <div class="sep20"></div>
                <div class="box">
                    <div class="cell">
                        <div class="fr"></div>
                        <span class="fade">节点</span>
                    </div>
					
		<!--                    父节点遍历             -->			
                    <div class="cell">
                        <a href="/go/qna" class="item_node">问与答</a>
                        <a href="/go/share" class="item_node">分享发现</a>
                        <a href="/go/jobs" class="item_node">酷工作</a>
                    </div>
                </div>
            </div>
        </div>

            <!--          RightbarEnd          -->

        <div class="sep20"></div>
        <div class="c"></div>
        <div class="sep20"></div>

    <div id="Bottom">
        <div class="content">
            <div class="inner">
                <div class="sep10"></div>    
                    
                <div class="sep10"></div>
            </div>
        </div>
    </div>
    
</body>
</html>