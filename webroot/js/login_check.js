$(function() {

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

})
