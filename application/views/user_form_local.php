<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>
<body>

    <input type="hidden" name="form_id" value="9">
    이름 : <input type="text" name="user_name"><br>
    전화번호 : <input type="text" name="phone"><br>
    <input type="submit" value="등록" id="submit">

<script>
    $(document).ready(function () {

        $("#submit").click(function() { //submit-button 클릭 시 호출, 실제로는 현재 active되어 있는 폼에 대한 데이터만 받아오는 분기 필요
//현재 active되어 있는 폼이 1:1이메일문의 일 경우
            var data = {
                "form_id":9, //1:1이메일문의의 form_id 입력, 필수 입력값, 해당 폼의 form_id 입력, 이거 빠지면 데이터 다 꼬이고 난리남
                "user_name":'지역센터문의자',
                "phone":'010-9820-6402',
                "local_phone_list":'010-9820-6402,010-3675-6402'
            };
            $.ajax({
                type:"POST",
                url:"/user_form/regist",
                data:data,
                success:function(res) {
//성공처리
                    alert("success");
                    resetfield();
                },
                error:function(error) {
//에러처리
                    alert("error");
                }
            });
        });
    });
</script>
</body>
</html>