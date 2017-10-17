<?php
	include "koneksi.php";
	include "allin.php";

	if (isset($_POST['submit'])) {
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$jangkawaktu = $_POST['jangkawaktu'];
		$deskripsi = $_POST['deskripsi'];

		if ($id == '') {
			$id = generateID('kelompok_akun', 'id', '10');
		}

		$data = array(
			'id' => $id,
			'nama' => $nama,
			'jangkawaktu' => $jangkawaktu,
			'deskripsi' => $deskripsi,
		);


		$act = insertDB('kelompok_akun',$data);
		if ($act) {
			header('Location: '.basename(__FILE__));
		}else{
			die(mysql_error());
		}
	}

	$data = getAllData('kelompok_akun', 'id, nama, jangkawaktu, deskripsi');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include "headmeta.template.php" ?>

		<title>Master Kelompok Akun</title>
	</head>
	<body>
		<div class="row">
		    <?php include "sidemenu.template.php" ?>

		    <!-- Main Content -->
		    <div class="container-fluid">
		        <div class="side-body">		     
		        	<br><br>      	
		           	<form class="form-horizontal" method="post">
					<fieldset>

					<!-- Form Name -->
					<legend>Master Kelompok Akun</legend>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="id">ID</label>  
					  <div class="col-md-4">
					  <input id="id" name="id" type="text" placeholder="ID" class="form-control input-md">
					  <span class="help-block">Kosongkan untuk ID otomatis</span>  
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="nama">Nama Kelompok Akun</label>  
					  <div class="col-md-4">
					  <input id="nama" name="nama" type="text" placeholder="Nama Kelompok Akun" class="form-control input-md" required="">
					    
					  </div>
					</div>

					<!-- Appended Input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="jangkawaktu">Jangka Waktu</label>
					  <div class="col-md-4">
					    <div class="input-group">
					      <input id="jangkawaktu" name="jangkawaktu" class="form-control" placeholder="Jangka Waktu" type="number" required="">
					      <span class="input-group-addon">Tahun</span>
					    </div>
					    
					  </div>
					</div>
					<!-- Textarea -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="deskripsi">Deskripsi</label>
					  <div class="col-md-4">                     
					    <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
					  </div>
					</div>

					<!-- Button -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="submit"></label>
					  <div class="col-md-4">
					    <button id="submit" name="submit" class="btn btn-primary">Tambah</button>
					  </div>
					</div>

					</fieldset>
					</form>
					<table class="table table-hover" id="tablenormal">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nama Kelompok Akun</th>
								<th>Jangka Waktu (tahun)</th>
								<th>Deskripsi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $key => $value): ?>
								<tr>
									<td> <?php echo $value['id'] ?> </td>
									<td> <?php echo $value['nama'] ?> </td>
									<td> <?php echo $value['jangkawaktu'] ?> </td>
									<td> <?php echo $value['deskripsi'] ?> </td>
								</tr>
							<?php endforeach ?>
						</tbody>
							
					</table>

		        </div>
		    </div>
		</div>

		<?php include "js.template.php" ?>
	</body>
</html>
