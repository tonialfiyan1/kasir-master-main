        <footer class="site-footer">
            <?= date('Y') ?> © <?= SITE_NAME ?>
        </footer>
        <a href="#" class="scrollup text-center"> 
            <i class="icon-arrow-up"></i>
        </a>

        <script src="<?= base_url('assets') ?>/vendors/jquery/jquery-3.3.1.min.js"></script>
        <script src="<?= base_url('assets') ?>/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?= base_url('assets') ?>/vendors/moment/moment.js"></script>
        <script src="<?= base_url('assets') ?>/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>    
        <script src="<?= base_url('assets') ?>/vendors/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- END: Template JS-->

        <!-- START: APP JS-->
        <script src="<?= base_url('assets') ?>/js/app.js"></script>
        <!-- END: APP JS-->

        <!-- START: Page Vendor JS-->
        <script src="<?= base_url('assets') ?>/vendors/datatable/js/jquery.dataTables.min.js"></script> 
        <script src="<?= base_url('assets') ?>/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>

        <!-- START: Page Script JS-->        
        <script src="<?= base_url('assets') ?>/js/datatable.script.js"></script>

        <script src="<?= base_url('assets') ?>/vendors/sweetalert/sweetalert.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('body').on('click', '.deleteData', function (e) {
                    e.preventDefault();
                    var link = $(this).attr('href');

                    swal({
                        title: "Ingin menghapus?",
                        text: "Klik Ok dan anda akan menghapus data ini.",
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonClass: 'btn-info',
                        confirmButtonClass: 'btn-danger',
                    },
                    function(){
                        window.location.href = link;
                    });
                });
            });
        </script>
    </body>
</html>
