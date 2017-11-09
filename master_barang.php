<?php
	include "koneksi.php";
	include "allin.php";

	if (isset($_POST['submit'])) {
		if ($_POST['submit'] == "new") {
			$id = $_POST['id'];
			$nama = $_POST['nama'];
			$keterangan = $_POST['keterangan'];
			$harga = $_POST['harga'];
			$bahanbaku = isset($_POST['bahanbaku']) ? $_POST['bahanbaku'] : [];

			if ($id == '') {
				$id = generateID('barang', 'id', '0');
			}

			$data = array(
				'id' => $id,
				'nama' => $nama,
				'keterangan' => $keterangan,
				'harga' => $harga,
			);
			$act = insertDB('barang',$data);

			if ($act) {
				foreach ($bahanbaku as $key => $value) {
					$data = array(
						'idbarang' => $id,
						'bahanbaku' => $value,
					);
					$act = insertDB('barang_bahanbaku',$data);
				}
			}else{
				die(mysql_error());
			}
		}elseif ($_POST['submit'] == "edit") {
			$editid = $_POST['editid'];
			$editnama = $_POST['editnama'];
			$editketerangan = $_POST['editketerangan'];
			$editharga = $_POST['editharga'];
			$editbahanbaku = isset($_POST['editbahanbaku']) ? $_POST['editbahanbaku'] : [];

			$data = array(
				'nama' => $editnama,
				'keterangan' => $editketerangan,
				'harga' => $editharga,
			);
			$act = updateDB('barang',$data, "id = '".$editid."'");
			if ($act) {
				deleteDB("barang_bahanbaku", "idbarang = '".$editid."'");
				foreach ($editbahanbaku as $key => $value) {
					$data = array(
						'idbarang' => $editid,
						'bahanbaku' => $value,
					);
					$act = insertDB('barang_bahanbaku',$data);
				}
			}else{
				echo mysql_error();
			}
		}
		header('Location: '.basename(__FILE__));
		die();
	}
	$data = getAllData('barang', 'id, nama, harga', "order by id*1 asc");
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include "headmeta.template.php" ?>

            <title>Master Barang</title>
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
                                <legend>Master Barang</legend>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="nama">Nama Barang</label>
                                    <div class="col-md-4">
                                        <input id="nama" name="nama" type="text" placeholder="Nama Barang" class="form-control input-md" required="">
                                    </div>
                                </div>

                                <!-- Textarea -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="keterangan">Keterangan</label>
                                    <div class="col-md-4">
                                        <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="harga">Harga</label>
                                    <div class="col-md-4">
                                        <input id="harga" name="harga" type="number" placeholder="Harga" class="form-control input-md" required="">
                                    </div>
                                </div>

                                <!-- Select Multiple -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="bahanbaku">Bahan Baku</label>
                                    <div class="col-md-4">
                                        <select id="bahanbaku" name="bahanbaku[]" class="form-control" multiple="multiple">
                                            <!-- <option value="" selected>-= Pilih Bahan Baku =-</option> -->
                                            <?php foreach ($data as $key => $value): ?>
                                                <option value="<?php echo $value['id'] ?>">
                                                    <?php echo $value['nama'] ?>
                                                </option>
                                                <?php endforeach ?>

                                        </select>
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

                        <table class="table table-hover" id="tablenormal">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $key => $value): ?>
                                    <tr>
                                        <td>
                                            <?php echo $value['id'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value['nama'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value['harga'] ?>
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
                        <h4 class="modal-title" id="modalViewLabel">Edit Barang</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="post">
                            <fieldset>
                            	<input id="editid" name="editid" type="hidden" >
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="editnama">Nama Barang</label>
                                    <div class="col-md-6">
                                        <input id="editnama" name="editnama" type="text" placeholder="Nama Barang" class="form-control input-md" required="">

                                    </div>
                                </div>

                                <!-- Textarea -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="editketerangan">Keterangan</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" id="editketerangan" name="editketerangan"></textarea>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="editharga">Harga</label>
                                    <div class="col-md-6">
                                        <input id="editharga" name="editharga" type="number" placeholder="Harga" class="form-control input-md" required="">

                                    </div>
                                </div>

                                <!-- Select Multiple -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="editbahanbaku">Bahan Baku</label>
                                    <div class="col-md-6">
                                        <select id="editbahanbaku" name="editbahanbaku[]" class="form-control" multiple="multiple">
                                            <!-- <option value="" selected>-= Pilih Bahan Baku =-</option> -->
                                            <?php foreach ($data as $key => $value): ?>
                                                <option value="<?php echo $value['id'] ?>">
                                                    <?php echo $value['nama'] ?>
                                                </option>
                                                <?php endforeach ?>

                                        </select>
                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="submit"></label>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button id="submit" name="submit" value="edit" class="btn btn-primary">Simpan</button>
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
                    url: "ajaxrequest.php?method=getdetailbarang&id=" + id,
                    cache: false,
                    dataType: 'json',
                    success: function(hasil) {
                    	console.log(hasil)
                        var modal = $("#modalView")
  						modal.find('#editid').val(hasil.id)
  						modal.find('#editnama').val(hasil.nama)
  						modal.find('#editketerangan').val(hasil.keterangan)
  						modal.find('#editharga').val(hasil.harga)
  						modal.find('#editbahanbaku').val(hasil.bahanbaku)
                    }
                });

            })
        </script>
    </body>

</html>