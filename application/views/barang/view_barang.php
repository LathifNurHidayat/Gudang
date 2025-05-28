<div class="col">
    <!-- Page pre-title -->
    <div class="page-pretitle">
        Halaman
    </div>
    <h2 class="page-title">
        Data Barang
    </h2>
</div>

<div class="col-12 mt-3">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <a href="<?= site_url('barang/add_barang') ?>" class="btn btn-primary ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Tambah Data
                </a>
            </div>

            <div class="card-title ml-3">
                <a href="" class="btn btn-warning" data-toggle="modal" data-target="#pilih_tanggal">
                    <i class="fa fa-download"></i>
                    Export
                </a>
            </div>
        </div>

        <div class="container mt-2">
            <?= $this->session->flashdata('msg') ?>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter text-nowrap" id="table_barang">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>JENIS BARANG</th>
                            <th>NAMA BARANG</th>
                            <th>HARGA</th>
                            <th>STOK</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (empty($barang)): ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data barang</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach ($barang as $brg): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $brg->nama_jenis_barang ?></td>
                                    <td><?= $brg->nama_barang ?></td>
                                    <td><?= format_rupiah($brg->harga) ?></td>
                                    <td><?= $brg->stok ?></td>
                                    <td colspan="2">
                                        <a href="<?= site_url('barang/edit_barang/' . $brg->id_barang) ?>"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= site_url('barang/delete_barang/' . $brg->id_barang) ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Anda yakin ingin menghapus data?');">Hapus</a>
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

<div class="modal modal-blur fade" id="pilih_tanggal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Tanggal</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <?= form_open('barang/export_to_excel', ['id' => 'form_tanggal']) ?>
                <div class="row mb-3 col-12">
                    <div class="form-label col-5">Dari tanggal</div>
                    <input type="date" class="form-control mb-3" name="tanggal_1" value="<?= set_value('tanggal_1') ?>">
                    <small class="text-danger"><i><?= form_error('tanggal_1') ?></i></small>

                    <div class="form-label col-5">Sampai tanggal</div>
                    <input type="date" class="form-control" name="tanggal_2" value="<?= set_value('tanggal_2') ?>">
                    <small class="text-danger"><i><?= form_error('tanggal_2') ?></i></small>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#form_tanggal').submit(function(e) {
           e.preventDefault(); //biar gak reload
           
           $('.text-danger').html('');

           $ajax({

           });
        });
    });
</script>