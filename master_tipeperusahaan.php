<?php
	include "koneksi.php";
	include "allin.php";

	

	if (isset($_POST['submit'])) {
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$deskripsi = $_POST['deskripsi'];

		if ($id == '') {
			$id = generateID('tipe_perusahaan', 'id', '5');
		}

		$data = array(
			'id' => $id,
			'nama' => $nama,
			'deskripsi' => $deskripsi,
		);


		$act = insertDB('tipe_perusahaan',$data);
		if ($act) {
			header('Location: '.basename(__FILE__));
		}else{
			die(mysql_error());
		}
	}

	$data = getAllData('tipe_perusahaan', 'id, nama, deskripsi');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include "headmeta.template.php" ?>

		<title>Master Tipe Perusahaan</title>
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
					<legend>Master Tipe Perusahaan</legend>

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
					  <label class="col-md-4 control-label" for="nama">Tipe Perusahaan</label>  
					  <div class="col-md-4">
					  <input id="nama" name="nama" type="text" placeholder="Tipe Perusahaan" class="form-control input-md" required="">
					    
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
								<th>Tipe Perusahaan</th>
								<th>Deskripsi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $key => $value): ?>
								<tr>
									<td> <?php echo $value['id'] ?> </td>
									<td> <?php echo $value['nama'] ?> </td>
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
