//--------------------------------------------------------------------
// WebGL Sonogram Analyser
// heavily adopted/hacked from http://chromium.googlecode.com/svn/trunk/samples/audio/javascript-processing.html
// thx, Google

// The "model" matrix is the "world" matrix in Standard Annotations and Semantics
var model = 0;
var view = 0;
var projection = 0;

function createGLErrorWrapper(context, fname) {
    return function() {
        var rv = context[fname].apply(context, arguments);
        var err = context.getError();
        if (err != 0)
            throw "GL error " + err + " in " + fname;
        return rv;
    };
}

function create3DDebugContext(context) {
    // Thanks to Ilmari Heikkinen for the idea on how to implement this so elegantly.
    var wrap = {};
    for (var i in context) {
        try {
            if (typeof context[i] == 'function') {
                wrap[i] = createGLErrorWrapper(context, i);
            } else {
                wrap[i] = context[i];
            }
        } catch (e) {
            // console.log("create3DDebugContext: Error accessing " + i);
        }
    }
    wrap.getError = function() {
        return context.getError();
    };
    return wrap;
}

/**
 * Class AnalyserView
 */

AnalyserView = function(canvasElementID) {
    this.canvasElementID = canvasElementID;
    
    this.freqByteDataA = 0;
    this.freqByteDataB = 0;
    this.texture = 0;
    this.TEXTURE_HEIGHT = 256;
    this.yoffset = 0;

    this.sonogramShader = 0;

    // Background color
    this.backgroundColor = [191.0 / 255.0,
                           169.0 / 255.0,
                           135.0 / 255.0,
                           1.0];

    // Foreground color
    // TODO (cdz) this will change on a per-point basis and might become the shader's responsiblity somehow
    this.foregroundColor = [63.0 / 255.0,
                           39.0 / 255.0,
                           0.0 / 255.0,
                           1.0];

    this.initGL();
}

