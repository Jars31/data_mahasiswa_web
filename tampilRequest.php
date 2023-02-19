<?php
//memasukkan file config.php
include('config.php');
?>


	<div class="container" style="margin-top:20px">
		<center><font size="6">Data Request</font></center>
		<hr>
		<div class="table-responsive">
		<table id="example" class="display" style="width:100%">
			<thead>
				<tr>
					<th>NO.</th>
					<th>Nama</th>
					<th>Departemen</th>
					<th>Request</th>
                    <th>Modul</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//query ke database SELECT tabel request urut berdasarkan id yang paling besar
				$query = "SELECT r.id, r.nama, r.departemen, r.request, r.modul, m.module_name
							FROM request r  	
							LEFT JOIN module m ON r.modul = m.id
							ORDER BY r.id DESC";
				$sql = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
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
							<td>'.$data['nama'].'</td>
							<td>'.$data['departemen'].'</td>
							<td>'.$data['request'].'</td>
                            <td>'.$data['module_name'].'</td>
							<td>
								<a href="index.php?page=edit_request&id='.$data['id'].'" class="btn btn-secondary btn-sm">Edit</a>
								<a href="deleteRequest.php?id='.$data['id'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
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