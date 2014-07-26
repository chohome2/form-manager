<ul class="submenu">
	<li><a href="/account">계정 리스트</a></li>
	<li class="active"><a href="/account/setting/new">계정 생성</a></li>
</ul>

<div id="content">
	<div class="block">
        <?php echo validation_errors(); ?>
        <?php if($id == 'new') echo form_open('account/setting/new'); else echo form_open('account/setting/'.$id);?>
		<table class="setdata">
			<tr><th>아이디</th><td><input name="account_id" type="text" value="<?php echo $account->account_id?>"></td></tr>
			<tr><th>비밀번호</th><td><input name="account_pw" type="text" value="<?php echo $account->account_pw?>"></td></tr>
			<tr><th>이름</th><td><input name="name" type="text" value="<?php echo $account->name?>"></td></tr>
			<tr><th>부서</th><td><select name="department"><option value="법인" <?php if($account->department == '법인') echo 'selected'?>>법인</option><option value="참출판사" <?php if($account->department == '참출판사') echo 'selected'?>>참출판사</option><option value="대학생회" <?php if($account->department == '대학생회') echo 'selected'?>>대학생회</option><option value="청소년회" <?php if($account->department == '청소년회') echo 'selected'?>>청소년회</option><option value="교원회" <?php if($account->department == '교원회') echo 'selected'?>>교원회</option></select></td></tr>
			<tr><th>연락처</th><td><input name="phone" type="text" value="<?php echo $account->phone?>"></td></tr>
			<tr><th>이메일</th><td><input name="email" type="text" value="<?php echo $account->email?>"></td></tr>
			<tr><th>권한설정</th><td>
    <?php
    //print_r($account_role);
    foreach($form->result() as $row) {
        $check1 = $account_role[$row->id."\t폼설정"]?'checked':'';
        $check2 = $account_role[$row->id."\t수정"]?'checked':'';
        $check3 = $account_role[$row->id."\t삭제"]?'checked':'';
        $check4 = $account_role[$row->id."\t열람"]?'checked':'';
        $check5 = $account_role[$row->id."\tsms발송"]?'checked':'';
        $check6 = $account_role[$row->id."\t이메일발송"]?'checked':'';
        echo $row->name.
            ' <input type="checkbox" name="role[]" value="'.$row->id."\t".$row->name."\t".'폼설정" '. $check1 .'>폼설정'.
            ' <input type="checkbox" name="role[]" value="'.$row->id."\t".$row->name."\t".'수정" '. $check2 .'>수정 '.
            ' <input type="checkbox" name="role[]" value="'.$row->id."\t".$row->name."\t".'삭제" '. $check3 .'>삭제 '.
            ' <input type="checkbox" name="role[]" value="'.$row->id."\t".$row->name."\t".'열람" '. $check4 .'>열람 '.
            ' <input type="checkbox" name="role[]" value="'.$row->id."\t".$row->name."\t".'sms발송" '. $check5 .'>sms발송 '.
            ' <input type="checkbox" name="role[]" value="'.$row->id."\t".$row->name."\t".'이메일발송" '. $check6 .'>이메일발송<br>';
    }
    ?>

			</td></tr>
		</table>
        <input type="submit" class="button" value="<?php if($id == 'new') echo '생성'; else echo '변경';?>">
        </form>
	</div>

</div>