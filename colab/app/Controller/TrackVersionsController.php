<?php
App::uses('AppController', 'Controller');
/**
 * TrackVersions Controller
 *
 * @property TrackVersion $TrackVersion
 */
class TrackVersionsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->TrackVersion->recursive = 0;
		$this->set('trackVersions', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->TrackVersion->id = $id;
		if (!$this->TrackVersion->exists()) {
			throw new NotFoundException(__('Invalid track version'));
		}
		$this->set('trackVersion', $this->TrackVersion->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TrackVersion->create();
			if ($this->TrackVersion->save($this->request->data)) {
				$this->Session->setFlash(__('The track version has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The track version could not be saved. Please, try again.'));
			}
		}
		$tracks = $this->TrackVersion->Track->find('list');
		$this->set(compact('tracks'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->TrackVersion->id = $id;
		if (!$this->TrackVersion->exists()) {
			throw new NotFoundException(__('Invalid track version'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TrackVersion->save($this->request->data)) {
				$this->Session->setFlash(__('The track version has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The track version could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->TrackVersion->read(null, $id);
		}
		$tracks = $this->TrackVersion->Track->find('list');
		$this->set(compact('tracks'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->TrackVersion->id = $id;
		if (!$this->TrackVersion->exists()) {
			throw new NotFoundException(__('Invalid track version'));
		}
		if ($this->TrackVersion->delete()) {
			$this->Session->setFlash(__('Track version deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Track version was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->TrackVersion->recursive = 0;
		$this->set('trackVersions', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->TrackVersion->id = $id;
		if (!$this->TrackVersion->exists()) {
			throw new NotFoundException(__('Invalid track version'));
		}
		$this->set('trackVersion', $this->TrackVersion->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->TrackVersion->create();
			if ($this->TrackVersion->save($this->request->data)) {
				$this->Session->setFlash(__('The track version has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The track version could not be saved. Please, try again.'));
			}
		}
		$tracks = $this->TrackVersion->Track->find('list');
		$this->set(compact('tracks'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->TrackVersion->id = $id;
		if (!$this->TrackVersion->exists()) {
			throw new NotFoundException(__('Invalid track version'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TrackVersion->save($this->request->data)) {
				$this->Session->setFlash(__('The track version has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The track version could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->TrackVersion->read(null, $id);
		}
		$tracks = $this->TrackVersion->Track->find('list');
		$this->set(compact('tracks'));
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
		$this->TrackVersion->id = $id;
		if (!$this->TrackVersion->exists()) {
			throw new NotFoundException(__('Invalid track version'));
		}
		if ($this->TrackVersion->delete()) {
			$this->Session->setFlash(__('Track version deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Track version was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
