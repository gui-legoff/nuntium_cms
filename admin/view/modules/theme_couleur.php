<!-- Script du color picker -->
<script src="../assets/js/color-picker.min.js"></script>

<?php

// Resultat des template enregistré dans la BDD
$req=$db->query(" SELECT theme, couleur_pri , couleur_sec , couleur_txt FROM settings WHERE id=$id_template_actif ");
$re=$req->fetchAll();

foreach($re as $r){
    // Condition pour ne pas afficher les color picker si le theme choisi est default 
    if($r['theme'] !== "default"){

        $couleur_pri=$r['couleur_pri'];
        $couleur_sec=$r['couleur_sec'];
        $couleur_txt=$r['couleur_txt'];

        $var="ok";
    }else{
        $var="";
    }
}

if($var == "ok"){
?>  
<form method="post">
<input type="hidden" name="id" value="<?php echo $id_template_actif ?>">   
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Couleur</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Couleur principal</td>
                    <td><input type="color" id="couleur_pri" value="<?= $couleur_pri ?>" name="couleur_pri"></td>
                    
                    <script>

                    var target = document.getElementById('couleur_pri'),
                        picker = new CP(target);

                    // prevent showing native color picker panel
                    target.onclick = function(e) {
                        e.preventDefault();
                    };

                    picker.on("change", function(color) {
                        this.target.value = '#' + color;
                    });

                    </script>
                </tr>
                <tr>
                    <td>Couleur secondaire</td>
                    <td><input type="color" id="couleur_sec" value="<?= $couleur_sec ?>" name="couleur_sec"></td>
                    
                    <script>

                    var target = document.getElementById('couleur_sec'),
                        picker = new CP(target);

                    // prevent showing native color picker panel
                    target.onclick = function(e) {
                        e.preventDefault();
                    };

                    picker.on("change", function(color) {
                        this.target.value = '#' + color;
                    });

                    </script>
                </tr> 
                <tr>
                    <td>Couleur des titres</td>
                    <td><input type="color" id="couleur_txt" value="<?= $couleur_txt ?>" name="couleur_txt"></td>
                    
                    <script>

                    var target = document.getElementById('couleur_txt'),
                        picker = new CP(target);

                    // prevent showing native color picker panel
                    target.onclick = function(e) {
                        e.preventDefault();
                    };

                    picker.on("change", function(color) {
                        this.target.value = '#' + color;
                    });

                    </script>
                </tr>    
            </tbody>    
        </table>    
    </div>
    <input type="submit" name="update_couleur" value="sauvegarder les couleurs" class="btn btn-primary mb-5 mt-2">
</form>
<div class="border-bottom"></div>
<?php } ?>


