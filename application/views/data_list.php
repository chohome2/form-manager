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
        foreach($form_data->result() as $row) {
            $row = (array)$row;
            echo '<tr>';
            for($i=0;$i<count($view_fields);$i++) {
                echo '<td>'.$row[$view_fields[$i++]].'</td>';
            }
            echo '<td><a href="/form_data/detail/'.$row['id'].'">보기</a> / <a href="data_modify.php">수정</a></td></tr>';
        }
        ?>

    </table>
    <!--<div class="paging">1 2 3 4 ...</div>
    <a href="" class="button">엑셀저장</a>-->
</div>
