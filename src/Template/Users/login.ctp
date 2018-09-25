<?php
$this->assign('title', 'ログイン');
?>
<div class="login_check_container">
  <p id="form_check">入力に誤りがあります。</p>
  <p id="user_name_check_p">ユーザー名を入力してください。</p>
  <p id="password_check_p">パスワードを入力してください</p>
</div>
<div class="login-main">
  <div class="login-form-container">
    <?= $this->Form->create(); ?>
    <?= $this->Form->input('user_name', ['label'=>'ユーザー名', 'class'=>'login_form']); ?>
    <?= $this->Form->input('password', ['label'=>'パスワード', 'class'=>'login_form']); ?>
    <?= $this->Form->button('ログイン'); ?>
    <?= $this->Form->end(); ?>
  </div>
  <div class="login-sidebar">
    <p>ユーザー登録(無料)</p>
    <?= $this->Html->link('ユーザー登録', ['action'=>'register']) ?>
  </div>
  <div class="clear">

  </div>
</div>
<?= $this->Html->script('login_check'); ?>
