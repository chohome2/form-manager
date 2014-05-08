<ul class="submenu">
    <li><a href="/form">신청폼 리스트</a></li>
    <li <?php if($id == 'new') echo 'class="active"';?>><a href="/form/setting/new">신청폼 생성</a></li>
    <li><a href="/form/field">공통환경설정</a></li>
</ul>

<div id="content">
	<h1><?php if($id == 'new') echo '신청폼 생성'; else echo '신청폼 수정';?></h1>
    <?php echo validation_errors(); ?>
    <?php echo form_open('form/setting/'.$id); ?>
	<table class="setdata">
		<tr><td rowspan=5 class="category">기본설정</td><th>신청폼 이름</th><td><input type="text" name="name" value="<?php echo $form->name?>"></td></tr>
		<tr><th>신청폼 탬플릿</th>
            <td>
                <input type="radio" name="template" value="1" <?php if($form->template == '1') echo 'checked'?>>참가신청폼
                <input type="radio" name="template" value="2" <?php if($form->template == '2') echo 'checked'?>>문의폼
                <input type="radio" name="template" value="3" <?php if($form->template == '3') echo 'checked'?>>카카오톡문의폼
                <input type="radio" name="template" value="4" <?php if($form->template == '4') echo 'checked'?>>회원관리폼<br><span class="info"></span></td></tr>
		<tr><th>현재분류선택</th><td><select name="classify"><option value="none">선택하세요</option>
    <?php
    foreach ($classify_list->result() as $row)
    {
        echo '<option value="'.$row->name.'" ';
        if($form->classify == $row->name) echo 'selected';
        echo '>'.$row->name.'</option>';
    }
    ?>
                </select><br> + 분류추가 : <input type="text" id="classifyName"> <a href="#" class="buttongray" id="addFormClassify">추가</a></td></tr>
		<tr><th>사용필드 설정</th>
            <td>
                <?php
                $used_fields = explode("\t",$form->used_fields);
                foreach ($field_list->result() as $row)
                {
                    echo '<input type="checkbox" name="use_field[]" value="'.$row->name."\t".$row->readable_name.'" ';
                    if(in_array($row->name,$used_fields)) echo 'checked';
                    echo '>'.$row->readable_name.' ';
                }
                ?>
            </td></tr>
		<tr><th>리스트 표시항목</th>
            <td>
                <?php
                $view_fields = explode("\t",$form->view_fields);
                foreach ($field_list->result() as $row)
                {
                    echo '<input type="checkbox" name="view_field[]" value="'.$row->name."\t".$row->readable_name.'" ';
                    if(in_array($row->name,$view_fields)) echo 'checked';
                    echo '>'.$row->readable_name.' ';
                }
                ?>
            </td></tr>
		
		
		<tr>
            <td rowspan=5 class="category">SMS설정</td><th>신청자에게 문자보내기</th>
            <td>
                <input type="radio" name="smsok1" value="1" <?php if($form->is_send_sms_to_user == 1) echo 'checked';?>>YES
                <input type="radio" name="smsok1" value="0" <?php if($form->is_send_sms_to_user == 0) echo 'checked';?>>NO
            </td>
		<tr>
            <th>발신번호</th><td><input type="text" name="smsnumber1" value="<?php echo $form->sms_number_to_user;?>"></td>
        </tr>
		<tr>
            <th>문자내용</th><td><textarea name="smstext1" maxlength="80" style="width:100%;"><?php echo $form->sms_content_to_user;?></textarea></td>
        </tr>
		<tr>
            <th>관리자에게 문자보내기</th>
            <td>
                <input type="radio" name="smsok2" value="1" <?php if($form->is_send_sms_to_admin == 1) echo 'checked';?>>YES
                <input type="radio" name="smsok2" value="0" <?php if($form->is_send_sms_to_admin == 0) echo 'checked';?>>NO
                <br>관리자 연락처 : <input type="text" name="smsnumber2" value="<?php echo $form->sms_number_to_admin;?>">
            </td>
        </tr>
		<tr>
            <th>문자내용</th><td><textarea name="smstext2" maxlength="80" style="width:100%;"><?php echo $form->sms_content_to_admin;?></textarea><br>
			<strong>[NAME]</strong> : 신청자이름<br><strong>[PHONE]</strong> : 신청자연락처<br> <strong>[EMAIL]</strong> : 신청자이메일<br><strong>[PAYMENTMSG]</strong> : 결제 관련 메세지</td></tr>
		
		
		<tr>
            <td rowspan=7 class="category">이메일설정</td>
            <th>신청자에게 이메일보내기</th>
            <td>
                <input type="radio" name="mailok1" value="1" <?php if($form->is_send_email_to_user == 1) echo 'checked';?>>YES
                <input type="radio" name="mailok1" value="0" <?php if($form->is_send_email_to_user == 0) echo 'checked';?>>NO
            </td>
        </tr>
		<tr>
            <th>발신정보</th>
            <td>
                이름: <input type="text" name="mailname1" value="<?php echo $form->email_name_to_user;?>">
                이메일: <input type="text" name="mailmail1" value="<?php echo $form->email_address_to_user;?>">
            </td>
        </tr>
		<tr>
            <th>이메일 탬플릿 선택</th>
            <td>
                <select><option>대학생캠프 신청자 메일</option><option>대학생캠프 문의답변 메일</option><option>마음수련 뉴스레터</option></select>
            </td>
        </tr>
		<tr>
            <th>이메일 본문내용</th>
            <td><textarea name="mailtext1" maxlength="80" style="width:100%;"><?php echo $form->email_content_to_user;?></textarea></td>
        </tr>
		<tr>
            <th>관리자에게 이메일보내기</th>
            <td>
                <input type="radio" name="mailok2" value="1" <?php if($form->is_send_email_to_admin == 1) echo 'checked';?>>YES
                <input type="radio" name="mailok2" value="0" <?php if($form->is_send_email_to_admin == 0) echo 'checked';?>>NO
                <br>관리자 이메일 : <input type="text" name="mailmail2" value="<?php echo $form->email_address_to_admin;?>">
            </td>
        </tr>
		<tr>
            <th>이메일 탬플릿 선택</th>
            <td><select><option>참가신청 관리자 회신</option><option>대학생캠프 문의답변 메일</option><option>마음수련 뉴스레터</option></select></td>
        </tr>
		<tr>
            <th>이메일 본문내용</th>
            <td><textarea name="mailtext2" maxlength="80" style="width:100%;"><?php echo $form->email_content_to_admin;?></textarea></td>
        </tr>
		
		
		<tr>
            <td rowspan=2 class="category">결제설정</td>
            <th>결제기능이용</th>
            <td>
                <input type="checkbox" name="ispay" value="1" <?php if($form->is_use_pay == 1) echo 'checked';?>> 결제기능을 사용합니다<br><span class="info">* 결제기능을 사용하지 않는 참가신청폼: 지역센타방문예약 / 교원 생활 연수</span>
            </td>
        </tr>
		<tr>
            <th>입금계좌설정</th>
            <td><input type="text" name="payaccount" value="<?php echo $form->pay_account;?>"><br><span class="info">* 참가신청폼은 결제가 연동되어 있으며, 무통장입금시 해당계좌가 표시됩니다.</span></td>
        </tr>
		

		<tr><td rowspan=2 class="category">특수기능</td>
		<th>지역수련원 연동</th><td>
		<input type="checkbox"> 지역수련원의 대표 연락처로 확인링크를 전송 <br>
		<input type="checkbox"> 지역수련원의 대표 이메일로 신청정보를 전송<br>
		<input type="checkbox"> 지역수련원의 대표 계좌를 사용<br>
		* [지역수련원 참가신청폼]과 [지역수련원 방문예약폼] 에만 해당합니다</td></tr>
		<tr><th>이메일문의 답변확인문자</th><td><input type="checkbox"> 이메일 문의 답변 후, 문의자에게 확인문자 전송 (연락처가 있을 경우)<br><textarea maxlength="80" style="width:100%;">문의하신 내용에 대한 답변을 고객님의 이메일 [EMAIL]로 발송하였습니다</textarea> <br>* [문의폼]에만 해당합니다</td></tr>
	</table>

	<input type="submit" class="button" value="<?php if($id == 'new') echo '생성'; else echo '변경';?>">
    </form>
</div>
<script>
    $(document).ready(function() {
        $("#addFormClassify").click(function() {
            $.get("/form/addClassify/" + $("#classifyName").val(),function(data) {
                location.reload();
            });
        });
    });
</script>