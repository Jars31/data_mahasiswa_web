<?php include('config.php'); ?>


	<div class="container" style="margin-top:20px">
		<center><font size="6">Edit Data</font></center>

		<hr>

		<?php
		//jika sudah mendapatkan parameter GET id dari URL
		if(isset($_GET['id'])){
			//membuat variabel $id untuk menyimpan id dari GET id di URL
			$id = $_GET['id'];

			//query ke database SELECT tabel dosen berdasarkan Nip = $Nip
			$select = mysqli_query($koneksi, "SELECT * FROM request WHERE id='$id'") or die(mysqli_error($koneksi));

			//jika hasil query = 0 maka muncul pesan error
			if(mysqli_num_rows($select) == 0){
				echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
				exit();
			//jika hasil query > 0
			}else{
				//membuat variabel $data dan menyimpan data row dari query
				$data = mysqli_fetch_assoc($select);
			}
		}
		?>

		<?php
		//jika tombol simpan di tekan/klik
		if(isset($_POST['submit'])){
			$nama	    = addslashes($_POST['nama']);
			$departemen	= addslashes($_POST['departemen']);
			$request	= addslashes($_POST['request']);
            $modul	    = addslashes($_POST['modul']);
			$created_by	    = $_SESSION['username'];
            $created_date	    = date("Y-m-d H:i:s");
			$modified_by	    = $_SESSION['username'];
			$modified_date	    = date("Y-m-d H:i:s");

			$sql = mysqli_query($koneksi, "UPDATE request SET nama='$nama', nama='$nama', departemen='$departemen', request='$request', modul='$modul', created_by='$created_by', created_date='$created_date', modified_by='$modified_by', modified_date='$modified_date' WHERE nama='$nama'") or die(mysqli_error($koneksi));
		
			if($sql){
				echo '<script>alert("Berhasil menyimpan data."); document.location="index.php?page=tampil_request";</script>';
			}else{ 
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}
		?>

		<form action="index.php?page=edit_request" method="post">
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nama</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Departemen</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="departemen" class="form-control" value="<?php echo $data['departemen']; ?>" required>
				</div>
            </div>
            <div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Request</label>
				<div class="col-md-6 col-sm-6">
					<textarea name="request" class="form-control" placeholder="Write your request here..." required></textarea>
				</div>
            </div>
            </div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Modul</label>
				<div class="col-md-6 col-sm-6">
				<?php

					$select = mysqli_query($koneksi, "SELECT * FROM module") or die(mysqli_error($koneksi));


				?>

				<select name="modul" class="form-control" required>
                    <option value="">Modul</option>
					<?php while($dosen = mysqli_fetch_array($select)){ ?>
							<option value="<?=$dosen['id']?>" <?php if($data['id'] == $dosen['id']){ echo 'selected'; } ?>><?=$dosen['module_name']?></option>
						<?php } ?>

					</select>
				</div>
			</div>
			<div class="item form-group">
				<div class="col-md-6 col-sm-6 offset-md-3">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
					<a href="index.php?page=tampil_request" class="btn btn-warning">Kembali</a>
				</div>
			</div>
		</form>
	</div>