<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ( new DirectoryIterator("../assets/modules/uploads") as $elements ){
                if ( !$elements->isDot()){
                ?>
                    <tr>
                        <td><?= $elements->getFilename() ?></td>
                        <td>
                            <form method="post">
                                <button type="submit" class="btn btn-outline-danger ml-3" name="delete" value="<?= $elements->getFilename() ?>">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
            }
            ?>    
        </tbody>    
    </table>    
</div>