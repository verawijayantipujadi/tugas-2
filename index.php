<html> 
	<head> 
		<title>Tugas 2</title>
		<script type="text/javascript" src="jquery.min.js"></script>
		<script type="text/javascript" src="libs/jquery.form.js"></script>
		<link rel="stylesheet" type="text/css" href="flexigrid.css">
		<script type="text/javascript" src="libs/jquery.cookie.js"></script>
		<script type="text/javascript" src="libs/flexigrid/js/flexigrid.js"></script>
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
	</head> 
	<body> 
		<h1>Data Mahasiswa</h1> 
		<form action="" method="post" id="frm"> 
			<label for="nim" class="labelfrm">NIM: </label> 
			<input type="text" name="nim" id="nim" maxlength="15" class="required" size="15"/> 		 
			<label for="nama" class="labelfrm">NAMA: </label> 
			<input type="text" name="nama" id="nama" size="30" class="required"/> 
 
			<label for="alamat" class="labelfrm">ALAMAT: </label> 
			<textarea name="alamat" id="alamat" cols="40" rows="4" class="required"></textarea> 
			
			<label for="nama" class="labelfrm">PROGDI: </label> 
			<input type="text" name="progdi" id="progdi" size="30" class="required"/> 
 
			<label for="submit" class="labelfrm">&nbsp;</label> 
			<input type="submit" name="Input" value="Input" id="input"/> 
		</form> 
<?php
   $host="localhost";
   $user="root";
   $pass="";
   $db="akademik";
   $sambung=mysql_connect($host,$user,$pass);
   mysql_select_db($db,$sambung);
  
if (isset($_POST['Input'])) {
	$nim  	= strip_tags($_POST['nim']);
	$nama  	= strip_tags($_POST['nama']);
	$alamat    = strip_tags($_POST['alamat']);
	$progdi    = strip_tags($_POST['progdi']);
 
	//input ke db
	$query = sprintf("INSERT INTO mahasiswa VALUES('%s', '%s', '%s', '%s')", 
			mysql_escape_string($nim), 
			mysql_escape_string($nama), 
			mysql_escape_string($alamat),
			mysql_escape_string($progdi)
		);
	$sql = mysql_query($query);
	if ($sql) {
		echo "Data berhasil disimpan";
	} else {
		echo "Data gagal disimpan ";
		echo mysql_error();
	}
}

$query="SELECT*FROM  mahasiswa";
$result=mysql_query($query);
?>

<table border="1"width="100%"align='center'>
<tr align='center'>
<td width="200px"><b>NIM</b></td>
<td width="200px"><b>Nama</b></td>
<td width="200px"><b>Alamat</b></td>
<td width="200px"><b>Progdi</b></td>
</tr>

<?php
while ($data = mysql_fetch_array($result))
{
	echo"<tr align='center'>
	<td>".$data['nim']."</td>
	<td>".$data['nama']."</td>
	<td>".$data['alamat']."</td>
	<td>".$data['progdi']."</td>
	</tr>";
}
?>
	</table>
	</body> 
</html>