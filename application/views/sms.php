<div id="content">
    <div class="block">
        <input type="text" id="add-phone-number"> <button class="buttongray" id="add-phone">전화번호 추가</button>
        <table class="boxed">
            <tr><th>발송대상폼 선택</th><th>분류선택</th><th>전화번호 선택</th></tr>
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
                    <span class="info">전체선택 / 전체선택해제</span>
                    <ul>
                        <?php
                        foreach($classify_list->result() as $row) {
                            echo '<li><input type="checkbox" value="'.$row->name.'" name="classify[]">'.$row->name.'</li>';
                        }
                        ?>
                    </ul>
                </td>
                <td>
                    <span class="info">전체선택 / 전체선택해제</span>
                    <ul id="phone-list">
                    </ul>
                </td>
            </tr>
        </table>
    </div>
    <div class="block">
        <table class="data">
            <tr><th>발송대상 수</th><td><span id="sms-count">0</span> 개</td></tr>
            <tr><th>문자내용</th><td><textarea id="sms-content"></textarea></td></tr>
            <tr><th>설정</th><td><input type="checkbox" value="1" id="sms-agree" checked>문자수신동의 대상자만 보내기</td></tr>
        </table>
        <button class="button" id="sms-send">전화번호를 선택하세요</button>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('input[name=form], input[name="classify[]"], #sms-agree').change(function() {
            var data = {};
            data.form_id = $("input[name=form]:checked").val();
            data.classify = [];
            data.agree = $("#sms-agree").is(":checked")?1:0;

            $('input[name="classify[]"]').each(function () {
                if($(this).is(":checked")) data.classify.push($(this).val());
            });
            if(!data.form_id || data.classify.length == 0) return;

            $("#phone-list").html("data loading...");
            $.get("/sms/getPhoneNumbers",data,function(data) {
                console.log(data);
                var html = '';
                $.each(data.data,function(index,value) {
                    html += '<li><input type="checkbox" value="' + value + '" name="phone[]">' + value + '</li>';
                });
                $("#phone-list").html(html);
                $("#sms-count").html(0);
                $("#sms-send").html("전화번호를 선택하세요");
                $('input[name="phone[]"]').change(function() {
                    var count = 0;
                    $('input[name="phone[]"]').each(function () {
                        if($(this).is(":checked")) count ++;
                    });
                    console.log(count);
                    $("#sms-count").html(count);
                    var smsSendText = "전화번호를 선택하세요";
                    if(count == 0) $("#sms-send").html(smsSendText);
                    else $("#sms-send").html("sms 발송하기");
                });
            },"json");
        });

        $("#add-phone").click(function() {
            $("#phone-list").append('<li><input type="checkbox" value="' + $("#add-phone-number").val() + '" name="phone[]">' + $("#add-phone-number").val() + '</li>');
            $('input[name="phone[]"]').change(function() {
                var count = 0;
                $('input[name="phone[]"]').each(function () {
                    if($(this).is(":checked")) count ++;
                });
                console.log(count);
                $("#sms-count").html(count);
                var smsSendText = "전화번호를 선택하세요";
                if(count == 0) $("#sms-send").html(smsSendText);
                else $("#sms-send").html("sms 발송하기");
            });
        });

        $("#sms-send").click(function() {
            if($(this).html() != "sms 발송하기") return;
            $(this).html("sms 발송중입니다. 기다려주세요.");
            var data = {};
            data.phone_list = [];
            data.message = $("#sms-content").val();
            $('input[name="phone[]"]').each(function () {
                if($(this).is(":checked")) data.phone_list.push($(this).val());
            });
            $.post("/sms/sendSms",data,function(data) {
                console.log(data);
                alert("sms 발송이 완료되었습니다.")
                $("#sms-send").html("sms 발송하기");
            });
        });


    });
</script>