<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=880">
<title>신청폼 관리</title>
<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
</head>


<body style="margin:0;padding:0;border:0;text-align:center;">
<div class="centerdiv">
<?php echo validation_errors(); ?>
<?php echo form_open('login'); ?>

    아이디: <input type="text" name="account_id"><br>
    비밀번호: <input type="password" name="account_pw"><br>
    <input type="submit" value="Login"/>
    </form>

</div>




</body>
</html>