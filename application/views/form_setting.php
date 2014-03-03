<ul class="submenu">
    <li><a href="/form">신청폼 리스트</a></li>
    <li class="active"><a href="/form/setting">신청폼 생성/설정</a></li>
    <li><a href="/form/field">공통환경설정</a></li>
</ul>

<div id="content">
	<h1>메인센터 참가신청 - 설정 </h1>
	<table class="setdata">
		<tr><td rowspan=5 class="category">기본설정</td><th>신청폼 이름</th><td><input type="text"></td></tr>
		<tr><th>신청폼 탬플릿</th><td><input type="radio" name="group1" value="yes">참가신청폼 <input type="radio" name="group1" value="no">문의폼 <input type="radio" name="group1" value="no">카카오톡문의폼 <input type="radio" name="group1" value="no">회원관리폼<br><span class="info"></span></td></tr>
		<tr><th>현재분류선택</th><td><select><option>12</option><option>11</option><option>2014-01-22 분당세미나</option></select><br> + 분류추가 : <input type="text"> <a href="#" class="buttongray">추가</a></td></tr>
		<tr><th>사용필드 설정<br><a href="data_view.php" class="info">data_view.php에 표시되는 사용필드설정</a></th><td>논의사항: 해당 신청폼에서 사용하는 필드는 어떻게 정할 것인지?</td></tr>
		<tr><th>리스트 표시항목<br><a href="data_list.php" class="info">data_list.php에 표시되는 표시항목</a></th><td>이름,성별,이메일,연락처,참가예정날짜,결제상태,결제수단</td></tr>
		
		
		<tr><td rowspan=5 class="category">SMS설정</td><th>신청자에게 문자보내기</th><td><input type="radio" name="group1" value="yes">YES <input type="radio" name="group1" value="no">NO</td>
		<tr><th>발신번호</th><td><input type="text" name="" value=""></td></tr>
		<tr><th>문자내용</th><td><textarea maxlength="80" style="width:100%;">[NAME]님대학생캠프신청을환영합니다-[PAYMENTMSG]</textarea></td></tr>
		<tr><th>관리자에게 문자보내기</th><td><input type="radio" name="group1" value="yes">YES <input type="radio" name="group1" value="no">NO<br>관리자 연락처 : <input type="text"></td></tr>
		<tr><th>문자내용</th><td><textarea maxlength="80" style="width:100%;"></textarea><br>
			<strong>[NAME]</strong> : 신청자이름<br><strong>[PHONE]</strong> : 신청자연락처<br> <strong>[EMAIL]</strong> : 신청자이메일<br><strong>[PAYMENTMSG]</strong> : 결제 관련 메세지</td></tr>
		
		
		<tr><td rowspan=7 class="category">이메일설정</td><th>신청자에게 이메일보내기</th><td><input type="radio" name="group1" value="yes">YES <input type="radio" name="group1" value="no">NO</td></tr>
		<tr><th>발신정보</th><td>이름: <input type="text" name="" value=""> 이메일: <input type="text" name="" value=""></td></tr>
		<tr><th>이메일 탬플릿 선택</th><td><select><option>대학생캠프 신청자 메일</option><option>대학생캠프 문의답변 메일</option><option>마음수련 뉴스레터</option></select></td></tr>
		<tr><th>이메일 본문내용</th><td><textarea maxlength="80" style="width:100%;"></textarea></td></tr>
		<tr><th>관리자에게 이메일보내기</th><td><input type="radio" name="group1" value="yes">YES <input type="radio" name="group1" value="no">NO<br>관리자 이메일 : <input type="text"></td></tr>
		<tr><th>이메일 탬플릿 선택</th><td><select><option>참가신청 관리자 회신</option><option>대학생캠프 문의답변 메일</option><option>마음수련 뉴스레터</option></select></td></tr>
		<tr><th>이메일 본문내용</th><td><textarea maxlength="80" style="width:100%;"></textarea></td></tr>
		
		
		<tr><td rowspan=2 class="category">결제설정</td><th>결제기능이용</th><td><input type="checkbox"> 결제기능을 사용합니다<br><span class="info">* 결제기능을 사용하지 않는 참가신청폼: 지역센타방문예약 / 교원 생활 연수</span></td></tr>
		<tr><th>입금계좌설정</th><td><input type="text"><br><span class="info">* 참가신청폼은 결제가 연동되어 있으며, 무통장입금시 해당계좌가 표시됩니다.</span></td></tr>
		

		<tr><td rowspan=2 class="category">특수기능</td>
		<th>지역수련원 연동</th><td>
		<input type="checkbox"> 지역수련원의 대표 연락처로 확인링크를 전송 <br>
		<input type="checkbox"> 지역수련원의 대표 이메일로 신청정보를 전송<br>
		<input type="checkbox"> 지역수련원의 대표 계좌를 사용<br>
		* [지역수련원 참가신청폼]과 [지역수련원 방문예약폼] 에만 해당합니다</td></tr>
		<tr><th>이메일문의 답변확인문자</th><td><input type="checkbox"> 이메일 문의 답변 후, 문의자에게 확인문자 전송 (연락처가 있을 경우)<br><textarea maxlength="80" style="width:100%;">문의하신 내용에 대한 답변을 고객님의 이메일 [EMAIL]로 발송하였습니다</textarea> <br>* [문의폼]에만 해당합니다</td></tr>
	</table>

	<a href="data_modify.php" class="button">생성 or 변경</a>
