<?php include('config.php'); ?>

		<center><font size="6">Add Data</font></center>
		<hr>
		<?php
		if(isset($_POST['submit'])){
			$Nim			= addslashes($_POST['Nim']);
			$Nama_Mhs		= addslashes($_POST['Nama_Mhs']);
			$Jenis_Kelamin	= addslashes($_POST['Jenis_Kelamin']);
			$Program_Studi	= addslashes($_POST['Program_Studi']);
			$id_dosen       = addslashes($_POST['id_dosen']); 
			$created_by	    = $_SESSION['username'];
            $created_date	    = date("Y-m-d H:i:s");
			$modified_by	    = $_SESSION['username'];
			$modified_date	    = date("Y-m-d H:i:s");

			$cek = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE Nim='$Nim'") or die(mysqli_error($koneksi));

			if(mysqli_num_rows($cek) == 0){
				$query = "INSERT INTO mahasiswa (Nim, Nama_Mhs, Jenis_Kelamin, Program_Studi, id_dosen, created_by, created_date, modified_by, modified_date) 
							VALUES('$Nim', '$Nama_Mhs', '$Jenis_Kelamin', '$Program_Studi', '$id_dosen', '$created_by', '$created_date', '$modified_by', '$modified_date')";
				
				$sql = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

				if($sql){
					echo '<script>alert("Berhasil menambahkan data."); document.location="index.php?page=tampil_mhs";</script>';
				}else{
					echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
				}
			}else{
				echo '<div class="alert alert-warning">Gagal, NIM sudah terdaftar.</div>';
			}
		}
		?>

		<form action="index.php?page=tambah_mhs" method="post">
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nim</label>
				<div class="col-md-6 col-sm-6 ">
					<input type="text" name="Nim" class="form-control" size="4" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nama Mahasiswa</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="Nama_Mhs" class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kelamin</label>
				<div class="col-md-6 col-sm-6 ">
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
							<input type="radio" class="join-btn" name="Jenis_Kelamin" value="Laki-Laki" required>Laki-Laki
						</label>
						<label class="btn btn-primary " data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
							<input type="radio" class="join-btn" name="Jenis_Kelamin" value="Perempuan" required>Perempuan
						</label>
					</div>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Program Studi</label>
				<div class="col-md-6 col-sm-6">
					<select name="Program_Studi" class="form-control" required>
						<option value="">Pilih Program Studi</option>
						<option value="Bisnis Digital">Bisnis Digital</option>
						<option value="Teknik Industri">Teknik Industri</option>
						<option value="Sistem Infomarsi">Sistem Informasi</option>
						<option value="Fakultas Farmasi">Fakultas Farmasi</option>
						<option value="Teknik Informatika">Teknik Informatika</option>
						<option value="Teknik Elektro">Teknik Elektro</option>
						<option value="Teknik Mesin">Teknik Mesin</option>
						<option value="Teknik Sipil">Teknik Sipil</option>
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
				<div  class="col-md-6 col-sm-6 offset-md-3">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
					<a href="index.php?page=tampil_mhs" class="btn btn-warning">Kembali</a>
			</div>
		</form>
	</div>