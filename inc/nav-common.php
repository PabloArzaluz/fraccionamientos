<div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
        <div class="navbar-header">
           
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <a class="navbar-brand" href="index.php"><?php echo $nombre_fraccionamiento; ?></a>
        </div>
        <center>
            <div class="navbar-collapse collapse" id="navbar-main">
                <?php if(isset($_SESSION['id_user'])){ ?><ul class="nav navbar-nav">
                    <li <?php if(isset($actual_page) && $actual_page == "notificaciones") echo "class='active'"; ?>><a href="notificaciones.php">Avisos</a>
                    </li>
                    <li <?php if(isset($actual_page) && $actual_page == "mantenimiento") echo "class='active'"; ?>><a href="mantenimiento.php">Estatus de Mantenimiento</a>
                    </li>
                    <li class="dropdown" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Comprobantes <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li <?php if(isset($actual_page) && $actual_page == "comprobantes") echo "class='active'"; ?>><a href="comprobantes-pago.php">Comprobantes de Gasto</a></li>
                            <li <?php if(isset($actual_page) && $actual_page == "estados") echo "class='active'"; ?>><a href="estados-cuenta.php">Estados de Cuenta</a></li>
                        </ul>
                    </li>
                    <li <?php if(isset($actual_page) && $actual_page == "presupuestos") echo "class='active'"; ?>><a href="presupuestos.php">Presupuestos</a>
                    </li>
                <li <?php if(isset($actual_page) && $actual_page == "quejas") echo "class='active'"; ?>><a href="quejas-sugerencias.php">Quejas y Sugerencias</a>
                    </li>
                </ul><?php } ?>
                <?php if(!isset($_SESSION['id_user'])){ ?><form action="verifyLogin.php" method="POST" class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" name="email_country_login" placeholder="Usuario">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_country_login" placeholder="Contraseña">
                    </div>
                    <div class="form-group">
                        
                    </div>
                    
                    <button type="submit" class="btn btn-success">Entrar</button>
                </form>
                <?php }else{ ?>
                    <div class="navbar-right">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b><?php echo ucwords(strtolower($_SESSION['name_user'])); ?></b> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php if($_SESSION['level_user']==1 || $_SESSION['level_user'] ==2){ ?><li><a href="panel-avisos.php">Panel de Administrador</a>
                            </li> <?php } ?>
                            <li><a href="change_password.php">Cambiar Contraseña</a>
                            <li class="divider"></li>
                            <li><a href="logout.php">Cerrar Sesion</a>
                            </li>                
                        </ul>
                    </li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </center>
    </div>
    </div>