AnalyserView.prototype.initGL = function() {
    model = new Matrix4x4();
    view = new Matrix4x4();
    projection = new Matrix4x4();

    var backgroundColor = this.backgroundColor;

    var canvas = document.getElementById(this.canvasElementID);
    this.canvas = canvas;

    // var gl = create3DDebugContext(canvas.getContext("experimental-webgl"));
    var gl = canvas.getContext("experimental-webgl");
    this.gl = gl;
    
    // If we're missing this shader feature, then we can't do the 3D visualization.
    // and we don't care (CDZ)
    // this.has3DVisualizer = (gl.getParameter(gl.MAX_VERTEX_TEXTURE_IMAGE_UNITS) > 0);
    // if (!this.has3DVisualizer && this.analysisType == ANALYSISTYPE_3D_SONOGRAM)
    //         this.analysisType = ANALYSISTYPE_FREQUENCY;
    
    var cameraController = new CameraController(canvas);
    this.cameraController = cameraController;
    
    cameraController.xRot = -45; //-55;
    cameraController.yRot = 0;
    gl.clearColor(backgroundColor[0], backgroundColor[1], backgroundColor[2], backgroundColor[3]);
    gl.enable(gl.DEPTH_TEST);

    // Initialization for the 2D visualizations
    var vertices = new Float32Array([
        1.0,  1.0, 0.0,
        -1.0,  1.0, 0.0,
        -1.0, -1.0, 0.0,
        1.0,  1.0, 0.0,
        -1.0, -1.0, 0.0,
        1.0, -1.0, 0.0]);
    var texCoords = new Float32Array([
        1.0, 1.0,
        0.0, 1.0,
        0.0, 0.0,
        1.0, 1.0,
        0.0, 0.0,
        1.0, 0.0]);

    var vboTexCoordOffset = vertices.byteLength;
    this.vboTexCoordOffset = vboTexCoordOffset;

    // Create the vertices and texture coordinates
    var vbo = gl.createBuffer();
    this.vbo = vbo;
    
    gl.bindBuffer(gl.ARRAY_BUFFER, vbo);
    gl.bufferData(gl.ARRAY_BUFFER,
        vboTexCoordOffset + texCoords.byteLength,
        gl.STATIC_DRAW);
        gl.bufferSubData(gl.ARRAY_BUFFER, 0, vertices);
        gl.bufferSubData(gl.ARRAY_BUFFER, vboTexCoordOffset, texCoords);

// TODO cdz I don't know if we need this...
    // Initialization for the 3D visualizations
    // var numVertices = sonogram3DWidth * sonogram3DHeight;
    //     if (numVertices > 65536) {
    //         throw "Sonogram 3D resolution is too high: can only handle 65536 vertices max";
    //     }
    //     vertices = new Float32Array(numVertices * 3);
    //     texCoords = new Float32Array(numVertices * 2);
    //     
    //     for (var z = 0; z < sonogram3DHeight; z++) {
    //         for (var x = 0; x < sonogram3DWidth; x++) {
    //             // Generate a reasonably fine mesh in the X-Z plane
    //             vertices[3 * (sonogram3DWidth * z + x) + 0] =
    //             sonogram3DGeometrySize * (x - sonogram3DWidth / 2) / sonogram3DWidth;
    //             vertices[3 * (sonogram3DWidth * z + x) + 1] = 0;
    //             vertices[3 * (sonogram3DWidth * z + x) + 2] =
    //             sonogram3DGeometrySize * (z - sonogram3DHeight / 2) / sonogram3DHeight;
    //     
    //             texCoords[2 * (sonogram3DWidth * z + x) + 0] =
    //             x / (sonogram3DWidth - 1);
    //             texCoords[2 * (sonogram3DWidth * z + x) + 1] =
    //             z / (sonogram3DHeight - 1);
    //         }
    //     }
    
    // var vbo3DTexCoordOffset = vertices.byteLength;
    //     this.vbo3DTexCoordOffset = vbo3DTexCoordOffset;
    // 
    //     // Create the vertices and texture coordinates
    //     var sonogram3DVBO = gl.createBuffer();
    //     this.sonogram3DVBO = sonogram3DVBO;
    //     
    //     gl.bindBuffer(gl.ARRAY_BUFFER, sonogram3DVBO);
    //     gl.bufferData(gl.ARRAY_BUFFER, vbo3DTexCoordOffset + texCoords.byteLength, gl.STATIC_DRAW);
    //     gl.bufferSubData(gl.ARRAY_BUFFER, 0, vertices);
    //     gl.bufferSubData(gl.ARRAY_BUFFER, vbo3DTexCoordOffset, texCoords);
  
    // Now generate indices
    // var sonogram3DNumIndices = (sonogram3DWidth - 1) * (sonogram3DHeight - 1) * 6;
    //    this.sonogram3DNumIndices = sonogram3DNumIndices;
    //    
    //    var indices = new Uint16Array(sonogram3DNumIndices);
    //    // We need to use TRIANGLES instead of for example TRIANGLE_STRIP
    //    // because we want to make one draw call instead of hundreds per
    //    // frame, and unless we produce degenerate triangles (which are very
    //    // ugly) we won't be able to split the rows.
    //    var idx = 0;
    //    for (var z = 0; z < sonogram3DHeight - 1; z++) {
    //        for (var x = 0; x < sonogram3DWidth - 1; x++) {
    //            indices[idx++] = z * sonogram3DWidth + x;
    //            indices[idx++] = z * sonogram3DWidth + x + 1;
    //            indices[idx++] = (z + 1) * sonogram3DWidth + x + 1;
    //            indices[idx++] = z * sonogram3DWidth + x;
    //            indices[idx++] = (z + 1) * sonogram3DWidth + x + 1;
    //            indices[idx++] = (z + 1) * sonogram3DWidth + x;
    //        }
    //    }
    //  
    //  var sonogram3DIBO = gl.createBuffer();
    //  this.sonogram3DIBO = sonogram3DIBO;
    //  
    //  gl.bindBuffer(gl.ELEMENT_ARRAY_BUFFER, sonogram3DIBO);
    //  gl.bufferData(gl.ELEMENT_ARRAY_BUFFER, indices, gl.STATIC_DRAW);
  // Note we do not unbind this buffer -- not necessary
  
  // Load the shaders
  //this.frequencyShader = o3djs.shader.loadFromURL(gl, "shaders/common-vertex.shader", "shaders/frequency-fragment.shader");
  //this.waveformShader = o3djs.shader.loadFromURL(gl, "shaders/common-vertex.shader", "shaders/waveform-fragment.shader");
  this.sonogramShader = o3djs.shader.loadFromURL(gl, "/shaders/common-vertex.shader", "/shaders/sonogram-fragment.shader");

  // if (this.has3DVisualizer)
  //     this.sonogram3DShader = o3djs.shader.loadFromURL(gl, "shaders/sonogram-vertex.shader", "shaders/sonogram-fragment.shader");
}

