<?php foreach($classes AS $class): ?>
        <form action="../ToDo/classes.php" method="post">
            <input type="hidden" value="editClass" name="action">
            <input type='hidden' value='<?php echo $class['classID']; ?>' name='classID'>
            <div class="form-group">
                <div class="form-row">
                    <input type="hidden" name="action" value ="editClass">
                    <label class="control-label" for="className">class Name:</label>
                    <input type="text" class="form-control" style="border-color: #5380b7;" class="className" value="<?php echo $class['className']; ?>" name="className" >
                    <div class="invalid-feedback">Please type your class name.</div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <label class="control-label" for="color">Color (stay light):</label>
                    <input type="color" class="form-control" style="border-color: #5380b7;" id="color" name="color" value='<?php echo $class['color']; ?>'>
                    <div class="invalid-feedback">ErroMessage</div>
                </div>
            </div>
            <div class='mb-5'>
                <input type="submit" class="btn btn-success"  value="Change This Class" id="submitAdd">
                <a class='btn btn-danger ml-4' href='classes.php?action=delete&delete=<?php echo $class['classID']; ?>'>Delete Class</a>
            </div>
            

            
        </form>
        <?php endforeach; ?>