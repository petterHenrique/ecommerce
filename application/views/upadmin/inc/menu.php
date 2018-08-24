<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;background:#337AB7;">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?=base_url()?>/index.php/login"><img style="margin-top:-12px;width:100px;" class="img-responsive" src="https://www.upsy.com.br/img/logo-upsy.png"/></a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown drop-notificacao" style="background:none;">
            <a class="dropdown-toggle" style="color:white;" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-comment fa-fw"></i> Comentários
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                            <span class="pull-right text-muted small">12 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-envelope fa-fw"></i> Message Sent
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-tasks fa-fw"></i> New Task
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-alerts -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown drop-notificacao">
            <a class="dropdown-toggle" style="color:white;" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="<?=base_url()?>index.php/login/deslogar"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                
                <li>
                    <a href="<?=base_url()?>index.php/dashboard/index""><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-edit fa-fw"></i> Catálogo<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?=base_url()?>index.php/categoriasAdmin/index">Categorias</a>
                        </li>
                        <li>
                            <a href="<?=base_url()?>index.php/marcasAdmin/index">Marcas</a>
                        </li>
                        <li>
                            <a href="<?=base_url()?>index.php/produtosAdmin/index">Produtos</a>
                        </li>
                        <li>
                            <a href="morris.html">Variações</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="tables.html"><i class="fa fa-shopping-basket fa-fw"></i> Pedidos</a>
                </li>
                <li>
                    <a href="tables.html"><i class="fa fa-user fa-fw"></i> Clientes</a>
                </li>
                <li>
                    <a href="forms.html"><i class="fa fa-bar-chart fa-fw"></i> Relatórios</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bullhorn fa-fw"></i> Marketing<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?=base_url()?>index.php/bannersadmin/index">Baners</a>
                        </li>
                        <li>
                            <a href="buttons.html">Cupons</a>
                        </li>
                        <li>
                            <a href="buttons.html">Newsletter</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="<?=base_url()?>index.php/paginasAdmin/index"><i class="fa fa-files-o fa-fw"></i> Páginas</a>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-edit fa-fw"></i> Configurações<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?=base_url()?>index.php/categoriasadmin/index">Dados Empresa</a>
                        </li>
                        <li>
                            <a href="morris.html">Frete</a>
                        </li>
                        <li>
                            <a href="morris.html">Pagamentos</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>

<!--loading-->
<div id="spinner" style="display:none;">
	<img style="width:80px;" src="http://thinkfuture.com/wp-content/uploads/2013/10/loading_spinner.gif" />
</div>