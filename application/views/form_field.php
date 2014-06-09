<ul class="submenu">
    <li><a href="/form">신청폼 리스트</a></li>
    <li><a href="/form/setting/new">신청폼 생성</a></li>
    <li class="active"><a href="/form/field">공통환경설정</a></li>
</ul>

<div id="content">
    <?php echo validation_errors(); ?>
    <?php echo form_open('form/field'); ?>
    <table class="setdata">
		<tr>
            <td rowspan=1 class="category">알림설정</td>
            <th>알림시간설정</th>
            <td>등록 후 미처리 <input type="text" name="field01" value="<?php echo $extra_list['field01']?>">분 후부터 알림<br>
                <input type="text" name="field02" value="<?php echo $extra_list['field02']?>">분 단위로 알림</td></tr>
	</table>

	<table class="setdata">
		<tr>
            <td rowspan=3 class="category">추가필드(문자열)</td>
            <th>교원 평일형 연수 장소</th>
            <td><textarea name="field03"><?php echo $extra_list['field03']?></textarea></td></tr>
		<tr>
            <th>교원연수 소속교육청 지역</th>
            <td><input type="text" name="field04" style="width:100%" value="<?php echo $extra_list['field04']?>"></td></tr>
		<tr>
            <th>대학생캠프 차량탑승지역</th>
            <td><input type="text" name="field05" style="width:100%" value="<?php echo $extra_list['field05']?>"></td></tr>
		<tr>
            <td rowspan=1 class="category">추가필드(DB)</td>
            <th>신청경로</th><td><input type="text" name="field06" style="width:100%" value="<?php echo $extra_list['field06']?>"></td></tr>
	</table>

	<input type="submit" class="button" value="변경">
    </form>
</div>