<div id="content">
    <h1><?php echo $form_data->form_name?></h1>
    <div class="block">
        <a href="/form_data/change_status/2/<?php echo $form_data->id?>/inquiry" class="button">처리</a>
        <a href="/form_data/change_status/1/<?php echo $form_data->id?>/inquiry" class="button">확인</a>
        <a href="/form_data/change_status/0/<?php echo $form_data->id?>/inquiry" class="button">미처리</a>
        <a href="/form_data/change_status/3/<?php echo $form_data->id?>/inquiry" class="button">삭제</a>
        <table class="data">
            <?php
            $form_data = (array)$form_data;
            $view_fields = explode("\t",$form->used_fields);
            for($i=0;$i<count($view_fields);$i+=2) {
                echo '<tr><th>'.$view_fields[$i+1].'</th><td>'.$form_data[$view_fields[$i]].'</td></tr>';
            }
            ?>
            <!--<tr><th>답변내용</th><td><?php echo $form_data['answer_text']?></td></tr>-->
        </table>
        <?php if($form_data['process_status'] == '미처리' || $form_data['process_status'] == '확인') {?>
        <form method="POST" action="/form_data/answer/<?php echo $form_data['id']?>">
        <table class="data">
            <tr><th>답변내용</th><td><textarea name="answer_text" style="width:100%;height:200px;"></textarea></td></tr>
        </table>
        <input type="hidden" name="email" value="<?php echo $form_data['email']?>">
            <input type="hidden" name="inquiry_email_template_id" value="<?php echo $form->inquiry_email_template_id?>">
        <input type="submit" class="button" value="답변하기">
        </form>
        <?php } ?>
        <h2><?php echo $form_data['email']?>님의 지난 문의내용 보기</h2>
        <?php
        foreach($inquiry_data->result() as $row) {
            if($row->id == $form_data['id']) continue;
            echo '<table class="data">';
            echo '<tr><th>처리일시</th><td>'.$row->confirm_date.'</td></tr>';
            echo '<tr><th>문의내용</th><td><a href="data_reply.php">'.$row->inquiry_text.'</a></td></tr>';
            echo '<tr><th>답변내용</th><td>'.$row->answer_text.'</td></tr>';
            echo '</table>';
            echo '<br>';
        }
        ?>

    </div>
    <div class="block">
        <br>
        <table class="data">
            <tr><th>이메일 탬플릿 미리보기</th></tr>
            <tr><td><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td></tr>
        </table>
    </div>
</div>
