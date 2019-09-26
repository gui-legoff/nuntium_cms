<?php

if( isset($_POST['connect']) ){

    if( !empty($_POST['login']) && !empty($_POST['pass'])  ){

        /** Securité a améliorer ajouter un bindparam  */
        $login = htmlentities(addslashes($_POST['login']));
        $pass = htmlentities(addslashes($_POST['pass']));

        $login_form = new login_form($db);
        $message= $login_form->login_form($login,$pass);

    }else{
        $message='<script>$.notify("champs vides ou incomplet !", {type:"danger",icon:"times"});</script>';
    }
}

?>