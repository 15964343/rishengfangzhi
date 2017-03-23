<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title",$page_rs['title']); ?><?php $this->assign("menutitle",$page_rs['title']); ?><?php $this->output("head","file"); ?>
<div data-role="navbar">
	<ul>
		<?php $list=phpok('_arclist',array('pid'=>$page_rs['id'],'psize'=>"9999",'fields'=>"id"));?>
		<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] AS $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
		<li><a href="<?php echo $value['url'];?>"<?php if($rs['id'] == $value['id']){ ?> class="ui-btn-active"<?php } ?>><?php echo $value['title'];?></a></li>
		<?php } ?>
	</ul>
</div>
<div role="main" class="ui-content">
	<div class="ui-body ui-body-a ui-corner-all">
		<h3><?php echo $rs['title'];?></h3>
		<div class="content"><?php echo $rs['content'];?></div>
	</div>
</div>

<?php $this->output("foot","file"); ?>