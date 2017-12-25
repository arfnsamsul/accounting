<?php
	include "koneksi.php";
	include "allin.php";

    $data = [];
    $dataAkun = getAllData('akun', 'id, nama', "order by id*1, id");
    if (isset($_GET['submit'])) {         
        if ($_GET['submit'] == "filter") {
            $data = getAllData('jurnal_transaksi t left join akun a on a.id = t.akun', 't.*, a.nama as namaakun', "order by tanggaltransaksi");
        }
    }

	if (isset($_POST['submit'])) {         
        if ($_POST['submit'] == "new") {
			$tanggaltransaksi = $_POST['tanggaltransaksi'];
            $nomorbuktitransaksi = $_POST['nomorbuktitransaksi'];
            $jenis = $_POST['jenis'];
            $mitra = $_POST['mitra'];
            $deskripsi = $_POST['deskripsi'];
            $akun = $_POST['akun'];
            $nilai = $_POST['nilai'];
			
			//$id = generateID('jurnal_transaksi', 'id', '0');

			$data = array(
                //'id' => $id,
				'tanggaltransaksi' => $tanggaltransaksi,
                'nomorbuktitransaksi' => $nomorbuktitransaksi,
                'jenis' => $jenis,
                'mitra' => $mitra,
                'deskripsi' => $deskripsi,
                'akun' => $akun,
                'nilai' => $nilai
			);
			$act = insertDB('jurnal_transaksi',$data);

			if (!$act) {
				die(mysql_error());
			}
		}elseif ($_POST['submit'] == "edit") {
			$id = $_POST['editid'];
            $tanggaltransaksi = $_POST['edittanggaltransaksi'];
            $nomorbuktitransaksi = $_POST['editnomorbuktitransaksi'];
            $jenis = $_POST['editjenis'];
            $mitra = $_POST['editmitra'];
            $deskripsi = $_POST['editdeskripsi'];
            $akun = $_POST['editakun'];
            $nilai = $_POST['editnilai'];

			$data = array(
                'tanggaltransaksi' => $tanggaltransaksi,
                'nomorbuktitransaksi' => $nomorbuktitransaksi,
                'jenis' => $jenis,
                'mitra' => $mitra,
                'deskripsi' => $deskripsi,
                'akun' => $akun,
                'nilai' => $nilai
            );
			$act = updateDB('jurnal_transaksi',$data, "id = '".$id."'");
			if (!$act) {
				echo mysql_error();
			}
		}
		header('Location: '.basename(__FILE__));
		die();
	}

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include "headmeta.template.php" ?>

            <title>Jurnal Kegiatan</title>
    </head>

    <body>
        <div class="row">
            <?php include "sidemenu.template.php" ?>

                <!-- Main Content -->
                <div class="container-fluid">
                    <div class="side-body">
                        <br>
                        <br>
                        <form class="form-horizontal" method="post">
                            <fieldset>

                                <!-- Form Name -->
                                <legend>Jurnal Kegiatan</legend>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="tanggaltransaksi">Tanggal Transaksi</label>
                                    <div class="col-md-4">
                                        <input id="tanggaltransaksi" name="tanggaltransaksi" type="datetime-local" class="form-control input-md" required="">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="nomorbuktitransaksi">Nomor Bukti Transaksi</label>
                                    <div class="col-md-4">
                                        <input id="nomorbuktitransaksi" name="nomorbuktitransaksi" type="text" placeholder="Nomor Bukti Transaksi" class="form-control input-md">

                                    </div>
                                </div>

                                <!-- Multiple Radios -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="jenis">Jenis Transaksi</label>
                                    <div class="col-md-4">
                                        <div class="radio">
                                            <label for="jenis-0">
                                                <input type="radio" name="jenis" id="jenis-0" value="debet" checked="checked"> Debet
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label for="jenis-1">
                                                <input type="radio" name="jenis" id="jenis-1" value="kredit"> Kredit
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Select Basic -->
                                <!-- <div class="form-group">
                                    <label class="col-md-4 control-label" for="mitra">Mitra</label>
                                    <div class="col-md-4">
                                        <select id="mitra" name="mitra" class="form-control">
                                            <option value="0">-= Pilih Supplier/Customer =-</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="mitra">Mitra</label>
                                    <div class="col-md-4">
                                        <input id="mitra" name="mitra" type="text" placeholder="Supplier/Customer" class="form-control input-md">
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="deskripsi">Uraian Transaksi</label>
                                    <div class="col-md-4">
                                        <input id="deskripsi" name="deskripsi" type="text" placeholder="Uraian Transaksi" class="form-control input-md">

                                    </div>
                                </div>

                                <!-- Select Basic -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="akun">Akun</label>
                                    <div class="col-md-4">
                                        <select id="akun" name="akun" class="form-control">
                                            <option value="" selected disabled>-= Pilih Akun =-</option>
                                            <?php foreach ($dataAkun as $key => $value): ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['nama']." (".$value['id'].")" ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="nilai">Nilai Transaksi (Rp)</label>
                                    <div class="col-md-4">
                                        <input id="nilai" name="nilai" type="number" min="1" class="form-control input-md" required="">

                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="submit"></label>
                                    <div class="col-md-4">
                                        <button id="submit" name="submit" value="new" class="btn btn-primary">Tambah</button>
                                    </div>
                                </div>

                            </fieldset>
                        </form>
                        <br>
                        <form class="form-inline" method="GET">
                            <div class="form-group">
                                <label for="datefrom">Tampilkan dari tanggal : </label>
                                <input type="date" class="form-control" id="datefrom" name="datefrom">
                            </div> 
                            <div class="form-group">
                                <label for="dateto">Hingga : </label>
                                <input type="date" class="form-control" id="dateto" name="dateto">
                            </div>
                            <button type="submit" name="submit" value="filter" class="btn btn-sm btn-success">Filter <span class="glyphicon glyphicon-filter"></span></button>
                        </form>
                        <br>
                        <table class="table table-hover" id="tablenormal">
                            <thead>
                                <tr>
                                    <th>Tanggal Transaksi</th>
                                    <th>No. Bukti Transaksi</th>
                                    <th>Cust/Supplier</th>
                                    <th>Uraian Transaksi</th>
                                    <th>Akun</th>
                                    <th>Debet</th>
                                    <th>Kredit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $key => $value): ?>
                                    <tr>
                                        <td>
                                            <?php echo $value['tanggaltransaksi'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value['nomorbuktitransaksi'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value['mitra'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value['deskripsi'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value['namaakun']." (".$value['akun'].")" ?>
                                        </td>
                                        <td class="text-right">
                                            <samp><?php echo $value['jenis'] == 'debet' ? $value['nilai'] : '' ?></samp>
                                        </td>
                                        <td class="text-right">
                                            <samp><?php echo $value['jenis'] == 'kredit' ? $value['nilai'] : '' ?></samp>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalView" data-id="<?php echo $value['id'] ?>">Lihat & Ubah</button>

                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>

        <!-- MODAL EDIT -->
        <div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalViewLabel">Ubah Transaksi</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="post">
                            <fieldset>
                                <input id="editid" name="editid" type="hidden">
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="edittanggaltransaksi">Tanggal Transaksi</label>
                                    <div class="col-md-6">
                                        <input id="edittanggaltransaksi" name="edittanggaltransaksi" type="datetime-local" class="form-control input-md" required="">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="editnomorbuktitransaksi">Nomor Bukti Transaksi</label>
                                    <div class="col-md-6">
                                        <input id="editnomorbuktitransaksi" name="editnomorbuktitransaksi" type="text" placeholder="Nomor Bukti Transaksi" class="form-control input-md">

                                    </div>
                                </div>

                                <!-- Multiple Radios -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="editjenis">Jenis Transaksi</label>
                                    <div class="col-md-6">
                                        <div class="radio">
                                            <label for="editjenis-0">
                                                <input type="radio" name="editjenis" id="editjenis-0" value="debet" checked="checked"> Debet
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label for="editjenis-1">
                                                <input type="radio" name="editjenis" id="editjenis-1" value="kredit"> Kredit
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Select Basic -->
                                <!-- <div class="form-group">
                                    <label class="col-md-4 control-label" for="editmitra">Mitra</label>
                                    <div class="col-md-6">
                                        <select id="editmitra" name="editmitra" class="form-control">
                                            <option value="0">-= Pilih Supplier/Customer =-</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="editmitra">Mitra</label>
                                    <div class="col-md-6">
                                        <input id="editmitra" name="editmitra" type="text" placeholder="Supplier/Customer" class="form-control input-md">
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="editdeskripsi">Uraian Transaksi</label>
                                    <div class="col-md-6">
                                        <input id="editdeskripsi" name="editdeskripsi" type="text" placeholder="Uraian Transaksi" class="form-control input-md">

                                    </div>
                                </div>

                                <!-- Select Basic -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="editakun">Akun</label>
                                    <div class="col-md-6">
                                        <select id="editakun" name="editakun" class="form-control">
                                            <option value="" selected disabled>-= Pilih Akun =-</option>
                                            <?php foreach ($dataAkun as $key => $value): ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['nama']." (".$value['id'].")" ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="editnilai">Nilai Transaksi (Rp)</label>
                                    <div class="col-md-6">
                                        <input id="editnilai" name="editnilai" type="number" min="1" class="form-control input-md" required="">

                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="submit"></label>
                                    <div class="col-md-6">
                                        <button id="submit" name="submit" value="edit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>

                            </fieldset>
                        </form>
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div> -->
                </div>
            </div>
        </div>

        <?php include "js.template.php" ?>
        <script type="text/javascript">
            $('#modalView').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-* attributes
                    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                $.ajax({
                    url: "ajaxrequest.php?method=getdetailtransaksi&id=" + id,
                    cache: false,
                    dataType: 'json',
                    success: function(hasil) {
                        var modal = $("#modalView")
                        var tgl = hasil.tanggaltransaksi.split(" ");
                        var w3ctgl = tgl[0] + 'T' + tgl[1]

                        console.log(hasil);
                        modal.find('#editid').val(hasil.id)
                        modal.find('#edittanggaltransaksi').val(w3ctgl)
                        modal.find('#editnomorbuktitransaksi').val(hasil.nomorbuktitransaksi)
                        $( "input:radio[name=editjenis]").val([hasil.jenis]);
                        modal.find('#editmitra').val(hasil.mitra)
                        modal.find('#editdeskripsi').val(hasil.deskripsi)
                        modal.find('#editakun').val(hasil.akun)
                        modal.find('#editnilai').val(hasil.nilai)
                    }
                });

            })
        </script>
    </body>

</html>