AnalyserView.prototype.initByteBuffer = function() {
    var gl = this.gl;
    var TEXTURE_HEIGHT = this.TEXTURE_HEIGHT;
    
    if (!this.freqByteDataA || !this.freqByteDataB || this.freqByteDataA.length != analyserA.frequencyBinCount || this.freqByteDataB.length != analyserB.frequencyBinCount) {
        freqByteDataA = new Uint8Array(analyserA.frequencyBinCount);
        this.freqByteDataA = freqByteDataA;

        freqByteDataB = new Uint8Array(analyserB.frequencyBinCount);
        this.freqByteDataB = freqByteDataB;

        // (Re-)Allocate the texture object
        if (this.texture) {
            gl.deleteTexture(this.texture);
            this.texture = null;
        }
        var texture = gl.createTexture();
        this.texture = texture;
        
        gl.bindTexture(gl.TEXTURE_2D, texture);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.REPEAT);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
        // TODO(kbr): WebGL needs to properly clear out the texture when null is specified
        var tmp = new Uint8Array(freqByteDataA.length * TEXTURE_HEIGHT);
        gl.texImage2D(gl.TEXTURE_2D, 0, gl.ALPHA, freqByteDataA.length, TEXTURE_HEIGHT, 0, gl.ALPHA, gl.UNSIGNED_BYTE, tmp);
    }
}

AnalyserView.prototype.doFrequencyAnalysis = function(event) {
	var freqByteDataA = this.freqByteDataA;
	analyserA.smoothingTimeConstant = 0.65;
	analyserA.getByteFrequencyData(freqByteDataA);

	var freqByteDataB = this.freqByteDataB;
	analyserB.smoothingTimeConstant = 0.65;
	analyserB.getByteFrequencyData(freqByteDataB);

	this.drawGL();
}

