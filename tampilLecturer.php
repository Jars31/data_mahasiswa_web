<?php
//memasukkan file config.php
include('config.php');
?>


	<div class="container" style="margin-top:20px">
		<center><font size="6">Data </font></center>
		<hr>
		<div class="table-responsive">
		<table id="example" class="display" style="width:100%">
			<thead>
				<tr>
					<th>NO.</th>
					<th>NIP</th>
					<th>Nama Dosen</th>
					<th>Jenis Kelamin</th>
					<th>Program Studi</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//query ke database SELECT tabel dosen urut berdasarkan id yang paling besar
				$sql = mysqli_query($koneksi, "SELECT * FROM dosen ORDER BY Nip DESC") or die(mysqli_error($koneksi));
				//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
				if(mysqli_num_rows($sql) > 0){
					//membuat variabel $no untuk menyimpan nomor urut
					$no = 1;
					//melakukan perulangan while dengan dari dari query $sql
					while($data = mysqli_fetch_assoc($sql)){
						//menampilkan data perulangan
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$data['Nip'].'</td>
							<td>'.$data['Nama_Dsn'].'</td>
							<td>'.$data['Jenis_Kelamin'].'</td>
							<td>'.$data['Program_Studi'].'</td>
							<td>
								<a href="index.php?page=edit_dsn&Nip='.$data['Nip'].'" class="btn btn-secondary btn-sm">Edit</a>
								<a href="deleteLecturer.php?Nip='.$data['Nip'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
							</td>
						</tr>
						';
						$no++;
					}
				//jika query menghasilkan nilai 0
				}else{
					echo '
					<tr>
						<td colspan="6">Tidak ada data.</td>
					</tr>
					';
				}
				?>
			<tbody>
		</table>
	</div>
	</div>