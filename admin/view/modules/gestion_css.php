<?php

// Gestion du CSS

// Resultat des template enregistré dans la BDD
$req=$db->query(" SELECT couleur_pri , couleur_sec , couleur_txt FROM settings WHERE id=$id_template_actif ");
$re=$req->fetchAll();

foreach($re as $r){
    $couleur_pri=$r['couleur_pri'];
    $couleur_sec=$r['couleur_sec'];
    $couleur_txt=$r['couleur_txt'];
}
?>  


    <style>
        :root{
            --couleur_pri:<?= $couleur_pri ?>;
            --couleur_sec:<?= $couleur_sec ?>;
            --couleur_txt:<?= $couleur_txt ?>;
        }

        body{
            background-color:var(--couleur_pri)!important;
        }
        .content{
            background-color:var(--couleur_sec)!important;
        }

        h1, h2, h3, h4, h5, h6{
            color:var(--couleur_txt)!important;
        }
    </style>