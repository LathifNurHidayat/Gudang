<div class="col">
    <!-- Page pre-title -->
    <div class="page-pretitle">
        Halaman
    </div>
    <h2 class="page-title">
        Hak akses menu
    </h2>
</div>

<div class="col-12 mt-3">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                
            </div>
        </div>

        <div class="container mt-2">
            <?= $this->session->flashdata('msg') ?>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter text-nowrap" id="table_jenis_barang">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>MENU</th>
                            <th>HAK AKSES</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (empty($access_menu)): ?>
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data menu</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach ($access_menu as $am): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $am['menu'] ?></td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                            <?php if ($am['id_role'] == $id_role):?>
                                                checked
                                            <?php endif ;?>
                                            data-role="<?= $am['id_role'];?>"
                                            data-menu="<?= $am['id_menu'];?>"
                                            >
                                        </div>
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

<script>
    $(document).ready(function(){

        $('.form-check-input').on('click', function () {
            const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

            $.ajax({
                url: "<?= site_url('menu/ajax_user_access') ?>",
                type: 'post',
                data: {
                    menu_id: menuId, 
                    role_id: roleId,
                    '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>'

                },
                success: function () {
                    document.location.href = "<?= site_url('menu/access_menu/') ?>" + roleId;
                }
            });
        });
    });


    
</script>
