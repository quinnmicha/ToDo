<div class='col-12' style='border:black 2px dashed'></div>
    <h1>Accomplished</h1>

<?php foreach ($taskDataOld as $task): ?>
    <div class="week" style='background-color:<?php echo $task['color']; ?>;'>
        <a href="#0" style="float:right;color:blue;">back to top</a>
        <h4 id="1" style="color:grey;"><?php echo date('l | M j',strtotime($task['noteDate'])); ?></h4>
        <p style="color:grey;"><?php echo date('z',strtotime($task['noteDate'])) - date('z');  ?> Days Away</p>

        <div class="form-check">
            <input class="form-check-input activePost" type="checkbox" style="color:blue;"  data-note-id="<?php echo $task['noteID']; ?>" data-note-active="0" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1" style="color:grey;">
            <?php echo $task['noteText'];  ?>  
            </label>
        </div>
        <span class="d-inline-block mt-4" style="font-size:2em;">
            <a href='tasks.php?action=delete&delete=<?php echo $task['noteID']; ?>'><i class="text-danger fas fa-trash-alt"></i></a>
        </span>

    </div>
    <?php    endforeach; ?>