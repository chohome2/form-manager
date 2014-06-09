    <ul class="submenu">
        <li><a href="/email">이메일 발송</a></li>
        <li class="active"><a href="/email/template">이메일 탬플릿</a></li>
    </ul>
    <div id="content">
        <div class="block">
            <?php echo validation_errors(); ?>
            <?php echo form_open('email/template_setting/'.$id); ?>
            <table class="data">
                <tr><th>탬플릿 이름</th><td><input name="name" type="text" style="width:100%;" value="<?php echo $template->name?>"></td></tr>
                <tr><th>이메일 제목</th><td><input name="title" type="text" style="width:100%;" value="<?php echo $template->title?>"></td></tr>
                <tr><th>상단HTML</th><td><textarea name="header"><?php echo $template->header?></textarea></td></tr>
                <tr><th>본문HTML</th><td><textarea name="body"><?php echo $template->body?></textarea></td></tr>
                <tr><th>하단HTML</th><td><textarea name="footer"><?php echo $template->footer?></textarea><br><span class="info">* 수신거부 링크를 넣어주세요</span></td></tr>
                <tr><th>치환코드정보</th><td>[NAME] : 신청자 이름<br>[ALLINFO] : 신청자의 모든 정보<br>[DENY] : 수신거부링크</td></tr>
            </table>
            <input type="submit" class="button" value="저장">
            <?php if($id != 'new') {?>
            <a href="/email/delete_template/<?php echo $id?>" class="buttongray">삭제</a>
            <?php }?>
            </form>
        </div>
        <div class="block">
            <table class="data">
                <tr><th>탬플릿 미리보기</th></tr>
                <tr><td><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td></tr>
            </table>
        </div>
    </div>