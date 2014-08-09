<div id="content">
    <h1><?php echo $form_data->form_name?></h1>
    <div class="block">
        <a href="/form_data/change_status/2/<?php echo $form_data->id?>/detail" class="button">처리</a>
        <a href="/form_data/change_status/1/<?php echo $form_data->id?>/detail" class="button">확인</a>
        <a onclick="if(confirm('미처리 상태로 되돌리시겠습니까?')) location.href='/form_data/change_status/0/<?php echo $form_data->id?>/detail';" class="button" style="cursor:pointer;">미처리</a>
        <a onclick="if(confirm('정말로 삭제하시겠습니까?')) location.href='/form_data/change_status/3/<?php echo $form_data->id?>/detail';" class="button" style="cursor:pointer;">삭제</a>
        <a onclick="if(confirm('신청을 취소하시겠습니까?')) location.href='/form_data/change_status/4/<?php echo $form_data->id?>/detail';" class="button" style="cursor:pointer;">취소</a>
        <?php if($form_data->pay_id) {?>
            <a onclick="if(confirm('결제를 취소하시겠습니까?')) location.href='/form_data/pay_cancel/<?php echo $form_data->id?>';" class="button" style="cursor:pointer;">결제취소</a>
        <?php }?>
        <?php if($form_data->pay_id) {?>
            <a onclick="if(confirm('실제 결제 상태와 상관없이 결제 취소로 표시합니다. 진행하시겠습니까?')) location.href='/form_data/pay_force_cancel/<?php echo $form_data->id?>';" class="button" style="cursor:pointer;">강제결제취소</a>
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
        <h3><br>결제정보</h3>
        <table class="data">
            <tr><th>결제상태</th><td><?php echo $form_data['pay_status']?></td></tr>
            <tr><th>결제수단</th><td><?php echo $form_data['pay_method']?></td></tr>
            <tr><th>결제일시</th><td><?php echo $form_data['pay_approval_date'].' '.$form_data['pay_approval_time']?></td></tr>
            <tr><th>결제금액</th><td><?php echo $form_data['pay_approval_amount']?></td></tr>
            <tr><th>거래번호</th><td><?php echo $form_data['pay_id']?></td></tr>
            <tr><th>주문번호</th><td><?php echo $form_data['pay_shop_id']?></td></tr>
            <tr><th>결제취소시간</th><td><?php echo $form_data['pay_cancel_date'].' '.$form_data['pay_cancel_time']?></td></tr>
            <tr><th>결제취소 현금영수증번호</th><td><?php echo $form_data['pay_cancel_cash_id']?></td></tr>
            <tr><th>결제취소사유</th><td><?php echo $form_data['pay_cancel_reason']?></td></tr>
            <tr><th>결제승인코드</th><td><?php echo $form_data['pay_approval_code']?></td></tr>
            <tr><th>카드종류코드</th><td><?php echo $form_data['pay_card_type_code']?></td></tr>
            <tr><th>카드회사코드</th><td><?php echo $form_data['pay_card_company_code']?></td></tr>
            <tr><th>할부개월</th><td><?php echo $form_data['pay_installment_month']?></td></tr>
            <tr><th>무통장입금계좌번호</th><td><?php echo $form_data['pay_vbank_account_number']?></td></tr>
            <tr><th>무통장입금은행코드</th><td><?php echo $form_data['pay_vbank_bank_code']?></td></tr>
            <tr><th>무통장예금주명</th><td><?php echo $form_data['pay_vbank_depositor']?></td></tr>
            <tr><th>무통장입금만료일</th><td><?php echo $form_data['pay_vbank_scheduled_date']?></td></tr>
            <tr><th>무통장입금자명</th><td><?php echo $form_data['pay_vbank_person_name']?></td></tr>
        </table>
    </div>
    <?php
    }
    ?>
</div>
