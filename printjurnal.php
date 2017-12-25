<?php
	include "koneksi.php";
	include "allin.php";
	$id = $_GET['id'];
	
	$sql = "select 
		t.tanggaltransaksi,
		t.akun,
		a.nama as namaakun,
		t.nilai 
	from 
		jurnal_transaksi t 
		left join akun a on a.id = t.akun
	where t.id = '".$id."'";
	$res = mysql_query($sql);
	echo mysql_error();
	$data = [];
	while ($row = mysql_fetch_assoc($res)) {
		$data = $row;
	}
?>

<html>
<head>
	<title></title>
	<style type="text/css">
		*{
			font-family:Arial;
			font-size: 12px;
		}
		
		table{
			width:100%;
			border-collapse:collapse;
		}

		.trans{
			border:1px solid black;
		}

		.nominal{
			text-align:right;
		}
		samp{
			font-family:monospace;
		}
		
		@media print {
			.pagebreak {page-break-after: always;}
			#Header, #Footer { display: none !important; }
			@page { margin-bottom:5mm }
			div.divFooter {
				width:100%;
					position: fixed;
					bottom: 0;
				}
		}
		@media screen {
			div.divFooter {
				display: none;
			}
		}
			
	</style>
	<script>
		//window.print()
	</script>
</head>
<body>
	<table>
		<tr>
			<td style="width: 50%;" rowspan="3">LOGO COMPANY CLIENT</td>
			<td colspan="2" style="text-align:center;">JURNAL VOUCHER KAS/BANK</td>
		</tr>
		<tr>
			<td> Nomor : </td>
			<td> ____________________________________ </td>
		</tr>
		<tr>
			<td> Tanggal : </td>
			<td> <?php echo $data['tanggaltransaksi'] ?> </td>
		</tr>
	</table>

	<table class="trans">
		<tr>
			<td>No.</td>
			<td>Kode/Nama Akun</td>
			<td>Rupiah</td>
		</tr>
		<tr>
			<td>1.</td>
			<td><?php echo $data['akun']." (".$data['namaakun'].")" ?></td>
			<td class="nominal"><samp><?php echo $data['nilai'] ?></samp></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:right">JUMLAH RP.</td>
			<td class="nominal"><samp><?php echo $data['nilai'] ?></samp></td>
		</tr>
	</table>

	<p>Terbilang : <?php echo ucwords(terbilang($data['nilai'])) ?> Rupiah</p>
	<p>Lampiran : </p>

	<table>
		<tr>
			<td>Diketahui Oleh</td>
			<td>Disetujui Oleh</td>
			<td>Diserahkan Oleh</td>
			<td>Diterima Oleh</td>
		</tr>
		<tr>
			<td>
				<br><br><br><br><br>
				(.................................)
			</td>
			<td>
				<br><br><br><br><br>
				(.................................)
			</td>
			<td>
				<br><br><br><br><br>
				(.................................)
			</td>
			<td>
				<br><br><br><br><br>
				(.................................)
			</td>
		</tr>
	</table>
</body>
</html>