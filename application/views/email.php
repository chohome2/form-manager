<ul class="submenu">
    <li class="active"><a href="/email">이메일 발송</a></li>
    <li><a href="/email/template">이메일 탬플릿</a></li>
</ul>
<div id="content">
    <div class="block">
        <input type="text" id="add-email-number"> <button class="buttongray" id="add-email">이메일 추가</button>
        <table class="boxed">
            <tr><th>발송대상폼 선택</th><th>분류선택</th><th>이메일 선택</th></tr>
            <tr>
                <td>
                    <ul>
                        <?php
                        foreach($form_list->result() as $row) {
                            echo '<li><input type="radio" value="'.$row->form_id.'" name="form">'.$row->name.'</li>';
                        }
                        ?>
                    </ul>
                </td>
                <td>
                    <span class="info">
                        <span id="selectAllClassify" style="cursor:pointer;">전체선택</span>
                        /
                        <span id="unselectAllClassify" style="cursor:pointer;">전체선택해제</span>
                    </span>
                    <ul id="classify-list">
                    </ul>
                </td>
                <td>
                    <span class="info">
                        <span id="selectAllItem" style="cursor:pointer;">전체선택</span>
                        /
                        <span id="unselectAllItem" style="cursor:pointer;">전체선택해제</span>
                    </span>
                    <ul id="email-list">
                    </ul>
                </td>
            </tr>
        </table>
    </div>
    <div class="block">
        <table class="data">
            <tr><th>발송대상 수</th><td><span id="email-count">0</span> 개</td></tr>
            <tr>
                <th>이메일 템플릿</th>
                <td><select id="email-template">
                    <?php
                    foreach($template_list->result() as $row) {
                        echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                    }
                    ?>
                </select></td>
            </tr>
            <tr><th>문자내용</th><td><textarea id="email-content"></textarea></td></tr>
            <tr><th>설정</th><td><input type="checkbox" value="1" id="email-agree" checked>이메일 수신동의 대상자만 보내기</td></tr>
        </table>
        <button class="button" id="email-send">이메일을 선택하세요</button>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('input[name=form]').change(function() {
            $("#classify-list").html("data loading...");
            $("#email-list").html("");
            $.get("/form/getClassifies/" + $("input[name=form]:checked").val() ,function(data) {
                var html = '';
                $.each(data.data,function(index,value) {
                    html += '<li><input type="checkbox" value="' + value + '" name="classify[]">' + value + '</li>';
                });
                $("#classify-list").html(html);
                $('input[name="classify[]"]').change(function() {
                    selectChange();
                });
            },"json");
        });

        var selectChange = function() {
            var data = {};
            data.form_id = $("input[name=form]:checked").val();
            data.classify = [];
            data.agree = $("#email-agree").is(":checked")?1:0;

            $('input[name="classify[]"]').each(function () {
                if($(this).is(":checked")) data.classify.push($(this).val());
            });
            if(!data.form_id || data.classify.length == 0) return;

            $("#email-list").html("data loading...");
            $.get("/email/getEmails",data,function(data) {
                var html = '';
                $.each(data.data,function(index,value) {
                    html += '<li><input type="checkbox" value="' + value + '" name="email[]">' + value + '</li>';
                });
                $("#email-list").html(html);
                $("#email-count").html(0);
                $("#email-send").html("이메일을 선택하세요");
                $('input[name="email[]"]').change(function() {
                    var count = 0;
                    $('input[name="email[]"]').each(function () {
                        if($(this).is(":checked")) count ++;
                    });
                    $("#email-count").html(count);
                    var emailSendText = "이메일을 선택하세요";
                    if(count == 0) $("#email-send").html(emailSendText);
                    else $("#email-send").html("이메일 발송하기");
                });
            },"json");
        };
        $('input[name=form], input[name="classify[]"], #email-agree').change(function() {
            selectChange();
        });

        $("#add-email").click(function() {
            $("#email-list").append('<li><input type="checkbox" value="' + $("#add-email-number").val() + '" name="email[]">' + $("#add-email-number").val() + '</li>');
            $('input[name="email[]"]').change(function() {
                var count = 0;
                $('input[name="email[]"]').each(function () {
                    if($(this).is(":checked")) count ++;
                });
                $("#email-count").html(count);
                var emailSendText = "이메일을 선택하세요";
                if(count == 0) $("#email-send").html(emailSendText);
                else $("#email-send").html("이메일 발송하기");
            });
        });

        $("#email-send").click(function() {
            if($(this).html() != "이메일 발송하기") return;
            if($("#email-content").val().trim().length == 0) {
                alert("내용을 입력하세요.");
                return;
            }
            $(this).html("이메일 발송중입니다. 기다려주세요.");
            var data = {};
            data.template_id = $('#email-template option:selected').val();
            data.email_list = [];
            data.message = $("#email-content").val();
            $('input[name="email[]"]').each(function () {
                if($(this).is(":checked")) data.email_list.push($(this).val());
            });
            console.log(data);
            $.post("/email/sendEmail",data,function(data) {
                console.log(data);
                alert("이메일 발송이 완료되었습니다.")
                $("#email-send").html("이메일 발송하기");
            });
        });
        $("#selectAllClassify").click(function() {
            $("input[name='classify[]']:checkbox").each(function() {
                $(this).prop("checked", true);
            });
            selectChange();
        });
        $("#unselectAllClassify").click(function() {
            $("input[name='classify[]']:checkbox").each(function() {
                $(this).prop("checked", false);
            });
            selectChange();
        });

        $("#selectAllItem").click(function() {
            $("input[name='email[]']:checkbox").each(function() {
                $(this).prop("checked", true);
            });
            $('input[name="email[]"]').trigger("change");
        });

        $("#unselectAllItem").click(function() {
            $("input[name='email[]']:checkbox").each(function() {
                $(this).prop("checked", false);
            });
            $('input[name="email[]"]').trigger("change");
        });

    });
</script>