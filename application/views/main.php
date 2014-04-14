<div id="content">
	<h2>문의 및 신청현황 <span class="info"></span><span class="viewall"><select><option>전체보기</option><option>참가신청폼</option><option>문의폼</option><option>카카오문의폼</option><option>회원관리폼</option></select> <input type="text"> <a class="buttongray">검색</a></span></h2> 
	<table class="formlist">
		<tr><th>처리여부</th><th>결제상태</th><th>신청폼</th><th>등록시간</th><th>처리시간</th><th>결제수단</th><th></th></tr>
        <?php
        foreach($form_data->result() as $row) {
            echo '<tr><td>';
            if($row->form_template == 1) echo '<a href="/form_data/detail/'.$row->id.'">'.$row->process_status.'</a>';
            else if($row->form_template == 2 || $row->form_template == 3) echo '<a href="/form_data/inquiry/'.$row->id.'">'.$row->process_status.'</a>';
            echo '</td><td>'.$row->pay_status.'</td><td><a href="/form_data/form/'.$row->form_id.'">'.$row->form_name.'</a></td><td>'.$row->regist_date.'</td><td></td><td>'.$row->pay_method.'</td><td>';
            if($row->process_status == '미처리') echo '<a href="/form_data/change_status_confirm/'.$row->id.'">확인</a>';
            else echo '확인';
            if($row->form_template == 1)
                echo ' / <a href="/form_data/detail/'.$row->id.'">';
            else if($row->form_template == 2 || $row->form_template == 3)
                echo ' / <a href="/form_data/inquiry/'.$row->id.'">';
            echo '자세히</a></td></tr>';
        }
        ?>

	</table>
</div>