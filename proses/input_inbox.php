<?php
//cek status login
include "../include/auth.php"; 

//file configurasi
include "../include/config.php";

//proses input
if(isset($_POST['submit'])){
	
	$no_surat		= $_POST['no_surat'];
	$jenis				= $_POST['jenis'];
	$tgl_kirim		= $_POST['tgl_kirim'];
	$tgl_terima	= $_POST['tgl_terima'];
	$pengirim		= $_POST['pengirim'];
	$perihal			= $_POST['perihal'];

	$sql	= mysqli_query($connect, "SELECT * FROM inbox WHERE no_surat = '$no_surat'");
	$cek	= mysqli_num_rows($sql);

	if($cek > 0){
		echo "<script>alert('Nomor Surat Sudah digunakan!')</script>";
	}
	else{
		$query = mysqli_query($connect, "INSERT INTO inbox VALUES ('','$jenis','$tgl_kirim','$tgl_terima','$no_surat','$pengirim','$perihal')");

		echo "<script>
					alert('Data berhasil ditambah')
					</script>
					
					<script>
					location.href='../inbox.php'
					</script>";
	}
}
 
//fungsi tambahan
include "../include/form.php";
 
//title page
$titlepage = "Input Surat Masuk";

//header aplikasi
include "../include/header_user.php";

?>

<div class="wrapper">
  <div class="container">

    <div class="row">
      <?php include "../include/menu_user.php";?>

      <div class="span9">
        <div class="content">

          <div class="module">
            <div class="module-head">
              <h2><?php echo $titlepage;?> </h2>
            </div>

            <div class="module-body">

              <?php
								buka_form();
									
									buat_textbox('Nomor Surat','no_surat','','','required');
									
									$list[]	= array('val' => '', 'cap' => '--Pilih Jenis Surat--');
									$list[]	= array('val' => 'Surat Biasa', 'cap' => 'Surat Biasa');
									$list[] = array('val' => 'Surat Keputusan', 'cap' => 'Surat Keputusan');
									$list[]	= array('val' => 'Surat Perintah', 'cap' => 'Surat Perintah');
									
									buat_combobox('Jenis Surat','jenis',$list,'');
									buat_datebox('Tanggal Kirim','tgl_kirim','','required');
									buat_datebox('Tanggal Terima','tgl_terima','','required');
									buat_textbox('Pengirim','pengirim','Masukan Nama Pengirim','','required');
									buat_textbox('Perihal','perihal','Example Liburan Akhir Tahun','','required');
								
								tutup_form('Simpan','../inbox.php');
							?>

            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

<!--footer aplikasi-->
<?php include "../include/footer.php";?>