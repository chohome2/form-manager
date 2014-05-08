<div id="content">
    <h1><?php echo $form_data->form_name?></h1>
    <div class="block">
        <?php echo validation_errors(); ?>
        <?php echo form_open('form_data/modify/'.$type.'/'.$form_data->id); ?>

        <input type="hidden" name="id" value="<?php echo $form_data->id?>">
        <table class="data">
            <?php
            $form_data = (array)$form_data;
            $view_fields = explode("\t",$form->used_fields);
            for($i=0;$i<count($view_fields);$i+=2) {
                echo '<tr><th>'.$view_fields[$i+1].'</th><td><input type="text" name="'.$view_fields[$i].'" value="'.$form_data[$view_fields[$i]].'"></td></tr>';
            }
            ?>
        </table>
        <input type="submit" class="button" value="정보수정">
        </form>
    </div>
</div>
