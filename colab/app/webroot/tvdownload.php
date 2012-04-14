<?php

$filename = 'http://colab.cdzombak.net/uploads/track_version/filename/' . $_GET['tvfilename'];

header('Content-Disposition: attachment; filename="' . $_GET['tvfilename'] . '"');

// TODO intelligently choose content-type
// header('Content-type: audio/mpeg');

readfile($filename);
