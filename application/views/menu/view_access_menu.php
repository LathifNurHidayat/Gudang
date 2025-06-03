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

                        <?php if (empty($menu)): ?>
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data menu</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach ($menu as $m): 
                            if($m['id_menu'] != 2): ?>
                            
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $m['menu'] ?></td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                            <?= check_access($id_role, $m['id_menu'])?> 
                                            data-role="<?= $id_role?>"
                                            data-menu="<?= $m['id_menu'];?>">
                                        </div>
                                    </td>
                                </tr>
                            <?php 
                        endif;
                        endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.form-check-input').on('click', function(){
            let id_role = $(this).data('role')
            let id_menu = $(this).data('menu')
            $.ajax({
                url: '<?= site_url('menu/ajax_user_access')?>',
                method: 'POST',
                data: {role_id : id_role, menu_id : id_menu, <?= $this->security->get_csrf_token_name()?> : "<?= $this->security->get_csrf_hash()?>"},
                success: function(){
                    window.location.href = '<?= site_url('menu/access_menu/')?>' + id_role
                }
            })
        })
    });
</script>
