<div id="content">
    <h1><?php echo $form_data->form_name?></h1>
    <div class="block">
        <a href="/form_data/change_status/2/<?php echo $form_data->id?>/detail" class="button">처리</a>
        <a href="/form_data/change_status/1/<?php echo $form_data->id?>/detail" class="button">확인</a>
        <a href="/form_data/change_status/0/<?php echo $form_data->id?>/detail" class="button">미처리</a>
        <a href="/form_data/change_status/3/<?php echo $form_data->id?>/detail" class="button">삭제</a>
        <a href="" class="buttongray">참가확인 이메일 보내기</a> <a href="" class="buttongray">문자 보내기</a>
        <br><br><span class="info">* 삭제처리하면 목록에는 안나타나지만 DB에는 있다. 삭제된 데이터는 최고관리자만 볼 수 있다.</span>
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
    <div class="block">
        <a href="" class="button">무통장 입금확인</a> <a href="" class="button">무통장 입금대기</a> <a href="" class="button">신청/결제 취소</a>
        <table class="data">
            <tr><th>결제상태</th><td><?php echo $form_data['pay_status']?> - (결제완료/입금대기/결제취소)</td></tr>
            <tr><th>결제수단</th><td><?php echo $form_data['pay_method']?> - (카드결제/무통장입금/실시간계좌이체)</td></tr>
            <tr><th>결제일시</th><td></td></tr>
            <tr><th>결제정보</th><td><?php echo $form_data['pay_info']?></td></tr>
        </table>
    </div>
</div>
