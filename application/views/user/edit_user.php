<div class="col">
    <div class="page-pretitle">
        Halaman
    </div>
    <h2 class="page-title">
        Edit User
    </h2>
</div>

<div class="col-12 mt-3">
    <div class="card">
        <?= $this->session->flashdata('msg'); ?>

        <?= form_open('user/update_user', ['class' => 'm-3']); ?>

        <input type="hidden" name="id_user" value="<?= $user->id_user?>">

        <div class="mb-3">
            <label class="form-label">Nama lengkap</label>
            <input type="text" class="form-control" name="fullname" `
                value="<?= set_value('fullname', $user->fullname) ?>">
            <small class="text-danger"><i><?= form_error('fullname') ?></i></small>
        </div>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" `
                value="<?= set_value('username', $user->username) ?>">
            <small class="text-danger"><i><?= form_error('username') ?></i></small>
        </div>

        <div class="mb-3">
            <label class="form-label">Is Active</label>
            <select name="is_active">
                <option value="aktif" <?= $user->is_active == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="nonaktif" <?= $user->is_active == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
            </select>
            <small class="text-danger"><i><?= form_error('is_active') ?></i></small>

        </div>

        <a href="<?= base_url('user/index') ?>" class="btn btn-warning">Kembali</a>
        <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <line x1="10" y1="14" x2="21" y2="3" />
                <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" />
            </svg>
            Kirim</button>
        <?= form_close(); ?>
    </div>
</div>