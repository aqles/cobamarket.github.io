<?php
require_once "config.php";

class data
{
	public $conn;

	function __construct()
	{
		$this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		}
		$this->conn->set_charset("utf8mb4");
	}

	function login($username, $password)
	{
		$username = $this->conn->real_escape_string($username);
		$query = $this->conn->query("select * from pembeli where username='$username'");
		$check = $query->num_rows;
		$data = $query->fetch_array();

		if ($check > 0 && password_verify($password, $data['password'])) {
			session_start();
			$_SESSION['pembeli'] = $data['username'];
			$_SESSION['id_pembeli'] = $data['id_pembeli'];
			header("location:index.php");
		} else {
			?>
			<script>
				alert("login gagal, mungkin username atau password anda salah");
				window.location.href = "login.php";
			</script>
			<?php
		}
	}

	function daftar_pelanggan($username, $nama_lengkap, $email, $password, $alamat, $provinsi, $kabupaten, $kecamatan, $kode_pos, $no_telp)
	{
		$username = $this->conn->real_escape_string($username);
		$nama_lengkap = $this->conn->real_escape_string($nama_lengkap);
		$email = $this->conn->real_escape_string($email);

		// Hash the password
		$password = password_hash($password, PASSWORD_DEFAULT);

		$alamat = $this->conn->real_escape_string($alamat);
		$provinsi = $this->conn->real_escape_string($provinsi);
		$kabupaten = $this->conn->real_escape_string($kabupaten);
		$kecamatan = $this->conn->real_escape_string($kecamatan);
		$kode_pos = $this->conn->real_escape_string($kode_pos);
		$no_telp = $this->conn->real_escape_string($no_telp);

		$query = "INSERT into pembeli SET username='$username',nama_lengkap='$nama_lengkap',email='$email',password='$password',alamat='$alamat',provinsi='$provinsi',kabupaten='$kabupaten',kecamatan='$kecamatan',kode_pos='$kode_pos',no_telp='$no_telp'";
		$this->conn->query($query) or die($this->conn->error);
		?>
		<script>
			alert("Selamat Bergabung & Selamat Datang Di TERATE STORE");
			window.location.href = "index.php";
		</script>
		<?php
	}

	function tampil_produk_elektronik_list()
	{
		$query = $this->conn->query("SELECT * from produk where kelompok='elektronik' order by id desc");
		while ($r = $query->fetch_array()) {
			?>
			<div class="col-md-3 product-grids">
				<div class="agile-products">
					<div class="new-tag">
						<h6><?php echo $r['diskon']; ?></h6>
					</div>
					<a href="single.php"><img src="admin/<?php echo $r['gambar'] ?>" class="img-responsive" alt="img"
							style="width: 200px; height: 150px;"></a>
					<div class="agile-product-text">
						<h5><a href="single.php"><?php echo $r['nama_produk']; ?></a></h5>
						<h6>Rp.<?php echo number_format($r['harga'], 0, ',', '.'); ?></h6>
						<form action="#" method="post">
							<input type="hidden" name="cmd" value="_cart" />
							<input type="hidden" name="add" value="1" />
							<input type="hidden" name="w3ls_item" value="<?php echo $r['nama_produk']; ?>" />
							<input type="hidden" name="amount" value="<?php echo $r['harga']; ?>" />
							<button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i>
								Add to cart</button>
						</form>
					</div>
				</div>
			</div>
			<?php
		}
	}

	function tampil_produk_rekomendasi()
	{
		$query = $this->conn->query("SELECT * from produk where kelompok='pakaian' order by id desc");
		while ($r = $query->fetch_array()) {
			?>
			<div class="item">
				<div class="glry-w3agile-grids agileits">
					<div class="new-tag">
						<h6><?php echo $r['diskon']; ?></h6>
					</div>
					<a href="products1.php"><img src="admin/<?php echo $r['gambar'] ?>" alt="img"></a>
					<div class="view-caption agileits-w3layouts">
						<h4><a href="products1.php"><?php echo $r['nama_produk']; ?></a></h4>

						<h5><?php echo number_format($r['harga'], 0, ',', '.'); ?></h5>
						<a href="detail.php?id_barang=<?php echo $r['id'] ?>"><button type="submit" class="w3ls-cart"><i
									class="fa fa-cart-plus"></i> Beli</button></a>
					</div>
				</div>
			</div>
			<?php
		}
	}

	function tampil_produk_elektronik()
	{
		$query = $this->conn->query("SELECT * from produk where kategori='Elektronik' order by id desc LIMIT 10");
		while ($r = $query->fetch_array()) {
			?>
			<div class="item">
				<div class="glry-w3agile-grids agileits">
					<a href="elektronik.php"><img src="admin/<?php echo $r['gambar'] ?>" alt="img"
							style="width: 200px; height: 200px;"></a>
					<div class="view-caption agileits-w3layouts">
						<h4><a href="elektronik.php" style="color: #fff"><?php echo $r['nama_produk']; ?></a></h4>

						<h5 style="float: left;">Rp.<?php echo number_format($r['harga'], 0, ',', '.'); ?></h5>
						<a href="detail.php?id_barang=<?php echo $r['id'] ?>"><button type="submit" class="w3ls-cart"><i
									class="fa fa-cart-plus"></i> Beli</button></a>
					</div>
				</div>
			</div>
			<?php
		}
	}

	function tampil_produk_olahraga()
	{
		$query = $this->conn->query("SELECT * from produk where kelompok='olahraga' order by id desc LIMIT 10");
		while ($r = $query->fetch_array()) {
			?>
			<div class="item">
				<div class="glry-w3agile-grids agileits">
					<a href="detail.php?id_barang=<?php echo $r['id'] ?>"><img src="admin/<?php echo $r['gambar'] ?>" alt="img"
							style="width: 200px; height: 200px;"></a>
					<div class="view-caption agileits-w3layouts">
						<h4><a href="products.php" style="color: #fff"><?php echo $r['nama_produk']; ?></a></h4>

						<h5 style="float: left;">Rp.<?php echo number_format($r['harga'], 0, ',', '.'); ?></h5>
						<a href="detail.php?id_barang=<?php echo $r['id'] ?>"><button type="submit" class="w3ls-cart"><i
									class="fa fa-cart-plus"></i> Beli</button></a>
					</div>
				</div>
			</div>
			<?php
		}
	}

	function tampil_produk_pakaian()
	{
		$query = $this->conn->query("SELECT * from produk where kelompok='pakaian' order by id desc LIMIT 5");
		while ($r = $query->fetch_array()) {
			?>
			<div class="item">
				<div class="glry-w3agile-grids agileits">
					<a href="detail.php?id_barang=<?php echo $r['id'] ?>"><img src="admin/<?php echo $r['gambar'] ?>" alt="img"
							style="width: 200px; height: 200px;"></a>
					<div class="view-caption agileits-w3layouts">
						<h4><a href="fashion.php" style="color: #fff"><?php echo $r['nama_produk']; ?></a></h4>

						<h5 style="float: left;">Rp.<?php echo number_format($r['harga'], 0, ',', '.'); ?></h5>

						<a href="detail.php?id_barang=<?php echo $r['id'] ?>"><button type="submit" class="w3ls-cart"><i
									class="fa fa-cart-plus"></i> Beli</button></a>

					</div>
				</div>
			</div>
			<?php
		}
	}

	function tampil_produk_fashion()
	{
		$query = $this->conn->query("SELECT * from produk where kelompok='pakaian' order by id desc");
		while ($r = $query->fetch_array()) {
			?>
			<div class="col-md-3 product-grids">
				<div class="agile-products">
					<div class="new-tag">
						<h6><?php echo $r['diskon']; ?></h6>
					</div>
					<a href="single.php"><img src="admin/<?php echo $r['gambar'] ?>" class="img-responsive" alt="img"
							style="width: 200px; height: 150px;"></a>
					<div class="agile-product-text">
						<h5><a href="single.php"><?php echo $r['nama_produk']; ?></a></h5>
						<h6>Rp.<?php echo number_format($r['harga'], 0, ',', '.'); ?></h6>

						<a href="detail.php?id_barang=<?php echo $r['id'] ?>><button type=" submit" class="w3ls-cart"><i
								class="fa fa-cart-plus" aria-hidden="true"></i> Beli</button></a>

					</div>
				</div>
			</div>
			<?php
		}
	}

	function tampil_pro()
	{
		$query = $this->conn->query("select * from produk");
		$hasil = [];
		while ($r = $query->fetch_array()) {
			$hasil[] = $r;
		}
		return $hasil;
	}

	function get_one($id_barang)
	{
		$id_barang = $this->conn->real_escape_string($id_barang);
		$query = $this->conn->query("select * from produk where id='$id_barang'");
		$aray = $query->fetch_array();
		return $aray;
	}

	function beli($id_pembeli, $id_barang, $nama_produk, $gambar, $qty, $harga, $kategori, $keterangan, $jasa_pengiriman)
	{
		$id_pembeli = $this->conn->real_escape_string($id_pembeli);
		$id_barang = $this->conn->real_escape_string($id_barang);
		// ... escape others ...
		$nama_produk = $this->conn->real_escape_string($nama_produk);
		$kategori = $this->conn->real_escape_string($kategori);
		$keterangan = $this->conn->real_escape_string($keterangan);
		$jasa_pengiriman = $this->conn->real_escape_string($jasa_pengiriman);

		$query = $this->conn->query("INSERT into produk_temp set id_pembeli='$id_pembeli',id_produk='$id_barang',nama_produk='$nama_produk',harga='$harga',total_harga='$harga',gambar='$gambar',qty_beli='1',qty_asli='$qty',kategori='$kategori',ket='$keterangan',jasa_pengiriman='$jasa_pengiriman'");
		$qtyy = $qty - 1;
		$this->conn->query("update produk set qty='$qtyy' where id='$id_barang'");
		header('location:checkout.php');
	}

	function produk_temp($id_pembeli)
	{
		$id_pembeli = $this->conn->real_escape_string($id_pembeli);
		$data = $this->conn->query("select * from produk_temp where id_pembeli='$id_pembeli'");
		$hasil = [];
		while ($r = $data->fetch_array()) {
			$hasil[] = $r;
		}
		return $hasil;
	}

	// New method for cart count
	function get_cart_count($id_pembeli)
	{
		$id_pembeli = $this->conn->real_escape_string($id_pembeli);
		$keranjang = $this->conn->query("select * from produk_temp where id_pembeli='$id_pembeli'");
		return $keranjang->num_rows;
	}

	function temp_jumlah($id_pembeli)
	{
		$id_pembeli = $this->conn->real_escape_string($id_pembeli);
		$data = $this->conn->query("select * from produk_temp where id_pembeli='$id_pembeli'");
		$row = $data->num_rows;
		return $row;
	}

	function logout()
	{
		session_start();
		unset($_SESSION['pembeli']);
		?>
		<script>
			alert("Anda Berhasil Logout");
			window.location.href = "index.php"
		</script>
		<?php
	}

	function batalkan($id)
	{
		$id = $this->conn->real_escape_string($id);
		$data = $this->conn->query("select * from produk_temp where id='$id'");
		$balik = $data->fetch_array();
		$qty = $balik['qty_asli'] + $balik['qty_beli'];
		$this->conn->query("update produk set qty='$qty' where id='" . $balik['id_produk'] . "'");
		$this->conn->query("delete from produk_temp where id='$id'");
		header("location:checkout.php");
	}

	function qtytambah($id, $id_produk, $qty, $harga)
	{
		$id = $this->conn->real_escape_string($id);
		$id_produk = $this->conn->real_escape_string($id_produk);

		$qtyy = $qty + 1;
		$qty2 = $qtyy - 1; // Logic seems weird but keeping it
		$harga2 = $harga * $qtyy;
		$this->conn->query("update produk_temp set qty_beli='$qtyy',qty_asli='$qty2',total_harga='$harga2' where id='$id'");
		$produk = $this->conn->query("select * from produk where id='$id_produk'");
		$ganti = $produk->fetch_array();
		$qtyproduk = $ganti['qty'] - 1;
		$this->conn->query("update produk set qty='$qtyproduk' where id='$id_produk'");
		header("location:checkout.php");
	}

	function qtykurang($id, $id_produk, $qty, $harga)
	{
		$id = $this->conn->real_escape_string($id);
		$id_produk = $this->conn->real_escape_string($id_produk);

		$qtyy = $qty - 1;
		$qty2 = $qtyy + 1;
		$harga2 = $harga * $qtyy;
		$this->conn->query("update produk_temp set qty_beli='$qtyy',qty_asli='$qty2',total_harga='$harga2' where id='$id'");
		$produk = $this->conn->query("select * from produk where id='$id_produk'");
		$ganti = $produk->fetch_array();
		$qtyproduk = $ganti['qty'] + 1;
		$this->conn->query("update produk set qty='$qtyproduk' where id='$id_produk'");
		header("location:checkout.php");
	}

	function total_bayar($id_pembeli)
	{
		$query = $this->conn->query("select sum(total_harga) as total from produk_temp where id_pembeli='$id_pembeli'");
		$fetch = $query->fetch_array();
		$total = $fetch['total']; // Fixed: 'total' string key
		return $total;
	}

	function pilih_orang($id_pembeli)
	{
		$query = $this->conn->query("select * from pembeli where id_pembeli='$id_pembeli'");
		$aray = $query->fetch_array();
		return $aray['alamat'];
	}

	function pilih_orang_kabupaten($id_pembeli)
	{
		$query = $this->conn->query("select * from pembeli where id_pembeli='$id_pembeli'");
		$aray = $query->fetch_array();
		return $aray['kabupaten'];
	}

	function pilih_orang_kecamatan($id_pembeli)
	{
		$query = $this->conn->query("select * from pembeli where id_pembeli='$id_pembeli'");
		$aray = $query->fetch_array();
		return $aray['kecamatan'];
	}

	function pilih_orang_provinsi($id_pembeli)
	{
		$query = $this->conn->query("select * from pembeli where id_pembeli='$id_pembeli'");
		$aray = $query->fetch_array();
		return $aray['provinsi'];
	}

	function pilih_orang_kode_pos($id_pembeli)
	{
		$query = $this->conn->query("select * from pembeli where id_pembeli='$id_pembeli'");
		$aray = $query->fetch_array();
		return $aray['kode_pos'];
	}

	function pilih_orang_no_telp($id_pembeli)
	{
		$query = $this->conn->query("select * from pembeli where id_pembeli='$id_pembeli'");
		$aray = $query->fetch_array();
		return $aray['no_telp'];
	}

	function pilih_orang_jasa_pengiriman($id_pembeli)
	{
		$query = $this->conn->query("select * from produk_temp where id_pembeli='$id_pembeli'");
		$aray = $query->fetch_array();
		return $aray['jasa_pengiriman'];
	}

	function selesaibelanja($id_pembeli, $nama, $jumlah_barang, $jumlah_bayar, $tanggal_beli, $alamat, $kabupaten, $kecamatan, $provinsi, $kode_pos, $no_telp, $jasa_pengiriman)
	{
		if ($jumlah_bayar == 0) {
			?>
			<script>
				alert("Keranjang anda masih kosong");
				window.location.href = "index.php";
			</script>
			<?php
		} else {
			$query = $this->conn->query("INSERT into selesai set id_pembeli='$id_pembeli',nama='$nama',jumlah_barang='$jumlah_barang',jumlah_bayar='$jumlah_bayar',tanggal_beli='$tanggal_beli',alamat='$alamat',kabupaten='$kabupaten',kecamatan='$kecamatan',provinsi='$provinsi',kode_pos='$kode_pos',no_telp='$no_telp',jasa_pengiriman='$jasa_pengiriman',konfir='N'");
			$this->conn->query("delete from produk_temp where id_pembeli='$id_pembeli'");
			$rand = rand();
			header("location:finish.php?nama=$nama&jumlah_barang=$jumlah_barang&tanggal_beli=$tanggal_beli&alamat=$alamat&kabupaten=$kabupaten&kecamatan=$kecamatan&provinsi=$provinsi&kode_pos='$kode_pos'&no_telp='$no_telp'&jasa_pengiriman='$jasa_pengiriman'&bayar=$jumlah_bayar&kode=$rand");
		}
	}

	function konfirmasi($kode_pembelian, $id_vendor, $nama_bank, $tgl, $pesan, $gambar)
	{
		$s = $this->conn->query("INSERT INTO konfirmasi set kode_pembelian='$kode_pembelian',id_vendor='$id_vendor',nama_bank='$nama_bank',tgl='$tgl',pesan='$pesan',gambar='$gambar' ");
		?>
		<script type="text/javascript">
			alert("Anda Telah Berhasil Melakukan Konfirmasi Pembayaran");
			window.location.href = "index.php"
		</script>
		<?php
	}

	function selesai($id)
	{
		$query = $this->conn->query("select * from selesai where id_pembeli='$id'");
		$hasil = [];
		while ($r = $query->fetch_array()) {
			$hasil[] = $r;
		}
		return $hasil;
	}
	function get_products_by_category($category)
	{
		$category = $this->conn->real_escape_string($category);
		// Note: The database uses 'kelompok' for broad categories like 'elektronik', 'pakaian', etc.
		// It also has a 'kategori' column which seems less consistent. 
		// We will try to match 'kelompok' first.
		$query = $this->conn->query("SELECT * from produk where kelompok='$category' OR kategori='$category' order by id desc");
		$hasil = [];
		while ($r = $query->fetch_array()) {
			$hasil[] = $r;
		}
		return $hasil;
	}

	function get_product_by_id($id)
	{
		$id = $this->conn->real_escape_string($id);
		$query = $this->conn->query("SELECT * from produk where id='$id'");
		return $query->fetch_array();
	}
}
?>