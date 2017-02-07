<?php
$usergroup_id = $this->session->userdata(base_url().'usergroup_id');
$menu_parent = $this->session->userdata(base_url().'menu_parent');
$menu_child = $this->session->userdata(base_url().'menu_child');
?>
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start <?php echo $menu_child=='dashboard' ? 'active open' : '' ?>">
                <a href="<?php echo site_url().'dashboard' ?>" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard </span>
                    <?php if ($menu_child=='dashboard'): ?>
                        <span class="selected"></span>
                    <?php endif; ?>
                </a>
            </li>
            <?php
            $akses_parent = get_akses($usergroup_id, 'parent');
            ?>
            <?php foreach ($akses_parent->result() as $parent): ?>
                <li class="nav-item start <?php echo $menu_parent==$parent->menu_kode ? 'active open' : '' ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="<?php echo $parent->menu_icon ?>"></i>
                        <span class="title"><?php echo $parent->menu_nama ?></span>
                        <?php if ($menu_parent==$parent->menu_kode): ?>
                            <span class="arrow open"></span>
                            <span class="selected"></span>
                        <?php else: ?>
                            <span class="arrow"></span>
                        <?php endif; ?>
                    </a>
                    <ul class="sub-menu">
                        <?php
                        $akses_child = get_akses($usergroup_id, 'child', $parent->menu_id);
                        ?>
                        <?php foreach ($akses_child->result() as $child): ?>
                            <li class="nav-item start <?php echo $menu_child==$child->menu_kode ? 'active open' : '' ?>">
                                <a href="<?php echo site_url().$child->menu_url ?>" class="nav-link ">
                                    <i class="<?php echo $child->menu_icon ?>"></i>
                                    <span class="title"><?php echo $child->menu_nama ?></span>
                                    <?php if ($menu_child==$child->menu_kode): ?>
                                        <span class="selected"></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
