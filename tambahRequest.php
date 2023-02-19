<?php include('config.php'); ?>
<?php
 
?>
		<center><font size="6">Add Data</font></center>
		<hr>
		<?php
		if(isset($_POST['submit'])){
			$nama	    = addslashes($_POST['nama']);
			$departemen	= addslashes($_POST['departemen']);
			$request	= addslashes($_POST['request']);
            $modul	    = addslashes($_POST['modul']);
            $created_by	    = $_SESSION['username'];
            $created_date	    = date("Y-m-d H:i:s");
			$modified_by	    = $_SESSION['username'];
			$modified_date	    = date("Y-m-d H:i:s");

			$cek = mysqli_query($koneksi, "SELECT * FROM request WHERE nama='$nama'") or die(mysqli_error($koneksi));

			if(mysqli_num_rows($cek) == 0){
				$query = "INSERT INTO request (nama, departemen, request, modul, created_by, created_date, modified_by, modified_date) 
							VALUES('$nama', '$departemen', '$request', '$modul', '$created_by', '$created_date', '$modified_by', '$modified_date')";
				
				$sql = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

				if($sql){
					echo '<script>alert("Berhasil menambahkan data."); document.location="index.php?page=tampil_request";</script>';
				}else{
					echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
				}
			}else{
				echo '<div class="alert alert-warning">Gagal, id sudah terdaftar.</div>';
			}
		}
		?>

		<form action="index.php?page=tambah_request" method="post">

			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nama</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="nama" class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Departmen</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="departemen" class="form-control"  required>
				</div>
			</div>
            <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Request</label>
				<div class="col-md-6 col-sm-6">
					<textarea name="request" class="form-control" placeholder="Write your request here..." required></textarea>
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
				<div  class="col-md-6 col-sm-6 offset-md-3">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
					<a href="index.php?page=tampil_request" class="btn btn-warning">Kembali</a>
			</div>
		</form>
	</div>