$(function() {


  $("form").submit(function(){
    if($("input[name=name]").val() == ''){
      alert("名前を入力してください。");
      return false;
    }
    return true;
  });



  $("form").submit(function(){
    if($("input[name='user_name']").val() == ''){
      alert("ユーザー名を入力してください。");
      return false;
    }
    return true;
  });

  $("form").submit(function(){
    if($("input[name='password']").val() == ''){
      alert("パスワードを入力してください。");
      return false;
    }
    return true;
  });


  $("form").submit(function(){
    if($("input[name='password_confirm']").val() == ''){
      alert("パスワード(確認)を入力してください。");
      return false;
    }
    return true;
  });

  $("form").submit(function(){
    if($("input[name='email_adress']").val() == ''){
      alert("メールアドレスを入力してください。");
      return false;
    }
    return true;
  });

})
