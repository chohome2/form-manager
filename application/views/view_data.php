<div id="content">
    <h1><?php echo $form_data->form_name?></h1>
    <div class="block">
        <a href="/form_data/change_status/2/<?php echo $form_data->id?>/detail" class="button">처리</a>
        <a href="/form_data/change_status/1/<?php echo $form_data->id?>/detail" class="button">확인</a>
        <a href="/form_data/change_status/0/<?php echo $form_data->id?>/detail" class="button">미처리</a>
        <a href="/form_data/change_status/3/<?php echo $form_data->id?>/detail" class="button">삭제</a>
        <a href="/form_data/change_status/4/<?php echo $form_data->id?>/detail" class="button">취소</a>
        <?php if($form_data->pay_id) {?>
        <a href="/form_data/pay_cancel/<?php echo $form_data->id?>" class="button">결제취소</a>
        <?php }?>
        <?php if($form_data->pay_id) {?>
        <a href="/form_data/pay_force_cancel/<?php echo $form_data->id?>" class="button">강제결제취소</a>
        <?php }?>
        <!--<a href="" class="buttongray">참가확인 이메일 보내기</a> <a href="" class="buttongray">문자 보내기</a>-->
        <table class="data">
            <?php
            $form_data = (array)$form_data;
            $view_fields = explode("\t",$form->used_fields);
            for($i=0;$i<count($view_fields);$i+=2) {
                echo '<tr><th>'.$view_fields[$i+1].'</th><td>'.$form_data[$view_fields[$i]].'</td></tr>';
            }
            ?>

            <tr><th>메모</th><td>
                    <form method="POST" action="/form_data/memo/<?php echo $form_data['id']?>">
                        <textarea name="memo"><?php echo $form_data['memo']?></textarea><br><input type="submit" class="button" value="메모입력"></a>
                    </form>
                </td></tr>

        </table>
        <a href="/form_data/form/<?php echo $form_data["form_id"]?>" class="buttongray">신청폼 리스트 보기</a>
        <a href="/form_data/modify/detail/<?php echo $form_data["id"]?>" class="buttongray">정보수정</a>
    </div>
    <?php
    if($form->is_use_pay == 1) {
    ?>
    <div class="block">
        <h3>결제정보</h3>
        <table class="data">
            <tr><th>결제상태</th><td><?php echo $form_data['pay_status']?></td></tr>
            <tr><th>결제수단</th><td><?php echo $form_data['pay_method']?></td></tr>
            <tr><th>결제일시</th><td><?php echo $form_data['pay_approval_date'].' '.$form_data['pay_approval_time']?></td></tr>
            <tr><th>결제금액</th><td><?php echo $form_data['pay_approval_amount']?></td></tr>
            <tr><th>거래번호</th><td><?php echo $form_data['pay_id']?></td></tr>
            <tr><th>주문번호</th><td><?php echo $form_data['pay_shop_id']?></td></tr>
        </table>
    </div>
    <?php
    }
    ?>
</div>
