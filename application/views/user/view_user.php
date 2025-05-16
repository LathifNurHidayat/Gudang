<div class="col">
    <!-- Page pre-title -->
    <div class="page-pretitle">
        Halaman
    </div>
    <h2 class="page-title">
        Data User
    </h2>
</div>

<div class="col-12 mt-3">
    <div class="card">

        <div class="container mt-2">
            <?= $this->session->flashdata('msg') ?>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter text-nowrap" id="table_user">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>USERNAME</th>
                            <th>NAMA LENGKAP</th>
                            <th>IS AKTIF</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (empty($user)): ?>
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data user</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach ($user as $usr): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $usr->username ?></td>
                                    <td><?= $usr->fullname ?></td>
                                    <td>
                                        <span class="badge badge-md <?= $usr->is_active == 'aktif' ? 'bg-green' : 'bg-red' ?>">
                                            <?= $usr->is_active ?>
                                        </span>
                                    </td>
                                    <td colspan="2">
                                        <a href="<?= site_url('user/edit_user/' . $usr->id_user) ?>"
                                            class="btn btn-sm btn-warning">Edit</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>