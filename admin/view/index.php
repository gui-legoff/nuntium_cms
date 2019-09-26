    <?php
        /** Message d'erreur */
        $message="";

        if(!isset($_SESSION['admin'])){            
            require $chemin_admin_modules."form_login.php";
        }
        
        if(isset($_SESSION['admin'])){
            require"controller/index.php";
    ?>
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../"><?= $_SESSION['name'] ?></a>
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="controller/deconnect.php">Déconnexion</a>
                </li>
            </ul>
        </nav>   

        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <?php 
                            // Listing des menus et liens generer a partir du tableau $t
                            foreach($t as $res){   
                                ?>
                                    <li class="nav-item">
                                        <?php
                                            if( !isset($_GET['pages']) ){
                                                echo'<a class="nav-link a" href='.$res['lien'].'>';
                                            }elseif(  $res['lien'] == "?pages=".$_GET['pages'] ){
                                                echo'<a class="nav-link active" href='.$res['lien'].'>';
                                            }else{
                                                echo'<a class="nav-link a" href='.$res['lien'].'>';
                                            }
                                        ?>
                                            <i class="<?= $res['icone'] ?> mr-2" style="font-size:16px;"></i>
                                            <?= $res['titre']  ?>
                                        </a>
                                    </li>
                                    <?php 
                                        if( $res['lien'] == "index.php" ){
                                            echo"<hr style='width:90%'>";
                                        } ?>
                                <?php
                            }
                        ?>

                        </ul>      
                        <hr style="width:90%">
                        <details>
                            <summary class="pl-4 mt-3">
                                <span style="color:#007bff">Modules</span>
                            </summary> 
                            <ul class="nav flex-column mb-2">
                                <?php
                                // Generateur de la liste des plugins installer sur site
                                $scan=scandir("../assets/modules/uploads");

                                foreach ($scan as $s) {
                                    if($s!="." and $s!=".."){
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="?plugins=<?= $s ?>">
                                        <i class="fas fa-cube mr-2 fa-lg"></i>
                                        <?= $s ?>
                                    </a>
                                </li>
                                    <?php
                                    }
                                }
                                ?>
                            </ul> 
                        </details>
                    </div>
                    </nav>


                    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                        <div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">

                            <?php
                                /** Gestions du contenu de l'admin en fonctions de la page séléctioné dans le menu déroulant a gauche */
                                if(isset($_GET['pages'])){
                                    
                                    require "pages/".$_GET['pages'].".php";
                                    /** Debug */
                                    require"../debug.php";
                                }elseif(isset($_GET['plugins'])){
                                    // Page des plugins
                                    $chemin_modules="../assets/modules/uploads/".$_GET['plugins'];
                                    require $chemin_modules."/view_".$_GET['plugins'].".php";
                                    /** Debug */
                                    require"../debug.php";
                                }else{
                                    
                            ?>

                            <h1 class="h1 border-bottom titre">Bienvenue dans l'Administration !</h1>
                                <h1 class="h2">Cliquer sur l'icone de votre choix :<i class="fas fa-arrow-down ml-3" style="width:1.5rem;height:1.5rem"></i></h1>
                                
                                <ul class="nav ul">
                                <?php 
                                    // Listing des menus et liens generer a partir du tableau $t
                                    foreach($t as $res){
                                        if( $res['lien'] !=="index.php" ){  
                                        ?>
                                            <li class="nav-item vignette">
                                                <a class="nav-link" href="<?= $res['lien'] ?>"> 
                                                <i class="<?= $res['icone'] ?> fa-5x"></i>
                                                    <?= $res['titre']  ?>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                    }
                                ?>
                                </ul>     
                        </div>
                            <?php 
                            /** Debug */
                            require"../debug.php";
            
                            /** Fin du else pour la gestion des pages */
                            }
                            ?>        
                        </div>                
                    </main>
                </div>
            </div>
        <?php
        }
        ?>

     <!-- Icons -->
     <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>    
