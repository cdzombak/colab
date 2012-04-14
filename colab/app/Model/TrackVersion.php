<?php
App::uses('AppModel', 'Model');
/**
 * TrackVersion Model
 *
 * @property Track $Track
 * @property TimebasedComment $TimebasedComment
 * @property VersionTag $VersionTag
 */
class TrackVersion extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'message';
	
	var $actsAs = array(
		'MeioUpload.MeioUpload' => array(
			'filename' => array(
				'maxSize'=> 7340032,
				'allowedMime' => array('audio/mpeg', 'audio/x-mpeg', 'audio/mp3', 'audio/x-mp3', 'audio/mpeg3', 'audio/x-mpeg3', 'audio/mpg', 'audio/x-mpg', 'audio/x-mpegaudio', 'audio/wav', 'audio/x-wav', 'audio/wave', 'audio/x-pn-wav', 'application/ogg', 'video/ogg', 'audio/ogg', 'audio/vorbis'),
				'allowedExt' => array('.mp3', '.wav', '.ogg'),
				'thumbnails' => false
			)
		)
	);
	
	public function afterSave($created) {
		if ($created) {
			
		}
	}
	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'track_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'author' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Track' => array(
			'className' => 'Track',
			'foreignKey' => 'track_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Author' => array(
			'className' => 'User',
			'foreignKey' => 'author'
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'TimebasedComment' => array(
			'className' => 'TimebasedComment',
			'foreignKey' => 'track_version_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'VersionTag' => array(
			'className' => 'VersionTag',
			'foreignKey' => 'track_version_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
