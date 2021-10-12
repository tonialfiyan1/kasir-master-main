<?php $this->load->view('admin/template/head'); ?>
<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/menu'); ?>

        <main>
            <div class="container-fluid site-width">
                
                <?php $this->load->view('admin/template/breadcrumbs'); ?>
                <div class="row">
                    <div class="col-12  mt-3">                          
                        <div class="card">  
                            <div class="card-header d-flex justify-content-between align-items-center">                               
                                <h4 class="card-title"><?= $title ?></h4>                                   
                            </div>
                            <div class="card-body">
                                Content here
                            </div>                                
                        </div>
                    </div>



                </div>
                <!-- END: Card DATA-->
            </div>
        </main>
        <!-- START: Footer-->
        
<?php $this->load->view('admin/template/footer'); ?>