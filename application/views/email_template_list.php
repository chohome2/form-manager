    <ul class="submenu">
        <li><a href="/email">이메일 발송</a></li>
        <li class="active"><a href="/email/template">이메일 탬플릿</a></li>
    </ul>
    <div id="content">
        <div>
            <h3>탬플릿 목록</h3>
            <table class="data">
                <?php
                foreach($template_list->result() as $row) {
                    echo '<tr><td><a href="/email/template_setting/'.$row->id.'">'.$row->name.'</td></tr>';
                }
                ?>
            </table>
            <a href="/email/template_setting/new" class="buttongray">탬플릿 추가</a>
        </div>
    </div>
