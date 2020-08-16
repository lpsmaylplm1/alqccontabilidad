<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo base_url('behome') ?>" class="site_title"><i class="fa fa-home"></i> <span>DASHBOARD</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="<?php echo base_url('assets/images/Texto_Inmob.jpg') ?>" alt="AlqcContabilidad" style="border-radius: 25px 25px 0 0; margin-left: 8px ">
                        </div>
                        <!--                        <div class="profile_info">
                                                    <span>Consultoría, Inmobiliaria</span>
                                                    <h2> y Bienes Raíces</h2>
                                                </div>-->
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>OPCIONES</h3>
							<?php if ($this->session->userdata('rol') == 1) { ?>
									<ul class="nav side-menu">
										<li><a><i class="fa fa-home"></i> Inicio <span class="fa fa-chevron-down"></span></a>
											<ul class="nav child_menu">
												<li><a href="<?php echo base_url('behome') ?>">Clientes registrados</a></li>
											</ul>
										</li>
										<li><a><i class="fa fa-edit"></i> Gestión de Clientes <span class="fa fa-chevron-down"></span></a>
											<ul class="nav child_menu">
												<li><a href="<?php echo base_url('clientes/new_cte') ?>">Nuevo Cliente</a></li>
												<li><a href="<?php echo base_url('clientes/actions_ctes') ?>">Operaciones con Clientes</a></li>
											</ul>
										</li>
										<li><a><i class="fa fa-bar-chart-o"></i> Gestión de Usuarios <span class="fa fa-chevron-down"></span></a>
											<ul class="nav child_menu">
												<li><a href="<?php echo base_url('usuarios/nuevo_usuario') ?>">Nuevo usuario</a></li>
												<li><a href="<?php echo base_url('usuarios') ?>">Operaciones con Usuarios</a></li>
											</ul>
										</li>
									</ul>
							<?php } else { ?>
								<ul class="nav side-menu">
										<li><a><i class="fa fa-home"></i> Inicio <span class="fa fa-chevron-down"></span></a>
											<ul class="nav child_menu">
												<li><a href="<?php echo base_url('behome') ?>">Clientes registrados</a></li>
											</ul>
										</li>

	                            </ul>
							<?php } ?>		
                        </div>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>
			<div class="top_nav">
				<div class="nav_menu">
					<nav>
						<div class="nav toggle">
							<a id="menu_toggle"><i class="fa fa-bars"></i></a>
						</div>

						<ul class="nav navbar-nav navbar-right">
							<li class="">
								<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<img src="<?php echo base_url('assets/images/user.png') ?>" alt=""> <strong>BIENVENIDO(A):</strong> <?php echo $this->session->userdata('nombre_user') . ' ' . $this->session->userdata('ap_p_user') . ' ' . $this->session->userdata('ap_m_user')  ?> <?php if($this->session->userdata('rol')==1){ echo ' (Administrador)';}else{echo '(Auxiliar)';} ?>
									<span class=" fa fa-angle-down"></span>
								</a>
								<ul class="dropdown-menu dropdown-usermenu pull-right">
									<li><a href="<?php echo base_url('login/logout') ?>"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a></li>
								</ul>
							</li>

						</ul>
					</nav>
				</div>
			</div>