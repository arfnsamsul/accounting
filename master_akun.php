<?php
	include "koneksi.php";
	include "allin.php";

	if (isset($_POST['submit'])) {
		$id = $_POST['id'];
		$idtipeperusahaan = $_POST['tipeperusahaan'];
		$nama = $_POST['nama'];
		$jenislaporan = $_POST['jenislaporan'];
		$deskripsi = $_POST['deskripsi'];

		if ($id == '') {
			$id = generateID('akun', 'id', '10');
		}

		$data = array(
			'id' => $id,
			'idtipeperusahaan' => $idtipeperusahaan,
			'nama' => $nama,
			'jenislaporan' => $jenislaporan,
			'deskripsi' => $deskripsi,
		);


		$act = insertDB('akun',$data);
		if ($act) {
			header('Location: '.basename(__FILE__));
		}else{
			die(mysql_error());
		}
	}	

	$data = getAllData('akun a left join tipe_perusahaan t on t.id = a.idtipeperusahaan', 'a.id, a.nama, a.jenislaporan, t.nama as tipeperusahaan');

	$tipeperusahaan = getAllData('tipe_perusahaan', 'id, nama');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include "headmeta.template.php" ?>

		<title>Master Akun</title>
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
					<legend>Master Akun</legend>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="id">ID Akun</label>  
					  <div class="col-md-4">
					  <input id="id" name="id" type="text" placeholder="ID Akun" class="form-control input-md" >
					  <span class="help-block">Kosongkan untuk ID otomatis</span>  
					  </div>
					</div>

					<!-- Select Basic -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="tipeperusahaan">Tipe Perusahaan</label>
					  <div class="col-md-4">
					    <select id="tipeperusahaan" name="tipeperusahaan" class="form-control">
					      <option value="" selected disabled>Pilih Tipe Perusahaan</option>
					      <?php foreach ($tipeperusahaan as $key => $value): ?>
					      	<option value="<?php echo $value['id'] ?>"><?php echo $value['nama'] ?></option>
					      <?php endforeach ?>
					    </select>
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="nama">Nama Akun</label>  
					  <div class="col-md-4">
					  <input id="nama" name="nama" type="text" placeholder="Nama Akun" class="form-control input-md" required="">
					    
					  </div>
					</div>

					<div class="form-group">
                        <label class="col-md-4 control-label" for="jenislaporan">Jenis Laporan</label>
                        <div class="col-md-4">
                            <div class="radio">
                                <label for="jenislaporan-0">
                                    <input type="radio" name="jenislaporan" id="jenislaporan-0" value="labarugi" checked="checked"> Laba RUgi
                                </label>
                            </div>
                            <div class="radio">
                                <label for="jenislaporan-1">
                                    <input type="radio" name="jenislaporan" id="jenislaporan-1" value="neraca"> Neraca
                                </label>
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
								<th>Tipe Perusahaan</th>
								<th>Nama Akun</th>
								<th>Jenis Laporan</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $key => $value): ?>
								<tr>
									<td> <?php echo $value['id'] ?> </td>
									<td> <?php echo $value['tipeperusahaan'] ?> </td>
									<td> <?php echo $value['nama'] ?> </td>
									<td>
										<?php 
											if ($value['jenislaporan'] == 'labarugi') {
												echo "Laba Rugi";
											}elseif ($value['jenislaporan'] == 'neraca') {
												echo "Neraca";
											}else{
												echo $value['jenislaporan'];
											}
										?> 

									</td>
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
