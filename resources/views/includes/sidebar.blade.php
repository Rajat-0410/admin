<?php // echo $route_name; exit('here'); ?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel" style="height: 70px;">
            <div class="pull-left image">
<!--                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
                <i class="fa fa-user-circle" style="color: #FFF;"></i>
            </div>
            <div class="pull-left info">
                <p>
                    <?php
                        $userData = Session::get('user_data');
                        echo $userData['name'];
                        // print("<pre>"); print_r($userData); exit('here');
                        // $user = auth()->user();
                        // echo $user->name;
                        // print("<pre>"); print_r($user); exit('here');
                    ?>
                </p>
                <a href="javascript:void(0)">
                    <i class="fa fa-circle text-success"></i>
                    <?php echo $userData['role']; ?>
                </a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <?php
            if (!empty($arr_admin_main_menu)) {
                foreach ($arr_admin_main_menu as $key => $arr_main_menu) {
                    $id = $arr_main_menu['module_id'];
                    $name = $arr_main_menu['name'];
                    $fa_icon = $arr_main_menu['fa_icon'];
                    $controller = $arr_main_menu['controller'];
                    $action = $arr_main_menu['action'];
                    $is_visible = (bool) $arr_main_menu['is_visible'];
                    $has_sub_menu = (bool) $arr_main_menu['has_sub_menu'];
                    $arr_sub_menus = $arr_main_menu['sub_menus'];
                    $menu_url = 'admin/' . $controller;
                    ?>
                    <?php if ($has_sub_menu == true && $is_visible == true) { ?>
                        <li id="menu_{{ $id }}" class="treeview controller-{{ $controller }} <?php if ($controller == $get_controller) { echo 'menu-open';} ?>">
                            <a href="#">
                                <i class="<?php echo $fa_icon; ?>"></i> <span><?php echo $name; ?></span>
                                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                            </a>
                                <?php if (!empty($arr_sub_menus)) { ?>
                                <ul class="treeview-menu" id="treeview_menu_{{$id}}" style="<?php if ($controller == $get_controller) { echo 'display: block'; } ?>">
                                    <?php
                                        foreach ($arr_sub_menus as $key => $arr_sub_menu) {
                                            $sm_id = $arr_sub_menu['module_id'];
                                            $sm_name = $arr_sub_menu['name'];
                                            $sm_fa_icon = $arr_sub_menu['fa_icon'];
                                            $sm_controller = $arr_sub_menu['controller'];
                                            $sm_action = $arr_sub_menu['action'];
                                            $sm_is_visible = (bool) $arr_sub_menu['is_visible'];
                                            $sm_has_sub_menu = (bool) $arr_sub_menu['has_sub_menu'];
                                            $sm_menu_url = 'admin/' . $sm_controller . '/' . $sm_action;
                                        ?>
                                        <?php if ($sm_is_visible) { ?>
                                                <li id="sub_menu_{{ $sm_id }}" class="controller-{{ $sm_controller }} <?php if ($sm_controller == $get_controller) { echo 'active'; } ?>">
                                                    <a href="{{ url($sm_menu_url) }}">
                                                        <i class="<?php echo $sm_fa_icon; ?>"></i><?php echo $sm_name; ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <?php } else { ?>
                        <?php if ($is_visible) { ?>
                        <li class="controller-{{ $controller }} <?php if ($controller == $get_controller) { echo 'active'; } ?>">
                            <a href="{{ url($menu_url) }}">
                                <i class="<?php echo $fa_icon; ?>"></i> <span><?php echo $name; ?></span>
                            </a>
                        </li>
                    <?php } ?>
                <?php }
                }
            }
            ?>           
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>