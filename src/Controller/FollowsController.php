<?php
namespace App\Controller;

use Cake\Event\Event;

class FollowsController extends AppController {

  public function beforeFilter(Event $event) {
    parent::beforeFilter($event);
    $this->Auth->allow(['register', 'top']);
    $this->set('auth', $this->Auth->user());
  }

  public function follow() {
    $follow = $this->Follows->newEntity();
    if ($this->request->is('post')) {
      $follow = $this->Follows->patchEntity($follow, $this->request->getData());
      if ($this->Follows->save($follow)) {
        $this->redirect($this->referer());
      } else {
        // error
      }
    }
    $this->set(compact('follow'));
  }



  public function delete($id = null) {
    $this->request->allowMethod(['post', 'delete']);
    $follow = $this->Follows->get($id);
    if ($this->Follows->delete($follow)) {
      return $this->redirect($this->referer());
    }
  }
}
?>
