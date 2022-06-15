<div style="float:left;">
<form  onSubmit="return disableForm(this);" action="profilepic.php" method="post" name="f" id="wizecho" enctype="multipart/form-data">
<input type="file" name="file" class="file" onChange="return disableForm(this),ajaxUpload(this.form,'profilepic.php', '&lt;br&gt;Uploading image please wait.....&lt;br&gt;'); return false;"/><input type="hidden" name="uid" value="000">
</form></div>
<p><div id="UPLOAD" style="margin:20px;"></div> </p>
<p align="right"><br/><br/>
<a href="#" onClick="window.location.reload( true );" class="submit">বন্ধ করুন</a></p>