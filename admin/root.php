<?php
require_once "../config.php";

class admin
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
		$eror = array();
		if (trim($_POST['username']) == '') {
			$eror[] = 'username';
		}
		if (trim($_POST['password']) == '') {
			$eror[] = 'password';
		}
		if (!empty($eror)) { // changed isset to !empty for array
			echo "<div id='gagal'><img style='width:16px;height:15px' src='asset/loading/load.gif' alt='loading...' /> Opps, sepertinya " . implode(" dan ", $eror) . " anda kosong</div>";
		} else {
			$username = $this->conn->real_escape_string($username);
			$password = $this->conn->real_escape_string($password);
			$query = $this->conn->query("select * from admin where username='$username' and password='$password'");
			$row = $query->fetch_array();
			$report = $query->num_rows;
			if ($report > 0) {
				session_start();
				$_SESSION['id'] = $row['id'];
				echo "<div id='sukses'><img style='width:16px;height:15px' src='asset/loading/load.gif' alt='loading...' /> Login sukses, anda akan segera diarahkan ke halaman utama</div>";
				?>
				<script type="text/javascript">
					window.setTimeout(function () { window.location.href = "home.php" }, 1500);
				</script>
				<?php
			} else {
				echo "<div id='gagal'><img style='width:16px;height:15px' src='asset/loading/load.gif' alt='loading...' /> Opps, Sepertinya Username atau Password anda salah</div>";
			}
		}
	}

	function lihat_produk()
	{
		$query = $this->conn->query("select * from produk order by id desc");
		$hasil = [];
		while ($r = $query->fetch_array()) {
			$hasil[] = $r;
		}
		return $hasil;
	}

	function tambah_katalog($nama_katalog)
	{
		$nama_katalog = $this->conn->real_escape_string($nama_katalog);
		$this->conn->query("INSERT INTO katalog SET nama_katalog='$nama_katalog'") or die($this->conn->error);
		?>
		<script>
			alert("barang berhasil di tambahkan");
			window.location.href = "home.php?aksi=tambah_katalog";
		</script>
		<?php
	}

	function tambah_kelompok($nama)
	{
		$nama = $this->conn->real_escape_string($nama);
		$this->conn->query("INSERT INTO kelompok SET nama ='$nama'") or die($this->conn->error);
		?>
		<script>
			alert("barang berhasil di tambahkan");
			window.location.href = "home.php?aksi=tambah_kelompok";
		</script>
		<?php
	}

	function tambah_produk($nama_produk, $harga, $qty, $gambar, $kelompok, $katalog, $kategori, $ket)
	{
		$nama_produk = $this->conn->real_escape_string($nama_produk);
		$kelompok = $this->conn->real_escape_string($kelompok);
		$katalog = $this->conn->real_escape_string($katalog);
		$ket = $this->conn->real_escape_string($ket);
		$kategori = $this->conn->real_escape_string($kategori);
		// Assuming harga and qty are numbers, but escaping is safe

		$this->conn->query("insert into produk set nama_produk='$nama_produk',harga='$harga',gambar='$gambar',kelompok='$kelompok',katalog='$katalog',ket='$ket',qty='$qty',kategori='$kategori'");
		?>
		<script>
			alert("barang berhasil di tambahkan");
			window.location.href = "home.php?aksi=tambah_produk";
		</script>
		<?php
	}

	function member()
	{
		$query = $this->conn->query("select * from pembeli order by id_pembeli desc");
		$hasil = [];
		while ($r = $query->fetch_array()) {
			$hasil[] = $r;
		}
		return $hasil;
	}

	function logout()
	{
		session_start();
		unset($_SESSION['username']);
		session_destroy();
		header("location:index.php");
	}

	function selesai()
	{
		$query = $this->conn->query("select * from selesai");
		$hasil = [];
		while ($r = $query->fetch_array()) {
			$hasil[] = $r;
		}
		return $hasil;
	}

	function konfir($id)
	{
		$id = $this->conn->real_escape_string($id);
		$y = "Y";
		$this->conn->query("update selesai set konfir='$y' where id='$id'");
		header("location:home.php?aksi=pesan");
	}

	function konfir_kirim($id)
	{
		$id = $this->conn->real_escape_string($id);
		$k = "K";
		$this->conn->query("update selesai set konfir='$k' where id='$id'");
		header("location:home.php?aksi=pesan");
	}

	function konfir_kirim_kota($id)
	{
		$id = $this->conn->real_escape_string($id);
		$kk = "KK";
		$this->conn->query("update selesai set konfir='$kk' where id='$id'");
		header("location:home.php?aksi=pesan");
	}

	function konfir_terima($id)
	{
		$id = $this->conn->real_escape_string($id);
		$t = "T";
		$this->conn->query("update selesai set konfir='$t' where id='$id'");
		header("location:home.php?aksi=pesan");
	}

	function konfir_selesai($id)
	{
		$id = $this->conn->real_escape_string($id);
		$s = "S";
		$this->conn->query("update selesai set konfir='$s' where id='$id'");
		header("location:home.php?aksi=pesan");
	}
}
?>