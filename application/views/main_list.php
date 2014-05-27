<ul class="submenu">
    <li <?php if($status == '미처리') echo 'class="active"';?>><a href="/">미처리 목록</a></li>
    <li <?php if($status == '확인') echo 'class="active"';?>><a href="/home/check">확인 목록</a></li>
    <li <?php if($status == '처리') echo 'class="active"';?>><a href="/home/complete">처리 목록</a></li>
</ul>
<h3> * 상태를 클릭하면 다음 상태로 넘어갑니다.</h3>
<div id="content">
	<table class="formlist">
		<tr><th>상태(처리여부)</th><th>등록시간</th><th>처리시간</th><th>폼이름</th><th>신청정보</th><th>결제상태</th><th>결제수단</th></tr>
        <?php
        foreach($form_data->result() as $row) {
            $link = '';
            if($row->form_template == 1) $link =  '/form_data/detail/'.$row->id;
            else if($row->form_template == 2 || $row->form_template == 3) $link =  '/form_data/inquiry/'.$row->id;;

            echo '<tr class="pointer" onclick="window.location=\''. $link .'\'"><td>';
            if($row->process_status == '미처리') echo '<a href="/form_data/change_status_confirm/'.$row->id.'">'.$row->process_status.'</a>';
            else if($row->process_status == '확인') echo '<a href="/form_data/change_status_complete/'.$row->id.'">'.$row->process_status.'</a>';
            else if($row->process_status == '처리') echo $row->process_status;

            echo '</td><td>'.$row->regist_date.'</td><td>'.$row->confirm_date.'</td><td><a href="/form_data/form/'.$row->form_id.'">'.$row->form_name.'</a></td>';
            echo '<td>이름 | 이메일 | 전화번호</td>';
            echo '<td>'.$row->pay_status.'</td><td>'.$row->pay_method.'</td></tr>';
        }
        ?>
	</table>
</div>