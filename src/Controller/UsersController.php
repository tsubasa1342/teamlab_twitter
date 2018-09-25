<?php
namespace App\Controller;

use Cake\Event\Event;

class UsersController extends AppController {

  public $paginate = [
    'limit' => 10,
    'order' => [
      'Tweets.created' => 'desc']
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


  public function register() {
    $user = $this->Users->newEntity();
    if ($this->request->is('post')) {
      $user = $this->Users->patchEntity($user, $this->request->getData());
      if ($this->Users->save($user)) {
        $this->set(compact('user'));
        $this->render('top');
      } else {
        ///
      }
    }
    if (is_null($this->Auth->user())) {
      ///
    } else {
      return $this->redirect(['controller' => 'Tweets', 'action' => 'index']);
    }
    $this->set(compact('user'));
  }

  public function top() {
    //ログイン状態でアクセスされたらリダイレクトする
    if (is_null($this->Auth->user())) {
      ///
    } else {
      return $this->redirect(['controller' => 'Tweets', 'action' => 'index']);
    }

    //users/register以外からのアクセスはリダイレクトする
    $url = $this->referer();
    $keys = parse_url($url);
    $path = $keys['path'];
    if ($path != 'users/register') {
      return $this->redirect(['controller' => 'Tweets', 'action' => 'index']);
    }
  }



  public function search() {
    if ($this->request->query('input')) {
      $query = $this->Users->find();
      $query->where(['name like'=>'%'.$this->request->query('input').'%'])
            ->orwhere(['user_name like'=>'%'.$this->request->query('input').'%'])
            ->order(['created'=>'DESC'])
            ->contain(['Tweets' => function (\Cake\ORM\Query $query) {
                      return $query->orderDesc('Tweets.created');
            }]);
      $id = $this->Auth->user('id');
      $auth_follows = $this->Users->Follows->find('all', ['conditions' => ['Follows.user_id' => $id]]);
      $this->set(compact('auth_follows'));
      $users = $this->paginate($query);
      $this->set(compact('users'));
    }
  }

  public function follow($isWhich = null) {
    $users = $this->Users->find('all');
    $this->set(compact('users'));

    //ログインユーザーのid取得
    $auth_id = $this->Auth->user('id');
    $this->set(compact('auth_id'));

    //ログインユーザーのユーザー名取得
    $auth_name = $this->Auth->user('user_name');
    $this->set(compact('auth_name'));

    //ログインユーザーのフォロー数取得
    $auth_follows = $this->Users->Follows->find('all', [
      'conditions' => ['Follows.user_id' => $auth_id]
    ]);
    $this->set(compact('auth_follows'));
    $follows_count = $auth_follows->count();
    $this->set(compact('follows_count'));

    //ログインユーザーのフォロワー数取得
    $auth_followers = $this->Users->Follows->find('all', [
      'conditions' => ['Follows.follow_id' => $auth_id]
    ]);
    $followers_count = $auth_followers->count();
    $this->set(compact('followers_count'));

    //ログインユーザーの投稿数取得
    $auth_tweets = $this->Users->Tweets->find('all', [
      'conditions' => ['Tweets.user_id' => $auth_id]
    ]);
    $tweets_count = $auth_tweets->count();
    $this->set(compact('tweets_count'));

    //表示するユーザーの選択処理
    if ($isWhich == 'follow') {
      //フォロー者一覧
      $follows = $this->paginate($this->Users->Follows->find('all', [
        'conditions' => ['Follows.user_id' => $auth_id],
        'order' => ['Follows.created' => 'DESC']
      ]));
      $this->set(compact('follows'));

      $tweets = $this->Users->Tweets->find('all', [
        'order' => ['Tweets.created' => 'DESC']
      ]);
      $this->set(compact('tweets'));
      $this->set(compact('isWhich'));
    } elseif ($isWhich == 'follower') {
      //フォロワー一覧
      $followers = $this->paginate($this->Users->Follows->find('all', [
        'conditions' => ['Follows.follow_id' => $auth_id],
        'order' => ['Follows.created' => 'DESC']
      ]));
      $this->set(compact('followers'));

      $tweets = $this->Users->Tweets->find('all', [
        'order' => ['Tweets.created' => 'DESC']
      ]);
      $this->set(compact('tweets'));

      $this->set(compact('isWhich'));
    }
  }

  public function delete($id = null) {
    $this->request->allowMethod(['post', 'delete']);
    $tweet = $this->Tweets->get($id);
    if ($this->Tweets->delete($tweet)) {
      return $this->redirect($this->referer());
    }
  }


  public function login(){
    if ($this->request->is('post')) {
      $user = $this->Auth->identify();
      if ($user) {
        $this->Auth->setUser($user);
        return $this->redirect($this->Auth->redirectUrl());
      }

      $this->Flash->error('ユーザ名、パスワードの組み合わせが違うようです。');
    }
    if (is_null($this->Auth->user())) {
      ///
    } else {
      return $this->redirect(['controller' => 'Tweets', 'action' => 'index']);
    }
  }

  public function logout() {
    return $this->redirect($this->Auth->logout());
  }
}
?>
