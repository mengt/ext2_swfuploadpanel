<?php
	session_start();
	$_SESSION['test'] = 'cool. same session.';
?>
<!--DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/loose.dtd"-->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Ext.ux.SwfUploadPanel Example</title>
<link rel="stylesheet" type="text/css" href="../../resources/css/ext-all.css" />
<script type="text/javascript" src="../../adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="../../ext-all.js"></script>
<!-- Files needed for SwfUploaderPanel -->
<link rel="stylesheet" type="text/css" href="SwfUploadPanel.css" />
<script type="text/javascript" src="SwfUpload.js"></script>
<script type="text/javascript" src="SwfUploadPanel.js"></script>
<script type="text/javascript">
if(!console) var console = {
    log: function() {}
}
Ext.onReady(function() {		

	String.prototype.trim = function() {
		return this.replace(/^\s+|\s+$/g,"");
	}

	// Get SessionId from cookie
	var PHPSESSIDX = null;
	var cookies = document.cookie.split(";");
	Ext.each(cookies, function(cookie) {
		var nvp = cookie.split("=");
		if (nvp[0].trim() == 'PHPSESSID')
			PHPSESSIDX = nvp[1];
	});
	
	var uploader = new Ext.ux.SwfUploadPanel({
			title: 'Upload Test'
		, renderTo: 'grid'
		, width: 500
		, height: 300

		// Uploader Params				
		, upload_url: 'upload_example.php'
//				, upload_url: 'http://localhost/www.silverbiology.com/ext/plugins/SwfUploadPanel/upload_example.php'
		, post_params: { PHPSESSIDX: PHPSESSIDX }
<?php
if (isset($_REQUEST[debug])) print ", debug: true";
?>				
		, flash_url: "swfupload.swf"
//				, single_select: true // Select only one file from the FileDialog

		// Custom Params
		, single_file_select: false // Set to true if you only want to select one file from the FileDialog.
		, confirm_delete: false // This will prompt for removing files from queue.
		, remove_completed: false // Remove file from grid after uploaded.
	});

	uploader.on('swfUploadLoaded', function() { 
		this.addPostParam( 'Post1', 'example1' );
	});
	
	uploader.on('fileUploadComplete', function(panel, file, response) {
	});
	
	uploader.on('queueUploadComplete', function() {
		if ( Ext.isGecko ) {
			console.log("Files Finished");
		} else {
			alert("Files Finished");
		}
	});
				
	
	var btn = new Ext.Button({
			text: 'Launch Sample Uploader'
		, renderTo: 'btn'
		, handler: function() {

				var dlg = new Ext.ux.SwfUploadPanel({
						title: 'Dialog Sample'
					, width: 500
					, height: 300
					, border: false
	
					// Uploader Params				
					, upload_url: 'upload_example.php'
//							, upload_url: 'http://localhost/www.silverbiology.com/ext/plugins/SwfUploadPanel/upload_example.php'
					, post_params: { id: 123}
					, file_types: '*.jpg'
					, file_types_description: 'Image Files'
	<?php
			if (isset($_REQUEST[debug])) print ", debug: true";
	?>				
					, flash_url: "swfupload.swf"
	//				, single_select: true // Select only one file from the FileDialog
	
					// Custom Params
					, single_file_select: false // Set to true if you only want to select one file from the FileDialog.
					, confirm_delete: false // This will prompt for removing files from queue.
					, remove_completed: true // Remove file from grid after uploaded.
				}); // End Dialog

				var win = new Ext.Window({
						title: 'Window'
					, width: 514
					, height: 330
					, resizable: false
					, items: [ dlg ]
				}); // End Window
						
				win.show();
			
			} // End Btn Handler
						
		}); // end Btn
});
</script>
<style type="text/css">
<!--
.style1 {
	font-weight: bold
}
body, td, th {
	font-family: Arial, Helvetica, sans-serif;
}
body {
	margin-left: 5px;
	margin-top: 5px;
	margin-right: 5px;
	margin-bottom: 5px;
}
.style3 {font-size: 10px; font-style: italic;}
#PageSignature {border-right: #e5e5e5 1px solid; padding-right: 10px; border-top: #e5e5e5 1px solid; padding-left: 60px; background: url(http://extjs.org.cn/misc/warning.png) #fffefe no-repeat 1% 50%; padding-bottom: 10px; border-left: #e5e5e5 1px solid; padding-top: 10px; border-bottom: #e5e5e5 1px solid
}
-->
</style>
</head>
<body>
<span class="style1">ExtJS Extension</span> (多文件上传)
<br/>
<br/>
LastModified: March 10th 2009

修改正了flash player10 版本安全性提高后,不能上传文件的错误.
<br>
<br>
<div id="PageSignature">译者：肥占<br>
      出处：<a 
href="http://extjs.org.cn">http://extjs.org.cn</a> <br>
本文版权归作者和ExtJs中文站共有，欢迎转载，但未经作者同意必须保留此段声明，且在文章页面明显位置给出原文连接。</div>
<br>
<div id="grid" style="width:400px;"></div>
<br>
<div id="btn"></div>

</body>
</html>
