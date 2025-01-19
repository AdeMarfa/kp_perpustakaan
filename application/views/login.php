<div class="col-md-3"></div>

<div class="col-lg-6">

    
<div class="card mt-4">
    
    <div class="card-body">
        <h3 class="card-title">Form Login</h3>
        <hr>
        <?php echo $this->session->flashdata('msg'); ?>
        <form action="" Method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Masukan Username" autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password" required>
            </div>
            <button type="submit" name="btnlogin" class="btn btn-primary">Login</button>
        </form>
            
    </div>
    <br>
</div>

</div>