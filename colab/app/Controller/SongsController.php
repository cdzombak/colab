<?php
App::uses('AppController', 'Controller');
/**
 * Songs Controller
 *
 * @property Song $Song
 */
class SongsController extends AppController {
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Song->recursive = 0;
		$this->set('songs', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Song->id = $id;
		$this->loadModel('TrackVersions');
		if (!$this->Song->exists()) {
			throw new NotFoundException(__('Invalid song'));
		}
		$this->set('song', $this->Song->read(null, $id));
		$this->set('trackVersions', $this->TrackVersions->find('all'));
	    
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Song->create();
			
			$data = array();
			$data['name'] = $this->request->data['Song']['name'];
			$data['owner'] = $this->Auth->user('id');

			if ($this->Song->save($data)) {
				$this->Session->setFlash(__('The song has been saved'));
				$this->redirect(array('action' => 'view', $this->Song->field('id')));
			} else {
				$this->Session->setFlash(__('The song could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Song->id = $id;
		if (!$this->Song->exists()) {
			throw new NotFoundException(__('Invalid song'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$data = array();
			$data['name'] = $this->request->data['Song']['name'];
			
			if ($this->Song->save($data)) {
				$this->Session->setFlash(__('The song has been saved'));
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The song could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Song->read(null, $id);
		}
	}
	
	public function addCollaborator($id = null) {
		$this->Song->id = $id;
		$this->loadModel('User');
		
		if (!$this->Song->exists()) {
			throw new NotFoundException(__('Invalid song'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Song->save($this->data)) {
				$this->Session->setFlash(__('Collaborators: SAVED!'));
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The song could not be saved. Please, try again.'));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Song->read(null, $id);
		}

		$this->set('song', $this->Song->read(null, $id));
		$this->set('users', $this->User->find('list', array('recursive'=>0, 'fields'=>array('id','name'))));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	// public function delete($id = null) {
	// 	if (!$this->request->is('post')) {
	// 		throw new MethodNotAllowedException();
	// 	}
	// 	$this->Song->id = $id;
	// 	if (!$this->Song->exists()) {
	// 		throw new NotFoundException(__('Invalid song'));
	// 	}
	// 	if ($this->Song->delete()) {
	// 		$this->Session->setFlash(__('Song deleted'));
	// 		$this->redirect(array('action' => 'index'));
	// 	}
	// 	$this->Session->setFlash(__('Song was not deleted'));
	// 	$this->redirect(array('action' => 'index'));
	// }

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Song->recursive = 0;
		$this->set('songs', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Song->id = $id;
		if (!$this->Song->exists()) {
			throw new NotFoundException(__('Invalid song'));
		}
		$this->set('song', $this->Song->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Song->create();
			if ($this->Song->save($this->request->data)) {
				$this->Session->setFlash(__('The song has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The song could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Song->id = $id;
		if (!$this->Song->exists()) {
			throw new NotFoundException(__('Invalid song'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Song->save($this->request->data)) {
				$this->Session->setFlash(__('The song has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The song could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Song->read(null, $id);
		}
	}

/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Song->id = $id;
		if (!$this->Song->exists()) {
			throw new NotFoundException(__('Invalid song'));
		}
		if ($this->Song->delete()) {
			$this->Session->setFlash(__('Song deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Song was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
