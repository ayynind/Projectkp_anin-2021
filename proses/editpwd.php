<?php
//cek status login
include "../include/auth.php"; 

//file configurasi
include "../include/config.php";

//fungsi tambahan
include "../include/form.php";
 
//title page
$titlepage = "Ubah Password";

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
                //proses login
								if(isset($_POST['submit'])){
									
									$get		= mysqli_query($connect, "SELECT * FROM user WHERE id_user = '$idusr'");
									$data		= mysqli_fetch_array($get);
									$old		= md5($_POST['old']);

									if($old != $data['password']){
										echo '<div class="alert alert-error">
														<button type="button" class="close" data-dismiss="alert">×</button>
														<strong>Ups!</strong> Password kamu salah 
													</div>';
									}
									else{
                    if(empty($_GET['id'])){
                      $idp = $data['id_user'];
                    }
                    else{
                      $idp = $_GET['id'];
                    }  
										$token	= generate(12);
										$query = mysqli_query($connect, "UPDATE user SET token = '$token' WHERE id_user = '$idusr'");

										echo "<script>
													location.href='change_password.php?token=".$token." && id=".$idp."'
													</script>";
									}
								}
              ?>

              <div class="alert">
                Kamu harus login terlebih dahulu untuk melanjutkan!
              </div>

              <?php
								buka_form();

									buat_textbox('Username','user','',$usrnm,'disabled');
									buat_passbox('Password','old','Masukan Password','required autofocus');
							?>

              <div class="control-group">
                <div class="controls">
                  <a href="#" class="btn btn-module">
                    <i class="icon-arrow-left"></i> Kembali
                  </a>

                  <button name="submit" type="submit" class="btn btn-primary">Lanjut
                    <i class="icon-arrow-right"></i>
                  </button>
                </div>
              </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
<?php include "../include/footer.php";?>