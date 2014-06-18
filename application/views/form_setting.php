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
		<tr><th>현재분류선택</th><td><select name="classify">
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
                <strong>치환코드</strong><br>
                [NAME] : 신청자이름</td></tr>
		
		
		<tr>
            <td rowspan=8 class="category">이메일설정</td>
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
                <select name="user_email_template_id">
                    <?php
                    foreach ($template_list->result() as $row)
                    {
                        echo '<option value="'.$row->id.'" ';
                        if($form->user_email_template_id == $row->id) echo 'selected';
                        echo '>'.$row->name.'</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>
		<tr>
            <th>이메일 본문내용</th>
            <td><textarea name="mailtext1" maxlength="80" style="width:100%;"><?php echo $form->email_content_to_user;?></textarea><br><strong>치환코드</strong><br>
                [NAME] : 신청자이름<br>[INFO] : 신청정보</td>
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
            <td><select name="admin_email_template_id">
                    <?php
                    foreach ($template_list->result() as $row)
                    {
                        echo '<option value="'.$row->id.'" ';
                        if($form->admin_email_template_id == $row->id) echo 'selected';
                        echo '>'.$row->name.'</option>';
                    }
                    ?>
            </select></td>
        </tr>
		<tr>
            <th>이메일 본문내용</th>
            <td><textarea name="mailtext2" maxlength="80" style="width:100%;"><?php echo $form->email_content_to_admin;?></textarea></td>
        </tr>
        <tr>
            <th>문의폼 답변시 사용할<br>이메일 탬플릿 선택</th>
            <td><select name="inquiry_email_template_id">
                    <?php
                    foreach ($template_list->result() as $row)
                    {
                        echo '<option value="'.$row->id.'" ';
                        if($form->inquiry_email_template_id == $row->id) echo 'selected';
                        echo '>'.$row->name.'</option>';
                    }
                    ?>
                </select> <span class="info">*문의폼에서만 사용</span></td>
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
            if("<?php echo $id?>" == "new") {
                alert("폼 생성시에는 분류 추가를 할 수 없습니다. 폼 생성 후에 분류를 설정하세요.");
                return;
            }

            var data = {
                id:"<?php echo $id?>",
                name:$("#classifyName").val()
            };
            $.post("/form/addClassify",data,function(data) {
                //console.log(data);
                alert("분류추가가 완료되었습니다.");
                location.reload();
            });
        });
    });
</script>