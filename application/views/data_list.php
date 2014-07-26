<ul class="submenu">
    <li><a href="/form">신청폼 리스트</a></li>
    <li <?php if($id == 'new') echo 'class="active"';?>><a href="/form/setting/new">신청폼 생성</a></li>
    <li><a href="/form/field">공통환경설정</a></li>
</ul>
<div id="content">
    <h1><?php echo $form->name?><span class="viewall"><a href="/form/setting/<?php echo $form->id?>">+폼설정</a> / 분류: <select><option>12기</option><option>11기</option><option>전체보기</option></select> / 검색 / 고급검색 / 표시건수:100건</span> </h1>
    <table>
        <tr>
        <?php
        $view_fields = explode("\t",$form->view_fields);
        for($i=0;$i<count($view_fields);$i++) {
            echo '<th>'.$view_fields[++$i].'</th>';
        }
        ?>
        <th></th></tr>

        <?php
        $account = $this->session->userdata('logged_in');
        if($account['account_id'] != 'admin') {
        }
        foreach($form_data->result() as $row) {
            $row = (array)$row;
            if($account['account_id'] != 'admin' && $row['process_status'] == '삭제') continue;
            $link = '';
            if($row['form_template'] == 1)
                $link = '/form_data/detail/'.$row['id'];
            else if($row['form_template'] == 2 || $row['form_template'] == 3)
                $link = '/form_data/inquiry/'.$row['id'];

            echo '<tr class="pointer" onclick="window.location=\''. $link .'\'">';
            for($i=0;$i<count($view_fields);$i++) {
                echo '<td>'.$row[$view_fields[$i++]].'</td>';
            }
            if($row['form_template'] == 1)
                echo '<td><a href="/form_data/detail/'.$row['id'].'">보기</a>';
            else if($row['form_template'] == 2 || $row['form_template'] == 3)
                echo '<td><a href="/form_data/inquiry/'.$row['id'].'">보기</a>';
            echo ' / <a href="/form_data/modify/detail/'.$row['id'].'">수정</a></td></tr>';
        }
        ?>

    </table>
    <!--<div class="paging">1 2 3 4 ...</div>
    <a href="" class="button">엑셀저장</a>-->
</div>
