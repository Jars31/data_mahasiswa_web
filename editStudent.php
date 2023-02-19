<?php include('config.php'); ?>


	<div class="container" style="margin-top:20px">
		<center><font size="6">Edit Data</font></center>

		<hr>

		<?php
		//jika sudah mendapatkan parameter GET id dari URL
		if(isset($_GET['Nim'])){
			//membuat variabel $id untuk menyimpan id dari GET id di URL
			$Nim = $_GET['Nim'];

			//query ke database SELECT tabel mahasiswa berdasarkan id = $id
			$select = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE Nim='$Nim'") or die(mysqli_error($koneksi));

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
			$Nama_Mhs	    = addslashes($_POST['Nama_Mhs']);
			$Jenis_Kelamin	= addslashes($_POST['Jenis_Kelamin']);
			$Program_Studi	= addslashes($_POST['Program_Studi']);
			$id_dosen	= addslashes($_POST['id_dosen']);
			$created_by	    = $_SESSION['username'];
            $created_date	    = date("Y-m-d H:i:s");
			$modified_by	    = $_SESSION['username'];
			$modified_date	    = date("Y-m-d H:i:s");


			
			$sql = mysqli_query($koneksi, "UPDATE mahasiswa SET Nama_Mhs='$Nama_Mhs', Jenis_Kelamin='$Jenis_Kelamin', Program_Studi='$Program_Studi', id_dosen='$id_dosen', created_by='$created_by', created_date='$created_date', modified_by='$modified_by', modified_date='$modified_date' WHERE Nim='$Nim'") or die(mysqli_error($koneksi));

			if($sql){
				echo '<script>alert("Berhasil menyimpan data."); document.location="index.php?page=tampil_mhs";</script>';
			}else{
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}
		?>

		<form action="index.php?page=edit_mhs&Nim=<?php echo $Nim; ?>" method="post">
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nim</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="Nim" class="form-control" size="4" value="<?php echo $data['Nim']; ?>" readonly required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nama Mahasiswa</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="Nama_Mhs" class="form-control" value="<?php echo $data['Nama_Mhs']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kelamin</label>
				<div class="col-md-6 col-sm-6 ">
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
							<input type="radio" class="join-btn" name="Jenis_Kelamin" value="Laki-Laki" <?php if($data['Jenis_Kelamin'] == 'Laki-Laki'){ echo 'checked'; } ?> required>Laki-Laki
						</label>
						<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
							<input type="radio" class="join-btn" name="Jenis_Kelamin" value="Perempuan" <?php if($data['Jenis_Kelamin'] == 'Perempuan'){ echo 'checked'; } ?> required>Perempuan
						</label>
					</div>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Program Studi</label>
				<div class="col-md-6 col-sm-6">
					<select name="Program_Studi" class="form-control" required>
						<option value="">Pilih Program Studi</option>
						<option value="Bisnis Digital" <?php if($data['Program_Studi'] == 'Bisnis Data'){ echo 'selected'; } ?>>Bisnis Data</option>
						<option value="Teknik Industri" <?php if($data['Program_Studi'] == 'Teknik Industri'){ echo 'selected'; } ?>>Teknik Industri</option>
						<option value="Sistem Informasi" <?php if($data['Program_Studi'] == 'Sistem Informatika'){ echo 'selected'; } ?>>Sistem Informatika</option>
						<option value="Fakultas Farmasi" <?php if($data['Program_Studi'] == 'Fakultas Farmasi'){ echo 'selected'; } ?>>Fakultas Farmasi</option>
						<option value="Teknik Iformatika" <?php if($data['Program_Studi'] == 'Teknik Informatika'){ echo 'selected'; } ?>>Teknik Informatika</option>
						<option value="Teknik Elektro" <?php if($data['Program_Studi'] == 'Teknik Elektro'){ echo 'selected'; } ?>>Teknik Elektro</option>
						<option value="Teknik Mesin" <?php if($data['Program_Studi'] == 'Teknik Mesin'){ echo 'selected'; } ?>>Teknik Mesin</option>
						<option value="Teknik Sipil" <?php if($data['Program_Studi'] == 'Teknik Sipil'){ echo 'selected'; } ?>>Teknik Sipil</option>
					</select>
				</div>
			</div>

			<?php

				$select = mysqli_query($koneksi, "SELECT * FROM dosen") or die(mysqli_error($koneksi));
			

			?>

			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Dosen Pembimbing</label>
				<div class="col-md-6 col-sm-6">
					<select name="id_dosen" class="form-control" required>
						<option value="">Pilih Pembimbing</option>
 

						<?php while($dosen = mysqli_fetch_array($select)){ ?>
							<option value="<?=$dosen['Nip']?>" <?php if($data['Nip'] == $dosen['Nip']){ echo 'selected'; } ?>><?=$dosen['Nama_Dsn']?></option>
						<?php } ?>


					</select>
				</div>
			</div>

			<div class="item form-group">
				<div class="col-md-6 col-sm-6 offset-md-3">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
					<a href="index.php?page=tampil_mhs" class="btn btn-warning">Kembali</a>
				</div>
			</div>
		</form>
	</div>