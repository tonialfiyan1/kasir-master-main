<div class="row ">
    <div class="col-12  align-self-center">
        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Halaman <?= $title ?></h4></div>

            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item"><?= ucwords($this->uri->segment(1)) ?></li>
                <?php if ($this->uri->segment(2)): ?>
                    <li class="breadcrumb-item"><?= ucwords($this->uri->segment(2)) ?></li>
                <?php endif ?>
                <?php if ($this->uri->segment(3)): ?>
                    <li class="breadcrumb-item"><?= ucwords($this->uri->segment(3)) ?></li>
                <?php endif ?>
            </ol>
        </div>
    </div>
</div>