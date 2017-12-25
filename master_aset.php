<?php
	include "koneksi.php";
	include "allin.php";

	$date1 = new DateTime('2009-08-01');
			$date2 = new DateTime('2009-04-01');

			$diff = $date1->diff($date2);
			var_dump($diff);

			echo (($diff->format('%y') * 12) + $diff->format('%m')) . " full months difference";

	if (isset($_POST['submit'])) {
		$code = $_POST['code'];
		$nama = $_POST['nama'];
		$serialnumber = $_POST['serialnumber'];
		$kelompokakun = $_POST['kelompokakun'];
		$deskripsi = $_POST['deskripsi'];
		$lokasi = $_POST['lokasi'];
		$tanggalakuisisi = $_POST['tanggalakuisisi'];
		$harga = $_POST['harga'];

		if ($id == '') {
			$id = generateID('aset', 'id', '5');
		}

		if ($code == '') {
			$code = $id;
		}

		$id = intval($id);


		$data  = getAllData('kelompok_akun', 'jangkawaktu', " and id = '".$kelompokakun."' limit 1");
		$masaberlaku = $data[0]['jangkawaktu'] * 12;

		$data = array(
			'id' => $id,
			'code' => $code,
			'nama' => $nama,
			'serialnumber' => $serialnumber,
			'kelompokakun' => $kelompokakun,
			'masaberlaku' => $masaberlaku,
			'deskripsi' => $deskripsi,
			'lokasi' => $lokasi,
			'tanggalakuisisi' => $tanggalakuisisi,
			'harga' => $harga
		);


		$act = insertDB('aset',$data);

		if ($tanggalakuisisi < date('Y-m-01') ) {
			$arrayAkuisisi = explode('-', $tanggalakuisisi);
			$tahunAkuisisi = $arrayAkuisisi['0'];
			$bulanAkuisisi = $arrayAkuisisi['1'];
			$hariAkuisisi = $arrayAkuisisi['2'];

			$arrayWaktusekarang = explode('-', date('Y-m-d'));
			$tahunSekarang = $arrayWaktusekarang['0'];
			$bulanSekarang = $arrayWaktusekarang['1'];
			$hariSekarang = $arrayWaktusekarang['2'];

			//hitung selisih bulan
			$num = ($tahunSekarang - $tahunAkuisisi) * 12 - $bulanAkuisisi + $bulanSekarang;

			if ($hariSekarang <= 25) {
				$num--;
			}
		}

		if ($act) {
			header('Location: '.basename(__FILE__));
		}else{
			die(mysql_error());
		}
	}

	$data = getAllData('aset a left join kelompok_akun k on k.id = a.kelompokakun', 'a.id, a.nama, a.serialnumber, k.nama as kelompokakun, a.masaberlaku, a.harga, a.tanggalakuisisi');
	$kelompokakun = getAllData('kelompok_akun', 'id, nama, jangkawaktu');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include "headmeta.template.php" ?>

		<title>Master Aset</title>
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
						<legend>Master Aset</legend>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="code">Kode Aset</label>  
						  <div class="col-md-4">
						  <input id="code" name="code" type="text" placeholder="Kode Aset" class="form-control input-md">
						  <span class="help-block">Kosongkan untuk kode otomatis</span>  
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="nama">Nama Aset</label>  
						  <div class="col-md-4">
						  <input id="nama" name="nama" type="text" placeholder="Nama Aset" class="form-control input-md" required="">
							
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="serialnumber">Serial Number</label>  
						  <div class="col-md-4">
						  <input id="serialnumber" name="serialnumber" type="text" placeholder="Serial Number" class="form-control input-md" required="">
							
						  </div>
						</div>

						<!-- Select Basic -->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="kelompokakun">Kelompok Akun</label>
						  <div class="col-md-4">
							<select id="kelompokakun" name="kelompokakun" class="form-control">
							  <option value="" selected disabled>Pilih Kelompok Akun</option>
							  <?php foreach ($kelompokakun as $key => $value): ?>
								<option value="<?php echo $value['id'] ?>"><?php echo $value['nama']." - ".$value['jangkawaktu']." Tahun" ?></option>
							  <?php endforeach ?>
							</select>
						  </div>
						</div>

						<!-- Textarea -->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="deskripsi">Deskripsi</label>
						  <div class="col-md-4">                     
							<textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="lokasi">Lokasi Aset</label>  
						  <div class="col-md-4">
						  <textarea class="form-control" id="lokasi" name="lokasi"></textarea>
							
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="tanggalakuisisi">Tanggal Akuisisi</label>  
						  <div class="col-md-4">
						  <input id="tanggalakuisisi" name="tanggalakuisisi" type="date" placeholder="Tanggal Akuisisi" class="form-control input-md" required="">
							
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="harga">Harga Aset</label>  
						  <div class="col-md-4">
						  <input id="harga" name="harga" type="number" placeholder="Harga Aset" class="form-control input-md" required="">
							
						  </div>
						</div>

						<!-- Text input-->
						<!-- <div class="form-group">
						  <label class="col-md-4 control-label" for="status">Status Aset</label>  
						  <div class="col-md-4">
						  <input id="status" name="status" type="text" placeholder="Status Aset" class="form-control input-md" required="">
							
						  </div>
						</div> -->

						<!-- Multiple Radios -->
						<!-- <div class="form-group">
							<label class="col-md-4 control-label" for="radios">Status Aset</label>
							<div class="col-md-4">
								<div class="radio">
									<label for="radios-0">
										<input type="radio" name="radios" id="radios-0" value="1" checked="checked"> Option one
									</label>
								</div>
								<div class="radio">
									<label for="radios-1">
										<input type="radio" name="radios" id="radios-1" value="2"> Option two
									</label>
								</div>
							</div>
						</div> -->

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
								<th>Serial Number</th>
								<th>Nama Aset</th>
								<th>Kelompok Akun</th>
								<th>Tanggal Akuisisi</th>
								<th>Harga</th>
								<th>Masa Berlaku (Bulan)</th>
								<th>Penyusutan per Bulan</th>

							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $key => $value): ?>
								<tr>
									<td> <?php echo $value['id'] ?> </td>
									<td> <?php echo $value['serialnumber'] ?> </td>
									<td> <?php echo $value['nama'] ?> </td>
									<td> <?php echo $value['kelompokakun'] ?> </td>
									<td> <?php echo $value['tanggalakuisisi'] ?> </td>
									<td class="text-right"> <samp> <?php echo $value['harga'] ?> </samp> </td>
									<td> <?php echo $value['masaberlaku'] ?> </td>
									<td class="text-right"> <samp> <?php echo ceil($value['harga'] / $value['masaberlaku']) ?> </samp> </td>
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
