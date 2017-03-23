<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("menutitle","网站首页"); ?><?php $this->output("head","file"); ?>
<div role="main" class="ui-content">
	<?php $list = phpok('picplayer');?>
	
	<div class="home_banner" id="home_banner">
		<ul class="pro_ul">
			<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] AS $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
			<?php $height = ($value['pic'] && $value['pic']['attr'] && $value['pic']['attr']['width']) ? intval(($value['pic']['attr']['height'] * 310)/$value['pic']['attr']['width']) : 0;?>
			<li><a href="<?php echo $value['link'];?>" target="<?php echo $value['target'];?>" title="<?php echo $value['title'];?>"><img src="images/blank.gif" alt="<?php echo $value['title'];?>" _src="<?php echo $value['pic']['gd']['auto'];?>"<?php if($height){ ?> height="<?php echo $height;?>"<?php } ?> /></a></li>
			<?php } ?>
		</ul>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		TouchSlide({
			slideCell:"#home_banner",
			mainCell:".pro_ul", 
			effect:"leftLoop",
			autoPlay:true,
			switchLoad:"_src"
		});
	});
	</script>
	<?php $arc = phpok('aboutus');?>
	<div class="ui-body ui-body-a ui-corner-all" onclick="$.phpok.go('<?php echo $arc['url'];?>')" style="margin-bottom:5px;">
		<h3><?php echo $arc['title'];?></h3>
		<div class="content"><img src="<?php echo $arc['pic'];?>" width="80" align="left" style="margin:5px 5px 0 0;" /><?php echo $arc['note'];?></div>
	</div>
	<?php $list = phpok('new_products');?>
	<ul class="pictures">
		<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] AS $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
		<li><a href="<?php echo $value['url'];?>"><img src="<?php echo $value['thumb']['gd']['thumb'];?>" alt="<?php echo $value['title'];?>" width="150" border="0" /><br /><?php echo $value['m_title'];?></a></li>
		<?php } ?>
	</ul>
	<div class="clear"></div>
	<?php $list = phpok('news','psize=5');?>
	<ul data-role="listview" data-inset="true" style="margin-top:5px;">
		<li data-role="list-divider" data-theme="b"><h1><?php echo $list['project']['title'];?></h1></li>
		<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] AS $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
		<li><a href="<?php echo $value['url'];?>"><?php echo $value['title'];?></a></li>
		<?php } ?>
	</ul>
</div>
<?php $this->output("foot","file"); ?>