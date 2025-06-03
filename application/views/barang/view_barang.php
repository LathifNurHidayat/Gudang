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
                <a href="<?= site_url('barang/export_to_excel')?>" class="btn btn-warning">
                    <i class="fa fa-download"></i>
                    Export
                </a>
            </div>
        </div>

        <div class="container mt-2 w-100">
            <?= $this->session->flashdata('msg') ?>
        </div>

        <div class="card-body">
            <div class="form-group col-12 col-md-6 col-lg-4 mb-3">
                <label class="form-label">Search</label>
                <input type="text" class="form-control" id="keyword" placeholder="Masukan keyword">
            </div>
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

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        loadData();

        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }


        function loadData() {
            let keyword = $('#keyword').val()
            $.ajax({
                url: '<?= site_url('barang/get_barang') ?>',
                method: 'POST',
                data: {keyword : keyword, <?= $this->security->get_csrf_token_name()?> : "<?= $this->security->get_csrf_hash()?>"},
                dataType: 'json',
                success: function (data) {
                    let baris = '';
                    if (data.length == 0) {
                        baris += `
                        <tr>
                            <td colspan=""2>Tidak ada data</td>    
                        </tr>`;
                    } else {
                        data.forEach(function (item, index) {
                            baris += `
                                <tr>
                                    <td>${index + 1}</td>    
                                    <td>${item.nama_jenis_barang}</td>    
                                    <td>${item.nama_barang}</td>    
                                    <td>${formatRupiah(item.harga)}</td>    
                                    <td>${item.stok}</td>
                                    <td colspan="2">
                                        <a href="<?= site_url('barang/edit_barang/')?>${item.id_barang}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= site_url('barang/delete_barang/')?>${item.id_barang}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Anda yakin ingin menghapus data?');">Hapus</a>
                                    </td>
                                </tr>`;
                        })
                    }
                    $('#table_barang tbody').html(baris);
                },
                error: function(error){
                    console.error('Error : ', error);
                }
            });
        }


        $('#keyword').on('keyup', function(){
            loadData();
        })


        $('#form_tanggal').submit(function (e) {
            e.preventDefault(); //biar gak reload

            $('.text-danger').html('');

            $ajax({

            });
        });
    });
</script>