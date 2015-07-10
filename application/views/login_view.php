<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Acceso - SIIE</title>
    <meta name="author" content="Web Presence Developers" />
    <meta name="application-name" content="SIIE - CHM" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Le styles -->
    <link href="<?= base_url()?>assets/css/bootstrap/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/css/supr-theme/jquery.ui.supr.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url()?>assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/plugins/forms/uniform/uniform.default.css" type="text/css" rel="stylesheet" />

    <!-- Main stylesheets -->
    <link href="<?= base_url()?>assets/css/main.css" rel="stylesheet" type="text/css" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url()?>assets/images/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url()?>assets/images/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url()?>assets/images/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="<?= base_url()?>assets/images/apple-touch-icon-57-precomposed.png" />

        <style type="text/css">
            .siie-alert-login{
                width: 350px;
                text-align: left;
                margin: 115px auto 0;
            }
        </style>
    </head>
      
    <body class="loginPage">

    <div class="container-fluid">

        <div id="header">

            <div class="row-fluid">

                <div class="navbar">
                    <div class="navbar-inner">
                      <div class="container">
                            <a class="brand" href="dashboard.html">SIIE<span class="slogan">.CHM</span></a>
                      </div>
                    </div><!-- /navbar-inner -->
                  </div><!-- /navbar -->
                

            </div><!-- End .row-fluid -->

        </div><!-- End #header -->

    </div><!-- End .container-fluid -->    

    <div class="container-fluid">
        <div class="loginContainer">
                <?php echo form_open('verifylogin'); ?>
                <div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <label class="form-label span12" for="username">
                                Usuario
                                <span class="icon16 icomoon-icon-user-3 right gray marginR10"></span>
                            </label>
                            <input class="span12" id="usr_login" type="text" name="usr_login" />
                        </div>
                    </div>
                </div>

                <div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <label class="form-label span12" for="password">
                                Contrase&ntilde;a
                                <span class="icon16 icomoon-icon-locked right gray marginR10"></span>
                            </label>
                            <input class="span12" id="usr_contra" type="password" name="usr_contra" />
                        </div>
                    </div>
                </div>
                <div class="form-row row-fluid">                       
                    <div class="span12">
                        <div class="row-fluid">
                            <div class="form-actions">
                            <div class="span12 controls">
                                <input type="checkbox" id="keepLoged" value="Value" class="styled" name="logged" /> Recordar acceso
                                <button type="submit" class="btn btn-info right" id="loginBtn"><span class="icon16 icomoon-icon-enter white"></span> Accesar</button>
                            </div>
                            </div>
                        </div>
                    </div> 
                </div>

            <?= form_close()?>
        </div>
    </div>

        <?php
        if(validation_errors())
        {
            echo '<div class="siie-alert-login alert alert-error">'.validation_errors().'</div>';
        }
        ?>

    <!-- End .container-fluid -->

    <!-- Le javascript
    ================================================== -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/js/bootstrap/bootstrap.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/plugins/misc/touch-punch/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/plugins/misc/ios-fix/ios-orientationchange-fix.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/plugins/forms/validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/plugins/forms/uniform/jquery.uniform.min.js"></script>

     <script type="text/javascript">
        // document ready function
        $(document).ready(function() {
            $("input, textarea, select").not('.nostyle').uniform();
            $("#loginForm").validate({
                rules: {
                    usr_login: {
                        required: true,
                        minlength: 4
                    },
                    usr_contra: {
                        required: true,
                        minlength: 6
                    }  
                },
                messages: {
                    usr_login: {
                        required: "Usuario es requerido",
                        minlength: "Requerido"
                    },
                    usr_contra: {
                        required: "Ingrese una contraseña",
                        minlength: "Minimo de 6 caracteres"
                    }
                }   
            });
        });
    </script>

    <!-- NACHALO NA TYXO.BG BROYACH -->
    <script type="text/javascript">
    <!--
    d=document;d.write('<a href="https://www.tyxo.bg/?138779" title="Tyxo.bg counter"><img width="1" height="1" border="0" alt="Tyxo.bg counter" src="'+location.protocol+'//cnt.tyxo.bg/138779?rnd='+Math.round(Math.random()*2147483647));
    d.write('&sp='+screen.width+'x'+screen.height+'&r='+escape(d.referrer)+'"></a>');
    //-->
    </script><noscript><a href="http://www.tyxo.bg/?138779" title="Tyxo.bg counter"><img src="https://cnt.tyxo.bg/138779" width="1" height="1" border="0" alt="Tyxo.bg counter" /></a></noscript>
    <!-- KRAI NA TYXO.BG BROYACH -->
 
    </body>
</html>
