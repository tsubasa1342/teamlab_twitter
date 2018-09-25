<?php
namespace App\Controller;

use Cake\Event\Event;

class TweetsController extends AppController {

  public $paginate = [
    'limit' => 10,
    'order' => [
      'Tweets.created' => 'desc'
    ],
    'contain' => ['Users']
  ];

  public function initialize() {
    parent::initialize();
    $this->loadComponent('Paginator');
  }

  public function beforeFilter(Event $event) {
    parent::beforeFilter($event);
    $this->Auth->allow(['register', 'top']);
    if (!$this->Auth->user()) {
        $this->Auth->config('authError', false);
    }

    $this->set('auth', $this->Auth->user());
  }

  public function index($id = null) {
    //アクセス元のURLを取得
    $url = $this->referer();
    $keys = parse_url($url);
    $path = $keys['path'];
    $this->set(compact('url'));
    $this->set(compact('path'));

    //ログインユーザーのid取得
    $auth_id = $this->Auth->user('id');
    $this->set(compact('auth_id'));

    //ログインユーザーのユーザー名取得
    $auth_name = $this->Auth->user('user_name');
    $this->set(compact('auth_name'));

    //ログインユーザーのフォロー数取得
    $auth_follows = $this->Tweets->Users->Follows->find('all', [
      'conditions' => ['Follows.user_id' => $auth_id]
    ]);
    $follows_count = $auth_follows->count();
    $this->set(compact('follows_count'));

    //ログインユーザーのフォロワー数取得
    $auth_followers = $this->Tweets->Users->Follows->find('all', [
      'conditions' => ['Follows.follow_id' => $auth_id]
    ]);
    $followers_count = $auth_followers->count();
    $this->set(compact('followers_count'));

    //ログインユーザーの投稿数取得
    $auth_tweets = $this->Tweets->find('all', [
      'conditions' => ['Tweets.user_id' => $auth_id]
    ]);
    $tweets_count = $auth_tweets->count();
    $this->set(compact('tweets_count'));

    //つぶやき投稿処理
    $tweet = $this->Tweets->newEntity();
    if ($this->request->is('post')) {
      $tweet = $this->Tweets->patchEntity($tweet, $this->request->getData());
      if ($this->Tweets->save($tweet)) {
        return $this->redirect(['controller'=>'Tweets', 'action'=>'index']);
      } else {
        $error = '１４０文字で入力してください。';
        $this->set(compact('error'));
      }
    }
    $this->set(compact('tweet'));

    //表示するつぶやきの選択処理
    if ($id) {
      $tweets = $this->Tweets->find('all', [
        'conditions' => ['Tweets.user_id' => $id],
        'contain' => 'Users'
      ]);
      $this->set('tweets', $this->paginate($tweets));
      $this->set(compact('id'));
    } else {
      $tweets = $this->Tweets->find('all', ['contain'=>'Users']);
      $this->set('tweets', $this->paginate($tweets));
      $this->set(compact('id'));
    }
  }

  public function delete($id = null) {
    $this->request->allowMethod(['post', 'delete']);
    $tweet = $this->Tweets->get($id);
    if ($this->Tweets->delete($tweet)) {
      return $this->redirect($this->referer());
    }
  }
}
?>
