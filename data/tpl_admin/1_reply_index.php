<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title","评论管理"); ?><?php $this->output("head","file"); ?>

<script type="text/javascript">
function subsearch()
{
	var url = get_url("reply");
	var status = $("#status").val();
	if(status>0)
	{
		url += "&status="+status;
	}
	var keywords = $("#keywords").val();
	if(keywords)
	{
		url += "&keywords="+$.str.encode(keywords);
	}
	direct(url);
}
function to_view(id,title)
{
	var url = get_url("reply","list","tid="+id);
	$.dialog.open(url,{
		'title':'<?php echo P_Lang("评论：");?>'+title,
		'lock':true,
		'width':'90%',
		'height':'90%',
		'cancel':function(){return true;}
	});
}
</script>
<div class="tips" id="tips">
	<table cellpadding="0" cellspacing="0" height="100%" width="100%">
	<tr>
		<td>您当前的位置：<a href="<?php echo admin_url('reply');?>" title="内容管理">评论管理</a></td>
		<td align="right">
			搜索：
			<select name="status" id="status">
				<option value="0">全部</option>
				<option value="1"<?php if($status == 1){ ?> selected<?php } ?>>已审核</option>
				<option value="2"<?php if($status && $status != 1){ ?> selected<?php } ?>>未审核</option>
			</select>
			<input type="text" name="keywords" id="keywords" value="<?php echo $keywords;?>" style="margin-top:3px;" />
			<input type="button" value="搜索" class="btn" onclick="subsearch();" />
		</td>
		<td>&nbsp;</td>
	</tr>
	</table>
</div>

<div class="list">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<th width="20px">&nbsp;</th>
	<th class="lft">主题</th>
	<th>未审核</th>
	<th>已审核</th>
	<th>最后回复时间</th>
	<th>操作</th>
</tr>
<?php $rslist_id["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$rslist_id["total"] = count($rslist);$rslist_id["index"] = -1;foreach($rslist AS $key=>$value){ $rslist_id["num"]++;$rslist_id["index"]++; ?>
<tr>
	<td class="center"><input type="checkbox" name="ids[]" id="id_<?php echo $value['id'];?>" value="<?php echo $value['id'];?>" checked /></td>
	<td><?php echo $value['title'];?></td>
	<td class="red center"><?php echo $value['uncheck'];?></td>
	<td class="center"><?php echo $value['checked'];?></td>
	<td class="center"><?php echo date('Y年m月d日H时i分',$value['replydate']);?></td>
	<td class="center">
		<input type="button" value="查看" class="btn" onclick="to_view(<?php echo $value['id'];?>,'<?php echo $value['title'];?>')" />
	</td>
</tr>
<?php } ?>
</table>
</div>
<?php if($pagelist){ ?><div class="table"><?php $this->output("pagelist","file"); ?></div><?php } ?>

<?php $this->output("foot","file"); ?>