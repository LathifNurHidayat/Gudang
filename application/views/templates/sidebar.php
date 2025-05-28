<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="" class="navbar-brand navbar-brand-autodark">
            <h1>Gudang</h1>
        </a>

        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav pt-lg-3">

                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('dashboard') ?>">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="fas fa-fw fa-home"></i>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                </li>

                <?php
                $id_role = $this->session->userdata('id_role');
                $this->db->select('aa.*, bb.menu');
                $this->db->from('tb_user_access_menu aa');
                $this->db->join('tb_user_menu bb', 'aa.id_menu = bb.id_menu', 'LEFT');
                $this->db->where('aa.id_role', $id_role);
                $menu = $this->db->get()->result_array();

                $this->db->where('is_active', 1);
                $submenu = $this->db->get('tb_sub_menu')->result_array();

                $grouped_submenus = [];
                foreach ($submenu as $sub) {
                    $grouped_submenus[$sub['id_menu']][] = $sub;
                }
                ?>

                <?php foreach ($menu as $m): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button"
                            aria-expanded="false">
                            <span class="nav-link-title">
                                <?= $m['menu'] ?>
                            </span>
                        </a>

                        <?php if (!empty($grouped_submenus[$m['id_menu']])): ?>
                            <div class="dropdown-menu">
                                <?php foreach ($grouped_submenus[$m['id_menu']] as $s): ?>
                                    <a class="dropdown-item" href="<?= base_url($s['url']) ?>">
                                        <i class="m-2 <?= $s['icon'] ?>"></i> <?= $s['title'] ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('auth/logout') ?>"
                        onclick="return confirm('Anda yakin ingin logout');">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg"
                                class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path d="M7 12h14l-3 -3m0 6l3 -3" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Logout
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
<div class="page">
    <div class="content">
        <div class="container-xl">