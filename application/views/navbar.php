<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <div>
        <a class="navbar-brand" align="center" href="#">
          <h4>SiPerpol</h4>
          <h6>Sistem Perpustakaan Online</h6>
        </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Beranda
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <?php 
              $id_user = $this->session->userdata('id_user');
              if ($id_user=='') {?>
                <a class="nav-link" href="index.php/web/login">Login</a>
              <?php }else {?>
                <a class="nav-link" href="index.php/web/logout">Logout</a> 
              <?php } ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <br>
    