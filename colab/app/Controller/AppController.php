<?php
class AppController extends Controller {

	public $components = array('Facebook.Connect' => array('model' => 'User'), 'Session', 'Auth');
	public $helpers = array('Form', 'Html', 'Js', 'Time', 'Session', 'Facebook.Facebook');

	public function afterFacebookLogin() {
		// i just want this to fucking get called for fucks sake. the rest of it doesn't even have to work.
		file_put_contents("/home/chrisdz/web/colab.cdzombak.net/app/tmp/callback", "");
		
		$id = $this->Connect->user('id');
		$name = $this->Connect->user('name');
		
		// check whether model exists
		$user = $this->User->find('first', array(
			'conditions' => array('User.facebook_id' => $id)
		));
		
		file_put_contents("/home/chrisdz/web/colab.cdzombak.net/app/tmp/user", $user);
		
		// if not, create the model & save it
		
		
		// TODO handle updating name if it has changed
	}
	
	public function isAuthorized($user) {
		if (isset($user['id'])) {
			return true;
		}
		return false;
	}

}
