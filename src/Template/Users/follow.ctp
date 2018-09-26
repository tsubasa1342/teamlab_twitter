<?php
$this->assign('title', 'フォロー者一覧');
?>
<div class="main-container">
  <?php if ($isWhich == 'follow'): ?>
    <h2><?= $auth_name, 'は', $follows_count; ?>人をフォローしています</h2>
    <p class="follow-p">ユーザー名 / 名前</p>
    <div class="search-container follow-container">
      <ul class="follow-contents">
        <?php foreach ($follows as $follow): ?>
          <li class="follow-list">
            <div class="result-user-name">
              <?= $this->Html->link($follow['follow_user_name'], ['controller' => 'Tweets', 'action' => 'index', $follow['follow_id']] ); ?>
            </div>
            <div class="result-name">
              <?= $follow['follow_name']; ?>
            </div>
            <div class="follow-icon">
              <?=
                $this->Form->postLink(
                  '<i class="fas fa-cog"></i><i class="fas fa-caret-down"></i>',
                  ['controller' => 'Follows', 'action' => 'delete', $follow->id],
                  ['confirm' => 'Sure you want to delete this tweet? There is NO undo!', 'escape' => false, 'class' => 'fs12']);
              ?>
            </div>
            <div class="clear">

            </div>
            <div class="result-body">
              <?php
                foreach ($tweets as $tweet) {
                  if ($tweet['user_id'] == $follow['follow_id']) {
                    $tweet = $tweet;
                    break;
                  } else {
                    $tweet = null;
                  }
                }
              ?>
              <?php if ($tweet != null): ?>
                <div class="result-tweet-body">
                  <?= nl2br($this->Text->autoLinkUrls(h($tweet->body))); ?>
                </div>
                <div class="result-tweet-created">
                  <?= h($tweet->created->year), '年', h($tweet->created->month), '月', h($tweet->created->day), '日', h($tweet->created->hour), '時', h($tweet->created->minute), '分', h($tweet->created->second), '秒'; ?>
                </div>
              <?php endif ?>
            </div>
          </li>
        <?php endforeach ?>
      </ul>

      <div class="auth-data-follow fs12">
        <p class="follow-data"><?= h($auth['user_name']); ?></p>
        <ul>
          <li>
            <div class="follow-data">
              <?= h($follows_count); ?>
            </div>
            <div>
              <?= $this->Html->link('フォロー<br>している', ['controller' => 'users', 'action' => 'follow', 'follow' ], ['escape' => false]) ?>
            </div>
          </li>
          <li>
            <div class="follow-data">
             <?= h($followers_count); ?>
            </div>
            <div>
              <?= $this->Html->link('フォロー<br>されている', ['controller' => 'users', 'action' => 'follow', 'follower' ], ['escape' => false]) ?>
            </div>
          </li>
        </ul>
        <div class="tweet-count">
          <ul>
            <li>
              つぶやき
            </li>
            <li>
              <?= h($tweets_count); ?>
            </li>
          </ul>
          <?= $this->Html->link('', ['controller' => 'Tweets', 'action' => 'index', $auth_id], ['class' => 'tweet-link']); ?>
        </div>
      </div>
    </div>
    <div class="paginator">
      <ul class="pagination">
        <?php if ($this->Paginator->hasPrev()): ?>
          <?= $this->Paginator->prev('<<前へ'); ?>
        <?php endif ?>
        <?php if ($this->Paginator->hasNext()): ?>
          <?= $this->Paginator->next('次へ>>'); ?>
        <?php endif ?>
      </ul>
    </div>


  <?php elseif ($isWhich == 'follower'): ?>
    <h2><?= $auth_name, 'は', $followers_count; ?>人にフォローされています</h2>
    <p class="follow-p">ユーザー名 / 名前</p>
    <div class="search-container follow-container">
      <ul class="follow-contents">
        <?php foreach ($followers as $follower): ?>
          <li class="follow-list">
            <div class="result-user-name">
              <?= $this->Html->link($follower['user_name'], ['controller' => 'Tweets', 'action' => 'index', $follower['user_id']] ); ?>
            </div>
            <div class="result-name">
              <?= $follower['name']; ?>
            </div><?php $count = 0; ?>
            <?php foreach ($auth_follows as $auth_follow) {
                    if ($auth_follow['follow_id'] == $follower['user_id']) {
                      $count += 1;
                    }
                  }
            ?>
            <?php if ($count == 0): ?>
              <div class="follower-icon fs12">
                <?= $this->Form->create(null, ['url' => ['controller'=>'Follows', 'action'=>'follow'], ['confirm' => 'Sure you want to delete this tweet? There is NO undo!', 'escape' => false, 'class' => 'fs12']]); ?>
                <?= $this->Form->hidden('user_id', ['value'=>$auth['id']]); ?>
                <?= $this->Form->hidden('name', ['value'=>$auth['name']]); ?>
                <?= $this->Form->hidden('user_name', ['value'=>$auth['user_name']]); ?>
                <?= $this->Form->hidden('follow_id', ['value'=>$follower['user_id']]); ?>
                <?= $this->Form->hidden('follow_name', ['value'=>$follower['name']]); ?>
                <?= $this->Form->hidden('follow_user_name', ['value'=>$follower['user_name']]); ?>
                <?= $this->Form->button('<i class="fas fa-cog"></i><i class="fas fa-caret-down"></i>'); ?>
                <?= $this->Form->end(); ?>
              </div>
            <?php endif ?>
            <div class="clear">

            </div>
            <div class="result-body">
              <?php
                foreach ($tweets as $tweet) {
                  if ($tweet['user_id'] == $follower['user_id']) {
                    $tweet = $tweet;
                    break;
                  } else {
                    $tweet = null;
                  }
                }
              ?>
              <?php if ($tweet != null): ?>
                <div class="result-tweet-body">
                  <?= nl2br($this->Text->autoLinkUrls(h($tweet->body))); ?>
                </div>
                <div class="result-tweet-created">
                  <?= h($tweet->created->year), '年', h($tweet->created->month), '月', h($tweet->created->day), '日', h($tweet->created->hour), '時', h($tweet->created->minute), '分', h($tweet->created->second), '秒'; ?>
                </div>
              <?php endif ?>
            </div>
          </li>
        <?php endforeach ?>
      </ul>

      <div class="auth-data-follow fs12">
        <p class="follow-data"><?= h($auth['user_name']); ?></p>
        <ul>
          <li>
            <div class="follow-data">
              <?= h($follows_count); ?>
            </div>
            <div>
              <?= $this->Html->link('フォロー<br>している', ['controller' => 'users', 'action' => 'follow', 'follow' ], ['escape' => false]) ?>
            </div>
          </li>
          <li>
            <div class="follow-data">
             <?= h($followers_count); ?>
            </div>
            <div>
              <?= $this->Html->link('フォロー<br>されている', ['controller' => 'users', 'action' => 'follow', 'follower' ], ['escape' => false]) ?>
            </div>
          </li>
        </ul>
        <div class="tweet-count">
          <ul>
            <li>
              つぶやき
            </li>
            <li>
              <?= h($tweets_count); ?>
            </li>
          </ul>
          <?= $this->Html->link('', ['controller' => 'Tweets', 'action' => 'index', $auth_id], ['class' => 'tweet-link']); ?>
        </div>
      </div>
    </div>
    <div class="paginator">
      <ul class="pagination">
        <?php if ($this->Paginator->hasPrev()): ?>
          <?= $this->Paginator->prev('<<前へ'); ?>
        <?php endif ?>
        <?php if ($this->Paginator->hasNext()): ?>
          <?= $this->Paginator->next('次へ>>'); ?>
        <?php endif ?>
      </ul>
    </div>
  <?php endif ?>
</div>
