<header>
  <div class="header-logo">
    <?= $this->Html->image('Twitter_Logo_Blue.png', ['url'=>['controller'=>'Tweets', 'action'=>'index']]); ?>
  </div>
  <ul class="header-list">
    <li><?= $this->Html->link('ホーム', ['controller'=>'Users', 'action'=>'register']); ?></li>
    <?php if (isset($auth)): ?>
      <li><?= $this->Html->link('友達を検索', ['controller'=>'Users', 'action'=>'search']); ?></li>
      <li><?= $this->Html->link('ログアウト', ['controller'=>'Users', 'action'=>'logout']); ?></li>
    <?php else: ?>
      <li><?= $this->Html->link('ユーザー登録', ['controller'=>'Users', 'action'=>'register']); ?></li>
      <li><?= $this->Html->link('ログイン', ['controller'=>'Users', 'action'=>'login']); ?></li>
    <?php endif ?>
  </ul>
</header>
