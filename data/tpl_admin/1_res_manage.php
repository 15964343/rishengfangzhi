<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<script type="text/javascript">
function save()
{
	var obj = art.dialog.opener;
	$("#editopen").ajaxSubmit({
		'url':get_url('upload','editopen_save','id=<?php echo $rs['id'];?>'),
		'type':'post',
		'dataType':'json',
		'success':function(rs){
			if(rs.status == 'ok'){
				$.dialog.alert('附件信息修改成功',function(){
					obj.$.phpok.reload();
				},'succeed');
			}else{
				$.dialog.alert(rs.content);
				return false;
			}
		}
	});
}
function download_it(id)
{
	var url = get_url("res","download") + "&id="+id;
	$.phpok.go(url);
}
</script>

<form method="post" id="editopen" onsubmit="return false;">
<input type="hidden" id="id" name="id" value="<?php echo $rs['id'];?>" />
<div class="table">
	<div class="title">
		附件名称：
		<span class="note">设置附件的名称，以方便管理</span>
	</div>
	<div class="content">
		<input type="text" id="title" name="title" class="default" value="<?php echo $rs['title'];?>" />
		<input type="button" value="下载" onclick="download_it('<?php echo $rs['id'];?>')" class="btn" />
	</div>
</div>

<div class="table">
	<div class="title">
		覆盖上传文件：
		<span class="note">使用此功能将直接覆盖上传原来附件信息，请慎用，仅限上传 <span class="red b"><?php echo $rs['ext'];?></span> 附件</span>
	</div>
	<div class="content"><div id="upload_picker"></div></div>
</div>

<div class="table">
	<div class="content" id="upload_progress"></div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	obj_upload = new $.admin_upload({
		"multiple"	: 'false',
		"id" : "upload",
		'pick':{'id':'#upload_picker','multiple':false},
		'resize':false,
		"swf" : "js/webuploader/uploader.swf",
		"server": "<?php echo phpok_url(array('ctrl'=>'upload','func'=>'replace','oldid'=>$rs['id']));?>",
		"filetypes" : "<?php echo $rs['ext'];?>",
		'accept' : {'title':'附件','extensions':'<?php echo $rs['ext'];?>'},
		"formData" :{'<?php echo session_name();?>':'<?php echo session_id();?>'},
		'fileVal':'upfile',
		'auto':true,
		"success":function(){
			$.phpok.reload();
		}
	});
});
</script>

<div class="table">
	<div class="title">
		附件上传时间：
		<span class="note">不支持修改，上传后自动生成</span>
	</div>
	<div class="content">
		<input type="text" id="addtime" name="addtime" value="<?php echo date('Y-m-d H:i:s',$rs['addtime']);?>" disabled />
	</div>
</div>

<?php if($rs['attr'] && $rs['attr']['width'] && $rs['attr']['height']){ ?>
<div class="table">
	<div class="title">
		附件宽高：
		<span class="note">此参数不允许人工修改，系统自动读取</span>
	</div>
	<div class="content">
		<input type="text" disabled name="attr[width]" value="<?php echo $rs['attr']['width'];?>" class="short" /> &#215; <input type="text" disabled name="attr[height]" value="<?php echo $rs['attr']['height'];?>" class="short" />
	</div>
</div>
<?php } ?>

<div class="table">
	<div class="title">
		附件说明：
		<span class="note">如需对此附件进行说明，可在这里编写</span>
	</div>
	<div class="content"><?php echo $content;?></div>
</div>

</form>
<?php $this->output("foot_open","file"); ?>