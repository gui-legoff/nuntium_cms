<?php
$table="users";
require"controller/listing_users.php";
?>



<h1 class="h2">Liste :</h1>
    <?php echo $message ?>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <?php
                        /** Noms des colonnes */
                        foreach ($listing_users->nom_colonne($table,$dbname) as $r) {
                        echo "<th>".$r['column_name'];
                        } 
                    ?>
               </tr>
            </thead>
            <tbody>
                    <?php
                    /** Liste des membres avec leurs renseignements */
                    foreach ($listing_users->listing_users($table,$var) as $r) {
                        ?>
                            <tr>
                                <td><?php echo $r['login'] ?></td>
                                <td><?php echo $r['password'] ?></td>
                                <td><?php echo $r['nom'] ?></td>
                                <td>
                                    <form method="post" onChange="submit()">
                                    <input type="hidden" name="id" value="<?php echo $r['id'] ?>"/>    
                                        <select name="env" class="custom-select">
                                            <option value="oui" name="option"
                                                    <?php 
                                                        if($r['actif'] == 'oui' ){
                                                        echo " selected='selected' ";
                                                        }
                                                    ?>
                                            >oui</option>
                                            <option value="non" name="option"
                                                    <?php 
                                                        if($r['actif'] == 'non' ){
                                                        echo " selected='selected' ";
                                                        }
                                                    ?>
                                            >non</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        <?php
                    }
                    ?>
            </tbody>
        </table>
    </div>