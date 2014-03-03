<ul class="submenu">
    <li><a href="/form">신청폼 리스트</a></li>
    <li><a href="/form/setting">신청폼 생성/설정</a></li>
    <li class="active"><a href="/form/field">공통환경설정</a></li>
</ul>

<div id="content">
	<table class="setdata">
		<tr><td rowspan=1 class="category">알림설정</td><th>알림시간설정</th><td>등록 후 미처리 <input type="text" value="60">분 후부터 알림<br> <input type="text" value="20">분 단위로 알림</td></tr>
	</table>

	<table class="setdata">
		<tr><td rowspan=3 class="category">추가필드(문자열)</td><th>교원 평일형 연수 장소</th><td><textarea>경남-창원운남중,마산수련회,김해수련회
대구-칠곡수련회,성서수련회,남산수련회
대전-둔산수련회</textarea></td></tr>
		<tr><th>교원연수 소속교육청 지역</th><td><input type="text" style="width:100%" value="서울,대전,대구,부산,광주,전라..."></td></tr>
		<tr><th>대학생캠프 차량탑승지역</th><td><input type="text" style="width:100%" value="서울사당,대전,대구,부산..."></td></tr>
		<tr><td rowspan=1 class="category">추가필드(DB)</td><th>신청경로</th><td><input type="text" style="width:100%" value="브로셔,포스터,전단지,인터넷,페이스북..."></td></tr>
	</table>

	<a href="data_modify.php" class="button">변경</a>