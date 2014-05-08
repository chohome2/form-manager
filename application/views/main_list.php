<ul class="submenu">
    <li <?php if($status == '미처리') echo 'class="active"';?>><a href="/">미처리 목록</a></li>
    <li <?php if($status == '확인') echo 'class="active"';?>><a href="/home/check">확인 목록</a></li>
    <li <?php if($status == '처리') echo 'class="active"';?>><a href="/home/complete">처리 목록</a></li>
</ul>
<div id="content">
	<table class="formlist">
		<tr><th>처리여부</th><th>결제상태</th><th>신청폼</th><th>등록시간</th><th>처리시간</th><th>결제수단</th><th></th></tr>
        <?php
        foreach($form_data->result() as $row) {
            echo '<tr><td>';
            if($row->form_template == 1) echo '<a href="/form_data/detail/'.$row->id.'">'.$row->process_status.'</a>';
            else if($row->form_template == 2 || $row->form_template == 3) echo '<a href="/form_data/inquiry/'.$row->id.'">'.$row->process_status.'</a>';
            echo '</td><td>'.$row->pay_status.'</td><td><a href="/form_data/form/'.$row->form_id.'">'.$row->form_name.'</a></td><td>'.$row->regist_date.'</td><td></td><td>'.$row->pay_method.'</td><td>';
            if($row->process_status == '미처리') echo '<a href="/form_data/change_status_confirm/'.$row->id.'">확인</a> / ';
            if($row->form_template == 1)
                echo '<a href="/form_data/detail/'.$row->id.'">';
            else if($row->form_template == 2 || $row->form_template == 3)
                echo '<a href="/form_data/inquiry/'.$row->id.'">';
            echo '자세히</a></td></tr>';
        }
        ?>

	</table>
</div>