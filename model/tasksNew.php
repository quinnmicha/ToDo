<?php foreach ($taskDataNew as $task): ?>
    <div class="week" style='background-color:<?php echo $task['color']; ?>;'>
        <a href="#0" style="float:right;color:blue;">back to top</a>
        <h4 id="1"><?php echo date('l | M j',strtotime($task['noteDate'])); ?></h4>
        <h6><?php echo $task['className'];?></h6>
        <p><?php echo date('z',strtotime($task['noteDate'])) - date('z');  ?> Days Away</p>
        
        <div class="form-check">
            <input class="form-check-input unactivePost" type="checkbox" style="color:blue;" data-note-id="<?php echo $task['noteID']; ?>" data-note-active="1" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">
            <?php echo $task['noteText']; ?>  
            </label>
        </div>

    </div>
    <?php    endforeach; ?>
