        </div>

    </div>
    <br><br><br><br><br><br><br><br><br><br>
    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">202102314 Ade Marfa &copy; 2024</p>
        </div>
        <!-- /.container -->
        </footer>

        <style>
            ul.parsley-errors-list{color:red;list-style:none;padding-left:0px;}
        </style>

        <!-- Bootstrap core JavaScript -->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/js/parsley.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/jquery-ui.js"></script>
        <script>
            $( function() {
                $( "#tgl, #tgl2" ).datepicker({dateFormat:'dd-mm-yy'});
            } );
        </script>
        <script src="assets/js/select2.min.js"></script>
        <script src="assets/js/jquery.dataTables.js"></script>

        <script type="text/javascript">
        $(document).ready(function() {
            $('.select2-single').select2();
            $('#table_id').DataTable();
        });

        function hanyaAngka(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
            }
        </script>
    </body>
</html>