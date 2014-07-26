<ul class="submenu">
	<li class="active"><a href="/form">신청폼 리스트</a></li>
	<li><a href="/form/setting/new">신청폼 생성</a></li>
	<li><a href="/form/field">공통환경설정</a></li>
</ul>

<div id="content">

	<h2>센터신청폼</h2>
	<table class="formlist">
		<?php if($this->account_model->isRole('열람',1)):?>
        <tr><td width="90%"><a href="/form_data/form/1">메인센터 참가신청</a></td><td><a href="/form/setting/1">설정</a></td></tr>
		<?php endif?>
        <?php if($this->account_model->isRole('열람',2)):?>
        <tr><td width="90%"><a href="/form_data/form/2">한국지역센터 참가신청</a></td><td><a href="/form/setting/2">설정</a></td></tr>
        <?php endif?>
        <?php if($this->account_model->isRole('열람',3)):?>
        <tr><td width="90%"><a href="/form_data/form/3">지역센터 방문상담예약</a></td><td><a href="/form/setting/3">설정</a></td></tr>
        <?php endif?>
	</table>

	<h2>참가신청폼<span class="viewall"></span></h2> 
	<table class="formlist">
        <?php if($this->account_model->isRole('열람',4)):?>
		<tr><td width="90%"><a href="/form_data/form/4">대학생캠프 참가신청</a></td><td><a href="/form/setting/4">설정</a></td></tr>
        <?php endif?>
        <?php if($this->account_model->isRole('열람',5)):?>
        <tr><td width="90%"><a href="/form_data/form/5">청소년캠프 참가신청</a></td><td><a href="/form/setting/5">설정</a></td></tr>
        <?php endif?>
        <?php if($this->account_model->isRole('열람',6)):?>
        <tr><td width="90%"><a href="/form_data/form/6">교원직무연수 참가신청</a></td><td><a href="/form/setting/6">설정</a></td></tr>
        <?php endif?>
        <?php if($this->account_model->isRole('열람',7)):?>
        <tr><td width="90%"><a href="/form_data/form/7">교원생활연수 참가신청</a></td><td><a href="/form/setting/7">설정</a></td></tr>
        <?php endif?>
	</table>

	<h2>1:1 문의폼</h2>
	<table class="formlist">
        <?php if($this->account_model->isRole('열람',8)):?>
		<tr><td width="90%"><a href="/form_data/form/8">마음수련홈페이지 한국 문의</a></td><td><a href="/form/setting/8">설정</a></td></tr>
        <?php endif?>
	</table>


	<h2>카카오톡 문의폼</h2>
	<table class="formlist">
        <?php if($this->account_model->isRole('열람',9)):?>
		<tr><td width="90%"><a href="/form_data/form/9">마음수련홈페이지 카카오톡 문의</a></td><td><a href="/form/setting/9">설정</a></td></tr>
        <?php endif?>
	</table>

</div>