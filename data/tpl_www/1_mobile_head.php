<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php echo tpl_head(array('title'=>$title,'css'=>"tpl/www_mobile/css/jquery.mobile.css,tpl/www_mobile/css/style.css,artdialog.css",'js'=>"tpl/www_mobile/js/jquery.mobile.js",'html5'=>"true",'close'=>"false",'mobile'=>"true"));?>
<?php echo $app->plugin_html_ap("phpokhead");?></head>
<body>
<div data-role="page" id="page">
	<div data-role="panel" id="menu" data-position="right" data-display="overlay">
		<ul data-role="listview" data-icon="false">
			<?php $list = phpok('menu');?>
			<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] AS $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
			<li><a href="<?php echo $value['url'];?>" target="<?php echo $value['target'];?>" title="<?php echo $value['title'];?>"<?php if($menutitle == $value['title']){ ?> style="color:darkblue;"<?php } ?>><?php echo $value['title'];?></a>
			</li>
			<?php } ?>
		</ul>
	</div>
<div data-role="header" data-position="fixed">
	<h1><?php echo $title ? $title : $config['title'];?></h1>
	<a href="<?php echo phpok_url(array('ctrl'=>'cart'));?>" class="ui-btn ui-corner-all ui-shadow ui-icon-cart ui-btn-icon-left ui-btn-icon-notext" id="head_cart_num"></a>
	<a href="#menu" class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-bars  ui-btn-icon-notext">菜单</a>
</div>
<div dat-role="content" id="body-content">