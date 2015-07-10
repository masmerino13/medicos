<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Supr admin</title>
    <meta name="author" content="SuggeElson" />
    <meta name="description" content="Web Presence Developers" />
    <meta name="keywords" content="Web Presence Developers" />
    <meta name="application-name" content="SIIE" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Le styles -->
    <!-- Use new way for google web fonts 
    http://www.smashingmagazine.com/2012/07/11/avoiding-faux-weights-styles-google-web-fonts -->
    <!-- Headings -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css' />  -->
    <!-- Text -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css' /> --> 
    <!--[if lt IE 9]>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
    <![endif]-->

    <!-- Core stylesheets do not remove -->
    <link href="<?= base_url()?>assets/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/css/supr-theme/jquery.ui.supr.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url()?>assets/css/icons.css" rel="stylesheet" type="text/css" />
	
    <!-- Plugins stylesheets -->
    <link href="<?= base_url()?>assets/plugins/misc/qtip/jquery.qtip.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/plugins/misc/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/plugins/misc/search/tipuesearch.css" type="text/css" rel="stylesheet" />

    <link href="<?= base_url()?>assets/plugins/forms/uniform/uniform.default.css" type="text/css" rel="stylesheet" />

    <!-- Main stylesheets -->
    <link href="<?= base_url()?>assets/css/main.css" rel="stylesheet" type="text/css" />

    <!-- Custom stylesheets ( Put your own changes here ) -->
    <link href="<?= base_url()?>assets/css/custom.css" rel="stylesheet" type="text/css" />

    <!-- Right to left version -->
    <link href="<?= base_url()?>assets/css/siie.css" rel="stylesheet" type="text/css" />

    <?php
    $session = $this->session->userdata('logged_in');
    $empresa = $this->session->userdata('ses_empresa');

    if(isset($css))
    echo $css
    ?>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?= base_url()?>assets/images/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url()?>assets/images/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url()?>assets/images/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url()?>assets/images/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="<?= base_url()?>assets/images/apple-touch-icon-57-precomposed.png" />
    
    <script type="text/javascript">
        //adding load class to body and hide page
        document.documentElement.className += 'loadstate';
    </script>

    </head>
      
    <body>
    <!-- loading animation -->
    <div id="qLoverlay"></div>
    <div id="qLbar"></div>
    
    <div id="header">

        <div class="navbar">
            <div class="navbar-inner">
              <div class="container-fluid">
                <a class="brand" href="<?= base_url() ?>">
                    <img src="<?= getEmpresaLogo() ?>" style="height: 50px;" alt="logo" />
                    <small><?= getEmpresaRazon()?></small>
                </a>
                <div class="nav-no-collapse">
                    <ul class="nav">
                        <li class="active"><a href="<?= base_url();?>"><span class="icon16 icomoon-icon-screen-2"></span> Panel de control</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="icon16 icomoon-icon-mail-3"></span>Mensajes <span class="notification">8</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="menu">
                                    <ul class="messages">    
                                        <li class="header"><strong>Messages</strong> (10) emails and (2) PM</li>
                                        <li>
                                           <span class="icon"><span class="icon16 icomoon-icon-user-3"></span></span>
                                            <span class="name"><a data-toggle="modal" href="#myModal1"><strong>Sammy Morerira</strong></a><span class="time">35 min ago</span></span>
                                            <span class="msg">I have question about new function ...</span>
                                        </li>
                                        <li>
                                           <span class="icon avatar"><img src="<?= base_url()?>assets/images/avatar.png" alt="" /></span>
                                            <span class="name"><a data-toggle="modal" href="#myModal1"><strong>George Michael</strong></a><span class="time">1 hour ago</span></span>
                                            <span class="msg">I need to meet you urgent please call me ...</span>
                                        </li>
                                        <li>
                                            <span class="icon"><span class="icon16 icomoon-icon-mail-3"></span></span>
                                            <span class="name"><a data-toggle="modal" href="#myModal1"><strong>Ivanovich</strong></a><span class="time">1 day ago</span></span>
                                            <span class="msg">I send you my suggestion, please look and ...</span>
                                        </li>
                                        <li class="view-all"><a href="#">View all messages <span class="icon16 icomoon-icon-arrow-right-8"></span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                  
                    <ul class="nav pull-right usernav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle avatar" data-toggle="dropdown">
                                <img src="<?= base_url()?>assets/images/avatar.png" alt="" class="image" />
                                <span class="txt"><?= substr($session['usu_persona'],0,50)?></span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="menu">
                                    <ul>
                                        <li>
                                            <a href="#"><span class="icon16 icomoon-icon-user-3"></span>Editar Ferfil</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="icon16 iconic-icon-key-stroke"></span>Cambiar Contraseña</a>
                                        </li>
                                        <li>
                                            <a href="#" id="openDialogEmpresa"><span class="icon16 iconic-icon-transfer"></span>Cambiar Empresa</a>
                                        </li>
                                        <li>
                                            <a href="#" id="openDialogPeriodo"><span class="icon16 icomoon-icon-tree-view "></span>Periodo Fiscal</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="<?= base_url()?>index.php/login/logout"><span class="icon16 icomoon-icon-exit"></span> Salir</a></li>
                    </ul>
                </div><!-- /.nav-collapse -->
              </div>
            </div><!-- /navbar-inner -->
          </div><!-- /navbar --> 

    </div><!-- End #header -->

    <div id="wrapper">

        <!--Responsive navigation button-->  
        <div class="resBtn">
            <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
        </div>

        <!--Sidebar background-->
        <div id="sidebarbg"></div>
        <!--Sidebar content-->
        <div id="sidebar">

            <?php
            echo menu_principal();
            ?>

            <div class="sidebar-widget">
                <h5 class="title">Extras</h5>
                <div class="content">
                    <div class="rightnow">
                        <ul class="unstyled">
                            <li><span class="number">34</span><span class="icon16 icomoon-icon-new-2"></span>Posts</li>
                            <li><span class="number">7</span><span class="icon16 icomoon-icon-file"></span>Pages</li>
                            <li><span class="number">14</span><span class="icon16 icomoon-icon-list-view"></span>Categories</li>
                            <li><span class="number">201</span><span class="icon16 icomoon-icon-tag"></span>Tags</li>
                        </ul>
                    </div>
                </div>

            </div><!-- End .sidenav-widget -->

        </div><!-- End #sidebar -->

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3><?= $seccion?></h3>

                    <ul class="breadcrumb">
                        <li>
                            <a href="#" class="tip" title="Ir al Panel de Control">
                                <span class="icon16 icomoon-icon-screen-2"></span>
                            </a> 
                            <span class="divider">
                                <span class="icon16 icomoon-icon-arrow-left-2"></span>
                            </span>
                        </li>
                        <li class="active"><?= $seccion ?></li>
                    </ul>

                </div><!-- End .heading-->
                <?php
                $messages = $this->messages->get();
                messenger($messages);
                ?>
                <?php
                if(isset($toolbar)):
                echo '<div class="row-fluid marginB10">'.$toolbar.'</div>';
                endif;
                ?>
                <?php  echo $contents ?>


                
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->

    <!-- Le javascript
    ================================================== -->
    <!-- Important plugins put in all pages -->
    <script type="text/javascript" src="<?= base_url()?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/js/jquery-ui.min.js"></script>

    <!-- Important plugins put in all pages -->
    <script type="text/javascript" src="<?= base_url()?>assets/js/bootstrap/bootstrap.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/js/jquery.mousewheel.js"></script>

    <!-- Misc plugins -->
    <script type="text/javascript" src="<?= base_url()?>assets/plugins/misc/qtip/jquery.qtip.min.js"></script><!-- Custom tooltip plugin -->
    <script type="text/javascript" src="<?= base_url()?>assets/plugins/misc/totop/jquery.ui.totop.min.js"></script> <!-- Back to top plugin -->

    <!-- Form plugins -->
    <script type="text/javascript" src="<?= base_url()?>assets/plugins/forms/watermark/jquery.watermark.min.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/plugins/forms/uniform/jquery.uniform.min.js"></script>

    <!-- Init plugins -->
    <script type="text/javascript" src="<?= base_url()?>assets/js/main.js"></script><!-- Core js functions -->
    <script type="text/javascript" src="<?= base_url()?>assets/js/jquery.dialogextend.js"></script><!-- Core js functions -->

    <?php

    if(isset($js))
    echo $js;
    ?>

    <div id="periodo-modal">
        <?php setPeriodoModal() ?>
    </div>

    <div id="empresas-modal">
        <?php setEmpresasModal() ?>
    </div>

    <!-- Important Place before main.js  -->

    </body>
</html>
