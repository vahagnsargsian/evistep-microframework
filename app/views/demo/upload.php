<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<center>
<div style="width:300px; height:300px; border: solid #7A7A40 3px; background-color:#D0D0AE;">
<h1>Upload File</h1>

<form action="index/upload/" method="post" enctype="multipart/form-data">

	<input type='text' name="desc" placeholder="Description of file" style="padding:5px; "><br><br>

	<label for="file" style="background-color:#D0D06A !important; padding: 5px;">File: 
		<input type="file" name="file" id="file" />
	</label>
	<br><br>

	<input type="submit" value="Upload" style="background-color: white !important;" />	

</form>
</div>
</center>
</body>
</html>