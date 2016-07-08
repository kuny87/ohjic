<div class="span2" style="text-align: center;">
    <ul class="nav nav-tabs nav-stacked">
        <?php
        foreach ($lists as $entry) {
            if($entry->num == 1) {
                ?>
                <li><a href="/board/login"> <?= $entry->list_name ?></a></li>
            <?php
            }else if($entry->num == 2){
            ?>
                <li><a href="/board/get"> <?= $entry->list_name ?></a></li>
            <?php
            }
        }
        ?>

    </ul>
</div>
