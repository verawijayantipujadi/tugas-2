<?php
/* koneksi ke db */
mysql_connect("localhost", "root", "qwerty") or die(mysql_error());
mysql_select_db("demo") or die(mysql_error());
/* akhir koneksi db */
 
/* penanganan form */
if (isset($_POST['Input'])) {
	$nim  	= strip_tags($_POST['nim']);
	$nama  	= strip_tags($_POST['nama']);
	$alamat = strip_tags($_POST['alamat']);
	$progdi = strip_tags($_POST['progdi']);
 
	//input ke db
	$query = sprintf("INSERT INTO mahasiswa VALUES('%s', '%s', '%s', '%s')", 
			mysql_escape_string($nim), 
			mysql_escape_string($nama), 
			mysql_escape_string($alamat),
			mysql_escape_string($progdi)
		);
	$sql = mysql_query($query);
	$pesan = "";
	if ($sql) {
		$pesan = "Data berhasil disimpan";
	} else {
		$pesan = "Data gagal disimpan ";
		$pesan .= mysql_error();
	}
	$response = array('pesan'=>$pesan, 'data'=>$_POST);
	echo json_encode($response);
	exit;
}
?>
<html>
	<head>
		<title>Tugas 2</title>
		<style type="text/css">
		.labelfrm {
			display:block;
			font-size:small;
			margin-top:5px;
		}
		.error {
			font-size:small;
			color:red;
		}
		</style>
		<script type="text/javascript" src="libs/jquery.min.js"></script>
		<script type="text/javascript" src="libs/jquery.form.js"></script>
		<script type="text/javascript" src="libs/jquery.validate.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() { 
            //aktifkan ajax di form
            var options = {
				success	  : showResponse,
				beforeSubmit:  function(){
					return $("#frm").valid();
				},
				resetForm : true,
				clearForm : true,
				dataType  : 'json'
			};
			$('#frm').ajaxForm(options); 
 
			//validasi form dgn jquery validate
			$('#frm').validate({
				rules: {
					nim : {
						digits: true,
						minlength:10,
						maxlength:10
					}
				},
				messages: {
					nim: {
						required: "Kolom nim harus diisi",
						minlength: "Kolom nim harus terdiri dari 10 digit",
						maxlength: "Kolom nim harus terdiri dari 10 digit",
						digits: "NIM harus berupa angka"
					},
					nama: {
						required: "Nama harus diisi dengan benar"
					}
				}
			});
        }); 
        function showResponse(responseText, statusText) {
			var data = responseText['data'];
			var pesan = responseText['pesan'];
			alert(pesan);
		}
		</script>
	</head>
	<body>
		<h1>Data Mahasiswa</h1>
		<form action="" method="post" id="frm">
			<label for="nim" class="labelfrm">NIM: </label> 
			<input type="text" name="nim" id="nim" maxlength="20" class="required" size="15"/> 		 
			<label for="nama" class="labelfrm">NAMA: </label> 
			<input type="text" name="nama" id="nama" size="30" class="required"/> 
 
			<label for="alamat" class="labelfrm">ALAMAT: </label> 
			<textarea name="alamat" id="alamat" cols="40" rows="4" class="required"></textarea> 
 
 			<label for="progdi" class="labelfrm">PROGDI: </label> 
			<input type="text" name="progdi" id="progdi" maxlength="30" class="required" size="15"/> 	
 
			<label for="submit" class="labelfrm">&nbsp;</label> 
			<input type="submit" name="Input" value="Input" id="input"/> 
			<input type="submit" name="Edit" value="Edit" id="edit"/> 
			<input type="submit" name="Delete" value="Delete" id="delete"/> 
			<input type="reset" name="Clear" value="Clear" id="clear"/> 
		</form>
	</body>
</html>