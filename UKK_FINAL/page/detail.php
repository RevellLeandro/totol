<?php 
$details=mysqli_query($conn, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid WHERE foto.fotoid='$_GET[id]'");
$data=mysqli_fetch_array($details);
$likes=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$_GET[id]'"));
$cek=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$_GET[id]' AND userid='".@$_SESSION['user_id']."'"));
?>
<div class="container">
   <div class="row">
      <div class="col-6">
         <div class="card">
            <img src="uploads/<?= $data['lokasifile'] ?>" alt="<?= $data['judulfoto'] ?>" class="object-fit-cover" style="max-width: 100%; height: auto; max-height: 400px;">
            <div class="card-body">
               <h3 class="card-title mb-0"><?= $data['judulfoto'] ?> <a href="<?php if(isset($_SESSION['user_id'])){echo '?url=like&&id='.$data['fotoid'].'';}else{echo 'login.php';} ?>" class="btn-dark btn btn-sm"><?php if($cek==0){echo 'Like';}else{echo 'Dislike';} ?> <?= $likes ?></a></h3>
               <small class="text-muted mb-3">by:<?= $data['username'] ?>, <?= $data['tanggalungah'] ?></small>
               <p><?= $data['deskripsifoto'] ?></p>
               <?php 
               //ambil data komentar
               $komen_id=@$_GET["komentar_id"];
               $submit=@$_POST['submit'];
               $komentar=@$_POST['komentar'];
               $foto_id=@$_POST['foto_id'];
               $user_id=@$_SESSION['user_id'];
               $tanggal=date('Y-m-d');
               $dataKomentar=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM komentarfoto WHERE komentarid='$komen_id' AND userid='$user_id' AND fotoid='$foto_id'"));
               if ($submit=='Kirim') {
                  $komen=mysqli_query($conn, "INSERT INTO komentarfoto VALUES('','$foto_id','$user_id','$komentar','$tanggal')");
                  header("Location: ?url=detail&&id=$foto_id");
               }elseif($submit=='Edit'){
                  
               }

               ?>
               <form action="?url=detail" method="post">
                  <div class="form-group d-flex flex-row">
                     <input type="hidden" name="foto_id" value="<?= $data['fotoid'] ?>">
                     <a href="?url=home" class="btn btn-secondary">Kembali</a>
                     <?php if(isset($_SESSION['user_id'])): ?>
                        <input type="text" class="form-control" name="komentar" required placeholder="Masukan Komentar">
                        <input type="submit" value="Kirim" name="submit" class="btn btn-secondary">
                     <?php endif; ?>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="col-6">
         <?= @$alert ?>
         <?php $UserID=@$_SESSION["user_id"]; $komen=mysqli_query($conn, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.Userid=user.Userid INNER JOIN foto ON komentarfoto.Fotoid=foto.Fotoid WHERE komentarfoto.Fotoid='$_GET[id]'");
         foreach($komen as $komens): ?>
         <p class="mb-0 fw-bold"><?= $komens['username'] ?></p>
         <p class="mb-1"><?= $komens['isikomentar'] ?></p>
         <p class="text-muted small mb-0"><?= $komens['tanggalkomentar'] ?></p>
         <hr>
         <?php endforeach; ?>
      </div>
   </div>
</div>
