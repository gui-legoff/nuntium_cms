<?php 

$scan=scandir($chemin_dossier_image);

// Listing des images
foreach($scan as $s){
    if($s!="." and $s!=".."){
        $ex=explode(".",$s);
        ?>
            <div class="col-md-2 float-left"> <!--  ici  changer ce col md-->
                <div class="thumbnail">
                    <img src="<?= $chemin_dossier_image.'/'.$s ?>" alt="images" style="width:100%;height:100%" class="mb-2 bg-light ">

                    <div class="input-group mb-3">
                        <form method="post">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="padding:0">
                                    <input type="text" class="form-control" placeholder="<?= $ex[0] ?>" name="nom_image">
                                    <input type="hidden" class="form-control" value="<?= $ex[1] ?>" name="ext_image">
                                </span>
                                <div class="input-group-append">
                                    <span class="input-group-text">.<?= $ex[1] ?></span>
                                </div>
                                <button type="submit" class="btn btn-outline-info" name="update" value="<?= $s ?>">
                                    <i class="far fa-check-circle"></i>
                                </button>
                            </div>
                        </form> 
                    </div>
                    <div class="caption">
                        <form method="post">
                            <button type="submit" class="btn btn-danger del" name="delete" value="<?= $s ?>">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php
    }
}

?>