<!--
	<table class="setdata">
		<tr><td colspan=2 class="category">기본설정</td></tr>
		<tr><th>신청폼 이름</th><td><input type="text"></td></tr>
		<tr><th>현재분류선택</th><td><select><option>12</option><option>11</option><option>2014-01-22 분당세미나</option></select><br> + 분류추가 : <input type="text"> <a href="#" class="buttongray">추가</a></td></tr>
		<tr><td colspan=2 class="category">SMS설정</td></tr>
		<tr><th>신청자에게 문자보내기</th><td><input type="radio" name="group1" value="yes">YES <input type="radio" name="group1" value="no">NO</td></tr>
		<tr><th>문자내용</th><td><textarea maxlength="80" style="width:100%;"></textarea></td></tr>
		<tr><th>관리자에게 문자보내기</th><td><input type="radio" name="group1" value="yes">YES <input type="radio" name="group1" value="no">NO</td></tr>
		<tr><th>문자내용</th><td><textarea maxlength="80" style="width:100%;"></textarea></td></tr>
		<tr><td colspan=2 class="category">이메일설정</td></tr>
		<tr><th>신청자에게 이메일보내기</th><td><input type="radio" name="group1" value="yes">YES <input type="radio" name="group1" value="no">NO</td></tr>
		<tr><th>이메일 탬플릿 선택</th><td><select><option>대학생캠프 신청자 메일</option><option>대학생캠프 문의답변 메일</option><option>마음수련 뉴스레터</option></select></td></tr>
		<tr><th>이메일내용</th><td><textarea maxlength="80" style="width:100%;"></textarea></td></tr>
		<tr><th>관리자에게 이메일보내기</th><td><input type="radio" name="group1" value="yes">YES <input type="radio" name="group1" value="no">NO</td></tr>
		<tr><td colspan=2 class="category">기타</td></tr>
		<tr><th>리스트 표시항목<br><a href="data_list.php">data_list.php에 표시되는 표시항목</a></th><td>이름,성별,이메일,연락처,참가예정날짜,결제상태,결제수단</td></tr>
	</table>
-->
<!--
	<table class="boxed">
		<tr><th>기본설정</th><td>신청폼 이름 : <input type="text"></td></tr>
		<tr><th>기수설정</th>
			<td>
			<ul><li>현재기수선택 : <select><option>12</option><option>11</option><option>2014-01-22 분당세미나</option></select></li>
			<li>새로운 기수 추가 : <input type="text"><button>추가</button></li>
			</li></ul>
			</td></tr>
		<tr><th>SMS설정</th>
			<td>
				<ul><li>신청자에게 문자보내기 : <input type="radio" name="group1" value="yes">YES <input type="radio" name="group1" value="no">NO</li>
				<li>문자내용 :<br><textarea maxlength="80"></textarea></li>
				<li>관리자에게 문자보내기 : <input type="radio" name="group1" value="yes">YES <input type="radio" name="group1" value="no">NO</li>
				<li>관리자 연락처 : <input type="text"></li>
				<li>문자내용 :<br><textarea></textarea></li>
				</ul>
			</td>
		</tr>
		<tr><th>이메일설정</th><td>
				<ul><li>신청자에게 이메일보내기 : <input type="radio" name="group1" value="yes">YES <input type="radio" name="group1" value="no">NO</li>
				<li>이메일 탬플릿 선택 :</li>
				<li>이메일내용 :<br><textarea maxlength="80"></textarea></li>
				<li>관리자에게 이메일보내기 : <input type="radio" name="group1" value="yes">YES <input type="radio" name="group1" value="no">NO</li>
				<li>관리자 연락처 : <input type="text"></li>
				<li>이메일내용 :<br><textarea></textarea></li>
				</ul>
		</td></tr>
		<tr><th>표시항목</th><td>name / phone / address / ... </td></tr>
		<tr><th>추가필드설정</th><td>교원생활연수 장소 선택</td></tr>
		<tr><th>기타</th><td></td></tr>
	</table>
</div>
-->