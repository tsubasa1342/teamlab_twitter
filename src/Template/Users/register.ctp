<?php
$this->assign('title', '新規登録');
?>

<div class="main-container">
  <div class="message-container">
    <h1 class="first-message">ついったーに参加しましょう</h1>
    <div class="confirm-message">
      <div class="fs12">もうついったーに参加していますか？<?= $this->Html->link('ログイン', ['controller'=>'Users', 'action'=>'login']); ?></div>
    </div>
    <div class="clear"></div>
  </div>

  <div class="check_container">
    <p id="form_check">入力に誤りがあります。</p>
    <p id="name_check_p">名前を入力してください。</p>
    <p id="user_name_check_p">ユーザー名を入力してください。</p>
    <p id="password_check_p">パスワードを入力してください</p>
    <p id="password_confirm_check_p">パスワード(確認)を入力してください</p>
    <p id="email_adress_check_p">メールアドレスを入力してください。</p>
  </div>

  <div class="form-container">
    <?= $this->Form->create($user); ?>
    <?= $this->Form->control('name', ['required' => false, 'label'=>'名前', 'id'=>'name', 'class'=>'register_form']); ?>
    <?= $this->Form->control('user_name', ['required' => false, 'label'=>'ユーザー名','id'=>'user_name', 'class'=>'register_form']); ?>
    <?= $this->Form->control('password', ['required' => false, 'label'=>'パスワード','id'=>'password', 'class'=>'register_form']); ?>
    <?= $this->Form->control('password_confirm', ['required' => false, 'label'=>'パスワード(確認)', 'id'=>'password_confirm', 'class'=>'register_form', 'type'=>'password']); ?>
    <?= $this->Form->control('email_adress', ['required' => false, 'label'=>'メールアドレス','id'=>'email_adress', 'class'=>'register_form']); ?>
    <div class="checkbox-container">
      <?= $this->Form->checkbox('notpublish', ['value'=>'notpublish']); ?>
      <div class="checkbox-message">
        つぶやきを非公開にする
      </div>
    </div>
    <?= $this->Form->button('アカウントを作成する'); ?>
    <?= $this->Form->end(); ?>
  </div>
</div>

<footer>
  <p class="footer-message fs12">上の「アカウントを作成する」と書かれたボタンをクリックする事によって<a href="">利用規約</a>を承諾したとみなします。</p>
</footer>
<?= $this->Html->script('register_check'); ?>
