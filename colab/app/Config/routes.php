<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	// Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	Router::connect('/', array('controller' => 'songs', 'action' => 'index'));
	
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	
	Router::connect('/songs/add' 
		, array('controller' => 'songs', 'action' => 'add')
	);
	
	Router::connect('/songs/:id/edit' 
		, array('controller' => 'songs', 'action' => 'add')
		, array('pass' => array('id'))
	);
	
	Router::connect('/songs/:id' 
		, array('controller' => 'songs', 'action' => 'view')
		, array('pass' => array('id'))
	);
	
	Router::connect('/songs/:id/addTrack',
		array('controller' => 'tracks', 'action' => 'add'),
		array('pass' => array('id'))
	);
	
	Router::connect('/tracks/:id' 
		, array('controller' => 'tracks', 'action' => 'view')
		, array('pass' => array('id'))
	);
	
	Router::connect('/tracks/:trackId/addVersion',
		array('controller' => 'trackVersions', 'action' => 'add'),
		array('pass' => array('trackId'))
	);
	
	Router::connect('/songs/:songId/tracks/:trackId',
		array('controller' => 'tracks', 'action' => 'view', 'songId' => null),
		array('pass' => array('trackId'))
	);
	
	Router::connect('/songs/:songId/addCollaborator',
		array('controller' => 'songs', 'action' => 'addCollaborator'),
		array('pass' => array('songId'))
	);
	
	Router::connect('/songs/:songId/tracks/:trackId/trackVersions/:tvId',
		array('controller' => 'trackVersions', 'action' => 'view', 'songId' => null,
		  	'trackId' => null),
		array('pass' => array('tvId'))
	);
	
	Router::connect('/login',
		array('controller' => 'users', 'action' => 'login')
	);
	
	Router::connect('/logout',
		array('controller' => 'users', 'action' => 'logout')
	);

	Router::connect('/users/add',
		array('controller' => 'users', 'action' => 'add')
	);
	
	Router::connect('/trackVersions/diff',
		array('controller' => 'trackVersions', 'action' => 'diff')
	);
	
	Router::connect('/users/:id',
		array('controller' => 'users', 'action' => 'view'),
		array('pass' => array('id'))
	);

/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
