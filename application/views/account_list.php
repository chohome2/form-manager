<ul class="submenu">
	<li class="active"><a href="/account">계정 리스트</a></li>
	<li><a href="/account/setting/new">계정 생성</a></li>
</ul>

<div id="content">
	<table class="formlist">
		<tr><th>아이디</th><th>부서</th><th>이름</th><th>연락처</th><th>관리권한</th></tr>
        <?php
        foreach($account_list->result() as $row) {
            echo '<tr><td><a href="/account/setting/'.$row->id.'">'.$row->account_id.'</a></td><td>'.$row->department.'</td><td>'.$row->name.'</td><td>'.$row->phone.'</td><td></td></tr>';
        }
        ?>
	</table>
</div>