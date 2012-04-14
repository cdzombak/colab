<?php
App::uses('AppController', 'Controller');
/**
 * TrackVersions Controller
 *
 * @property TrackVersion $TrackVersion
 */
class TrackVersionsController extends AppController {
	public $components = array('Waveform');

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

	public function diff() {
		$idA = null;
		$idB = null;
		
		if(isset($this->params['url']['a'])) 
			$idA = $this->params['url']['a'];
		if(isset($this->params['url']['b']))
			$idB = $this->params['url']['b'];
		
		if ($idA === null || $idB === null) {
			throw new BadRequestException('You must include two track version IDs to diff');
		}
		
		$this->TrackVersion->id = $idA;
		if (!$this->TrackVersion->exists()) {
			throw new NotFoundException(__('Invalid track version A'));
		}
		$this->set('trackVersionA', $this->TrackVersion->read(null, $idA));
		
		$this->TrackVersion->id = $idB;
		if (!$this->TrackVersion->exists()) {
			throw new NotFoundException(__('Invalid track version B'));
		}
		$this->set('trackVersionB', $this->TrackVersion->read(null, $idB));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($trackId = null) {
		if ($this->request->is('post')) {
			if (!$trackId) {
				throw new NotFoundException(__('Invalid track specified'));
			}
			
			$this->TrackVersion->create();
			
			$this->request->data['TrackVersion']['author'] = $this->Auth->user('id');
			$this->request->data['TrackVersion']['track_id'] = $trackId;
			
			if ($this->TrackVersion->save($this->request->data)) {
				$this->TrackVersion->Track->read(null, $this->TrackVersion->field('track_id'));
				$this->TrackVersion->Track->save(array("current_version" => $this->TrackVersion->id));
				
				$this->Session->setFlash(__('The track version has been saved'));
				$this->redirect(array('controller' => 'tracks', 'action' => 'view', $this->TrackVersion->field('track_id')));
			} else {
				$this->Session->setFlash(__('The track version could not be saved. Please, try again.'));
			}
		}
		$tracks = $this->TrackVersion->Track->find('list');
		$this->set(compact('tracks'));
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
