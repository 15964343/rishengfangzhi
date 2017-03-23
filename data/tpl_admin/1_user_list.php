<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<script type="text/javascript" src="<?php echo add_js('user.js');?>"></script>
<div class="tips">
	<table width="100%" cellpadding="0" cellspacing="0" height="100%">
	<tr>
		<td>&raquo; <?php echo P_Lang("会员列表");?></td>
		<td>
			<table>
			<tr>
				<form method="post" action="<?php echo admin_url('user');?>">
				<td><input type="text" id="keywords" name="keywords" value="<?php echo $keywords;?>" /></td>
				<td><input type="submit" value="<?php echo P_Lang("搜索");?>" class="submit" /></td>
				</form>
			</tr>
			</table>
		</td>
		<td align="right"><div class="action"><a href="<?php echo admin_url('user','set');?>"><?php echo P_Lang("添加会员");?></a></div></div>
	</tr>
	</table>
</div>
<div class="list">
<table width="100%" class="list" cellpadding="0" cellspacing="0">
<tr>
	<th width="50px">ID</th>
	<th width="35px">&nbsp;</th>
	<th width="35px"></th>
	<?php $arealist_id["num"] = 0;$arealist=is_array($arealist) ? $arealist : array();$arealist_id["total"] = count($arealist);$arealist_id["index"] = -1;foreach($arealist AS $key=>$value){ $arealist_id["num"]++;$arealist_id["index"]++; ?>
	<th class="lft"><?php echo P_Lang($value);?></th>
	<?php } ?>
	<?php $tmpid["num"] = 0;$wlist=is_array($wlist) ? $wlist : array();$tmpid["total"] = count($wlist);$tmpid["index"] = -1;foreach($wlist AS $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
	<th class="lft" style="min-width:100px;"><?php echo $value['title'];?></th>
	<?php } ?>
	<th width="130px"><?php echo P_Lang("注册时间");?></th>
	<th width="100px"></th>
</tr>
<?php $rslist_id["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$rslist_id["total"] = count($rslist);$rslist_id["index"] = -1;foreach($rslist AS $key=>$value){ $rslist_id["num"]++;$rslist_id["index"]++; ?>
<tr>
	<td align="center"><?php echo $value['id'];?></td>
	<td><span id="status_<?php echo $value['id'];?>" onclick="set_status(<?php echo $value['id'];?>)" class="status<?php echo $value['status'];?>" value="<?php echo $value['status'];?>"></span></td>
	<td align="center"><img src="<?php echo $value['avatar'] ? $value['avatar'] : 'images/user_default.png';?>" border="0" width="24px" height="24px" /></td>
	<?php $arealist_id["num"] = 0;$arealist=is_array($arealist) ? $arealist : array();$arealist_id["total"] = count($arealist);$arealist_id["index"] = -1;foreach($arealist AS $k=>$v){ $arealist_id["num"]++;$arealist_id["index"]++; ?>
	<td align="left">
		<?php if(is_array($value[$k])){ ?>
			<?php if($value[$k]['_admin']['type'] == 'pic'){ ?>
			<img src='<?php echo $value[$k]["_admin"]["info"];?>' border="0" width="28px" height="28px" />
			<?php } else { ?>
			<?php echo $value[$k]['_admin']['info'];?>			
			<?php } ?>
		<?php } else { ?>
			<?php if($k == 'group_id'){ ?>
			<?php echo $grouplist[$value[$k]]['title'];?>
			<?php } else { ?>
			<?php echo $value[$k];?>
			<?php } ?>
		<?php } ?>
	</td>
	<?php } ?>
	<?php $wlist_id["num"] = 0;$wlist=is_array($wlist) ? $wlist : array();$wlist_id["total"] = count($wlist);$wlist_id["index"] = -1;foreach($wlist AS $k=>$v){ $wlist_id["num"]++;$wlist_id["index"]++; ?>
	<td class="lft">
		<?php echo $value['wealth'][$k] ? $value['wealth'][$k] : 0;?><?php echo $v['unit'];?>
		<a onclick="action_wealth('<?php echo $v['title'];?>','<?php echo $v['id'];?>','<?php echo $value['id'];?>','<?php echo $v['unit'];?>')" class="ico go" title="调整"></a>
		<a class="ico page" onclick="show_wealth_log('<?php echo $v['title'];?>','<?php echo $v['id'];?>','<?php echo $value['id'];?>')" title="<?php echo P_Lang("查看日志");?>"></a>
	</td>
	<?php } ?>
	<td><?php echo date('Y-m-d H:i',$value['regtime']);?></td>
	<td>
		<div class="button-group">
			<input type="button" value="<?php echo P_Lang("编辑");?>" onclick="$.phpok.go('<?php echo phpok_url(array('ctrl'=>'user','func'=>'set','id'=>$value['id']));?>')" class="phpok-btn" />
			<input type="button" value="<?php echo P_Lang("删除");?>" onclick="del(<?php echo $value['id'];?>,'<?php echo $value['user'];?>')" class="phpok-btn" />
		</div>
	</td>
</tr>
<?php } ?>
</table>
</div>
<?php if($pagelist){ ?><div class="table"><?php $this->output("pagelist","file"); ?></div><?php } ?>
<?php $this->output("foot","file"); ?>