AnalyserView.prototype.drawGL = function() {
    var canvas = this.canvas;
    var gl = this.gl;
    var vbo = this.vbo;
    var vboTexCoordOffset = this.vboTexCoordOffset;
    var sonogram3DVBO = this.sonogram3DVBO;
    var vbo3DTexCoordOffset = this.vbo3DTexCoordOffset;
    // var sonogram3DGeometrySize = this.sonogram3DGeometrySize;
    //     var sonogram3DNumIndices = this.sonogram3DNumIndices;
    //     var sonogram3DWidth = this.sonogram3DWidth;
    //     var sonogram3DHeight = this.sonogram3DHeight;
    var freqByteDataA = this.freqByteDataA;
    var freqByteDataB = this.freqByteDataB;
    var texture = this.texture;
    var TEXTURE_HEIGHT = this.TEXTURE_HEIGHT;
    
    // var frequencyShader = this.frequencyShader;
    // var waveformShader = this.waveformShader;
    var sonogramShader = this.sonogramShader;
    // var sonogram3DShader = this.sonogram3DShader;
    
    gl.bindTexture(gl.TEXTURE_2D, texture);
    gl.pixelStorei(gl.UNPACK_ALIGNMENT, 1);
    // if (this.analysisType != ANALYSISTYPE_SONOGRAM && this.analysisType != ANALYSISTYPE_3D_SONOGRAM) {
    //         this.yoffset = 0;
    //     }

	visByteData = new Uint8Array(freqByteDataA.length);
	for (var i=0; i<freqByteDataA.length; i++) {
		visByteData[i] = Math.abs(freqByteDataA[i] - freqByteDataB[i]);
		if (visByteData[i] < 50) visByteData[i] = visByteData[i]*0.4;
	}

    gl.texSubImage2D(gl.TEXTURE_2D, 0, 0, this.yoffset, visByteData.length, 1, gl.ALPHA, gl.UNSIGNED_BYTE, visByteData);

    // if (this.analysisType == ANALYSISTYPE_SONOGRAM || this.analysisType == ANALYSISTYPE_3D_SONOGRAM) {
        this.yoffset = (this.yoffset + 1) % TEXTURE_HEIGHT;
    // }
    var yoffset = this.yoffset;

    // Point the frequency data texture at texture unit 0 (the default),
    // which is what we're using since we haven't called activeTexture
    // in our program

    var vertexLoc;
    var texCoordLoc;
    var frequencyDataLoc;
    var foregroundColorLoc;
    var backgroundColorLoc;
    var texCoordOffset;

    var currentShader;

    // switch (this.analysisType) {
    //     case ANALYSISTYPE_FREQUENCY:
    //     case ANALYSISTYPE_WAVEFORM:
    //         gl.bindBuffer(gl.ARRAY_BUFFER, vbo);
    //         currentShader = this.analysisType == ANALYSISTYPE_FREQUENCY ? frequencyShader : waveformShader;
    //         currentShader.bind();
    //         vertexLoc = currentShader.gPositionLoc;
    //         texCoordLoc = currentShader.gTexCoord0Loc;
    //         frequencyDataLoc = currentShader.frequencyDataLoc;
    //         foregroundColorLoc = currentShader.foregroundColorLoc;
    //         backgroundColorLoc = currentShader.backgroundColorLoc;
    //         gl.uniform1f(currentShader.yoffsetLoc, 0.5 / (TEXTURE_HEIGHT - 1));
    //         texCoordOffset = vboTexCoordOffset;
    //         break;
    // 
    //     case ANALYSISTYPE_SONOGRAM:
        gl.bindBuffer(gl.ARRAY_BUFFER, vbo);
        sonogramShader.bind();
        vertexLoc = sonogramShader.gPositionLoc;
        texCoordLoc = sonogramShader.gTexCoord0Loc;
        frequencyDataLoc = sonogramShader.frequencyDataLoc;
        foregroundColorLoc = sonogramShader.foregroundColorLoc;
        backgroundColorLoc = sonogramShader.backgroundColorLoc;
        gl.uniform1f(sonogramShader.yoffsetLoc, yoffset / (TEXTURE_HEIGHT - 1));
        texCoordOffset = vboTexCoordOffset;
       //  break;
       // 
       // case ANALYSISTYPE_3D_SONOGRAM:
       //     gl.bindBuffer(gl.ARRAY_BUFFER, sonogram3DVBO);
       //     sonogram3DShader.bind();
       //     vertexLoc = sonogram3DShader.gPositionLoc;
       //     texCoordLoc = sonogram3DShader.gTexCoord0Loc;
       //     frequencyDataLoc = sonogram3DShader.frequencyDataLoc;
       //     foregroundColorLoc = sonogram3DShader.foregroundColorLoc;
       //     backgroundColorLoc = sonogram3DShader.backgroundColorLoc;
       //     gl.uniform1i(sonogram3DShader.vertexFrequencyDataLoc, 0);
       //     var normalizedYOffset = this.yoffset / (TEXTURE_HEIGHT - 1);
       //     gl.uniform1f(sonogram3DShader.yoffsetLoc, normalizedYOffset);
       //     var discretizedYOffset = Math.floor(normalizedYOffset * (sonogram3DHeight - 1)) / (sonogram3DHeight - 1);
       //     gl.uniform1f(sonogram3DShader.vertexYOffsetLoc, discretizedYOffset);
       //     gl.uniform1f(sonogram3DShader.verticalScaleLoc, sonogram3DGeometrySize / 4.0);
       // 
       //     // Set up the model, view and projection matrices
       //     projection.loadIdentity();
       //     projection.perspective(55 /*35*/, canvas.width / canvas.height, 1, 100);
       //     view.loadIdentity();
       //     view.translate(0, 0, -10.0 /*-13.0*/);
       // 
       //     // Add in camera controller's rotation
       //     model.loadIdentity();
       //     model.rotate(this.cameraController.xRot, 1, 0, 0);
       //     model.rotate(this.cameraController.yRot, 0, 1, 0);
       // 
       //     // Compute necessary matrices
       //     var mvp = new Matrix4x4();
       //     mvp.multiply(model);
       //     mvp.multiply(view);
       //     mvp.multiply(projection);
       //     gl.uniformMatrix4fv(sonogram3DShader.worldViewProjectionLoc, gl.FALSE, mvp.elements);
       //     texCoordOffset = vbo3DTexCoordOffset;
       //     break;
       // }

    if (frequencyDataLoc) {
        gl.uniform1i(frequencyDataLoc, 0);
    }
    if (foregroundColorLoc) {
        gl.uniform4fv(foregroundColorLoc, this.foregroundColor);
    }
    if (backgroundColorLoc) {
        gl.uniform4fv(backgroundColorLoc, this.backgroundColor);
    }

    // Set up the vertex attribute arrays
    gl.enableVertexAttribArray(vertexLoc);
    gl.vertexAttribPointer(vertexLoc, 3, gl.FLOAT, false, 0, 0);
    gl.enableVertexAttribArray(texCoordLoc);
    gl.vertexAttribPointer(texCoordLoc, 2, gl.FLOAT, gl.FALSE, 0, texCoordOffset);

    // Clear the render area
    gl.clear(gl.COLOR_BUFFER_BIT | gl.DEPTH_BUFFER_BIT);

    // Actually draw
    // if (this.analysisType == ANALYSISTYPE_FREQUENCY || this.analysisType == ANALYSISTYPE_WAVEFORM || this.analysisType == ANALYSISTYPE_SONOGRAM) {
        gl.drawArrays(gl.TRIANGLES, 0, 6);
    // } else if (this.analysisType == ANALYSISTYPE_3D_SONOGRAM) {
    //         // Note: this expects the element array buffer to still be bound
    //         gl.drawElements(gl.TRIANGLES, sonogram3DNumIndices, gl.UNSIGNED_SHORT, 0);
    //     }

    // Disable the attribute arrays for cleanliness
    gl.disableVertexAttribArray(vertexLoc);
    gl.disableVertexAttribArray(texCoordLoc);
}
