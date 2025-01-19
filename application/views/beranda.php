<?php
$id_user = $this->session->userdata('id_user');
if ($id_user=='') {
    $lebar = "12"; 
}else {
    $lebar = "9";
}
?>
<div class="col-lg-<?php echo $lebar; ?>">

    <?php echo $this->session->flashdata('msg'); ?>
    <div class="card mt-4">
        <div class="card-body">
            <h3 class="card-title"><?php echo strtoupper($judul_web); ?></h3>     
      </div>
      <img class="card-img-top img-fluid " src="assets/images/bg.jpg" alt="assets/images/bg.jpg">
    </div>

</div>