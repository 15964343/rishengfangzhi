<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?>	</div>
	<div data-role="footer" data-position="fixed" style="padding-bottom:0;">
		<div data-role="navbar" class="ui-body-a" data-overlay-theme="a">
		<ul>
			<li><a href="<?php echo $sys['url'];?>" data-icon="home"<?php if($sys['ctrl'] == 'index'){ ?> data-theme="b"<?php } ?>>首页</a></li>
			<li><a href="<?php echo phpok_url(array('id'=>'aboutus'));?>" data-icon="info"<?php if($sys['ctrl'] == 'content' && $page_rs['identifier'] == 'about'){ ?> data-theme="b"<?php } ?>>关于</a></li>
			<li><a href="<?php echo phpok_url(array('ctrl'=>'post','id'=>'book'));?>" data-icon="edit"<?php if($sys['ctrl'] == 'post' && $page_rs['identifier'] == 'book'){ ?> data-theme="b"<?php } ?>>留言</a></li>
			<li><a href="javascript:void(0);" onclick="kfonline()" data-icon="phone" id="kfonline-btn">客服</a></li>
			<li><a href="<?php if($session['user_id']){ ?><?php echo phpok_url(array('ctrl'=>'usercp'));?><?php } else { ?><?php echo phpok_url(array('ctrl'=>'login'));?><?php } ?>" data-icon="user"<?php if($sys['ctrl'] == 'usercp' || $sys['ctrl'] == 'order'){ ?>  data-theme="b"<?php } ?>>会员</a></li>
		</ul>
		</div>
	</div>
	<div id="popupkf" style="display:none;">
		<?php $list = phpok('kefu');?>
		<ul class="kfonline">
			<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] AS $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
			<li class="qq"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $value['qq'];?>&site=qq&menu=yes" target="_blank"><?php echo $value['title'];?>（<?php echo $value['qq'];?>）</a></li>
			<?php } ?>
			<?php $list = phpok('contactus');?>
			<?php if($list && $list['tel']){ ?>
			<li class="phone"><a href="tel:<?php echo $list['tel'];?>">客服电话：<?php echo $list['tel'];?></a></li>
			<?php } ?>
		</ul>
	</div>
</div>
<script type="text/javascript" src="tpl/www_mobile/js/global.js"></script>
<?php echo $app->plugin_html_ap("phpokbody");?></body>
</html>