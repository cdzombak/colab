<div class="trackVersions diff">
		<!-- WebGL stuff -->
		<script src="/visualizer-gl/o3djs/base.js"></script>
		<script src="/visualizer-gl/cameracontroller.js"></script>

		<!-- TODO(kbr): remove this dependency -->
		<script src="/visualizer-gl/moz/matrix4x4.js"></script>

		<!-- Visualizer GL library -->
		<script type="text/javascript" src="/visualizer-gl/visualizer.js"></script>

		<script type="text/javascript">

		// Set up environment
		o3djs.require('o3djs.shader');

		if (!window.requestAnimationFrame) {
			window.requestAnimationFrame = ( function() {
				return window.webkitRequestAnimationFrame ||
					window.mozRequestAnimationFrame || // comment out if FF4 is slow (it caps framerate at ~30fps: https://bugzilla.mozilla.org/show_bug.cgi?id=630127)
					window.oRequestAnimationFrame ||
					window.msRequestAnimationFrame ||
					function( /* function FrameRequestCallback */ callback, /* DOMElement Element */ element ) {
						window.setTimeout( callback, 1000 / 60 );
					};
			} )();
		}

		// init() once the page has finished loading.
		window.onload = init;

		// Globals
		var context;
		var sourceA = 0;
		var sourceB = 0;
		var sourceAReady = false;
		var sourceBReady = false;
		var analyserA;
		var analyserB;
		var analyserView1;

		function loadSampleA(url) {
			var request = new XMLHttpRequest();
			request.open("GET", url, true);
			request.responseType = "arraybuffer";

			request.onload = function() { 
				sourceA.buffer = context.createBuffer(request.response, false);
				sourceA.loop = false;

				sourceAReady = true;
				if (sourceAReady === true && sourceBReady === true) {
					play();
				}
			}

			request.send();
		}

		function loadSampleB(url) {
			var request = new XMLHttpRequest();
			request.open("GET", url, true);
			request.responseType = "arraybuffer";

			request.onload = function() { 
				sourceB.buffer = context.createBuffer(request.response, false);
				sourceB.loop = false;

				sourceBReady = true;
				if (sourceAReady === true && sourceBReady === true) {
					play();
				}
			}

			request.send();
		}

		function play() {
			var currentTime = context.currentTime;
			var target = currentTime + 0.2;

			sourceA.noteOn(target);
			sourceB.noteOn(target);

			draw();
		}

		function draw() {
			analyserView1.doFrequencyAnalysis();
			window.requestAnimationFrame(draw);
		}

		function initAudio() {
			context = new webkitAudioContext();
			sourceA = context.createBufferSource();
			sourceB = context.createBufferSource();

			analyserA = context.createAnalyser();
			analyserA.fftSize = 2048;
			analyserB = context.createAnalyser();
			analyserB.fftSize = 2048;

			sourceA.connect(analyserA);
			analyserA.connect(context.destination);
			sourceB.connect(analyserB);
			analyserB.connect(context.destination);

			loadSampleA("<?php echo '/' . $trackVersionA['TrackVersion']['dir'] . '/' . $trackVersionA['TrackVersion']['filename']; ?>");
			loadSampleB("<?php echo '/' . $trackVersionB['TrackVersion']['dir'] . '/' . $trackVersionB['TrackVersion']['filename']; ?>");
		}

		function init() {
			analyserView1 = new AnalyserView("view1");
			initAudio();
			analyserView1.initByteBuffer();
		}

		</script>
		
		<h2>Diff <?php echo $this->Html->link(__($trackVersionA['Track']['name']), array('controller' => 'tracks', 'action' => 'view', $trackVersionA['Track']['id'])); ?></h2>
		
		<p>Viewing version <strong><?php echo $trackVersionA['TrackVersion']['id']; ?></strong> (&quot;<?php echo $trackVersionA['TrackVersion']['message']; ?>&quot;)
			by <?php echo $this->Html->link(__($trackVersionA['Author']['name']), array('controller' => 'users', 'action' => 'view', $trackVersionA['Author']['id'])); ?>
			vs version <strong><?php echo $trackVersionB['TrackVersion']['id']; ?></strong> (&quot;<?php echo $trackVersionB['TrackVersion']['message']; ?>&quot;)
			by <?php echo $this->Html->link(__($trackVersionB['Author']['name']), array('controller' => 'users', 'action' => 'view', $trackVersionB['Author']['id'])); ?>.</p>
		
		<!-- Real-time visualizer view -->
		<canvas id="view1" width="920px" height="500px"></canvas>
</div>