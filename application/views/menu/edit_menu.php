<div class="col">
    <div class="page-pretitle">
        Halaman
    </div>
    <h2 class="page-title">
        Edit menu
    </h2>
</div>

<div class="col-8 mt-3">
    <div class="card">
        <div class="card-body">

            <?= $this->session->flashdata('msg'); ?>

            <?= form_open('menu/update_menu', ['class' => 'm-3']); ?>

            <input type="hidden" name="id_menu" value="<?= $menu->id_menu?>">

            <div class="mb-3">
                <label class="form-label">Nama menu</label>
                <input type="text" class="form-control" name="menu" value="<?= set_value('menu', $menu->menu) ?>">
                <small class="text-danger"><i><?= form_error('menu') ?></i></small>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('menu/index') ?>" class="btn btn-warning">Kembali</a>
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="10" y1="14" x2="21" y2="3" />
                        <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" />
                    </svg>
                    Kirim
                </button>
            </div>

            <?= form_close(); ?>
        </div>
    </div>
</div>