
<!--
> Developer     - Anil Kumar , 9131974355, er.aniljadon,ak@gmail.com
> Demo          - Video / Audio Recorder
-->
<?php
include('database.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Audio+Video Recording </title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="author" type="text/html" href="https://plus.google.com/+MuazKhan">
    <meta name="author" content="Muaz Khan">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <link rel="stylesheet" href="https://cdn.webrtc-experiment.com/style.css">

    <style>
    audio {
        vertical-align: bottom;
        width: 10em;
    }
    video {
        max-width: 100%;
        vertical-align: top;
    }
    input {
        border: 1px solid #d9d9d9;
        border-radius: 1px;
        font-size: 2em;
        margin: .2em;
        width: 30%;
    }
    p,
    .inner {
        padding: 1em;
    }
    li {
        border-bottom: 1px solid rgb(189, 189, 189);
        border-left: 1px solid rgb(189, 189, 189);
        padding: .5em;
    }
    label {
        display: inline-block;
        width: 8em;
    }
    </style>

    <style>
        .recordrtc button {
            font-size: inherit;
        }

        .recordrtc button, .recordrtc select {
            vertical-align: middle;
            line-height: 1;
            padding: 2px 5px;
            height: auto;
            font-size: inherit;
            margin: 0;
        }

        .recordrtc, .recordrtc .header {
            display: block;
            text-align: center;
            padding-top: 0;
        }

        .recordrtc video {
            width: 70%;
        }

        .recordrtc option[disabled] {
            display: none;
        }
    </style>

    <script src="https://cdn.webrtc-experiment.com/RecordRTC.js"></script>
    <script src="https://cdn.webrtc-experiment.com/gif-recorder.js"></script>
    <script src="https://cdn.webrtc-experiment.com/getScreenId.js"></script>

    <!-- for Edige/FF/Chrome/Opera/etc. getUserMedia support -->
    <script src="https://cdn.webrtc-experiment.com/gumadapter.js"></script>
	
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>

<body>
    <article>
        <header style="text-align: center;">
            <h1>
                Audio+Video Recording 
            </h1>
            
        </header>

        

        <section class="experiment recordrtc">
            <h2 class="header">
                <select class="recording-media">
                    <option value="record-video">Video</option>
                    <option value="record-audio">Audio</option>
                    
                </select>

                into
                <select class="media-container-format">
                    <option>WebM</option>
                    <option disabled>Mp4</option>
                    <option disabled>WAV</option>
                    <option disabled>Ogg</option>
                    <option>Gif</option>
                </select>

                <button>Start Recording</button>
            </h2>

            <div style="text-align: center; display: none;">
                <button id="save-to-disk">Save To Disk</button>
                <button id="open-new-tab">Open New Tab</button>
                <button id="upload-to-server">Upload To Server</button>
            </div>

            <br>

            <video controls muted id="main"></video>
        </section>

        <script>
            (function() {
                var params = {},
                    r = /([^&=]+)=?([^&]*)/g;

                function d(s) {
                    return decodeURIComponent(s.replace(/\+/g, ' '));
                }

                var match, search = window.location.search;
                while (match = r.exec(search.substring(1))) {
                    params[d(match[1])] = d(match[2]);

                    if(d(match[2]) === 'true' || d(match[2]) === 'false') {
                        params[d(match[1])] = d(match[2]) === 'true' ? true : false;
                    }
                }

                window.params = params;
            })();
        </script>

        <script>
            var recordingDIV = document.querySelector('.recordrtc');
            var recordingMedia = recordingDIV.querySelector('.recording-media');
            var recordingPlayer = recordingDIV.querySelector('video');
            var mediaContainerFormat = recordingDIV.querySelector('.media-container-format');

            recordingDIV.querySelector('button').onclick = function() {
                var button = this;

                if(button.innerHTML === 'Stop Recording') {
                    button.disabled = true;
                    button.disableStateWaiting = true;
                    setTimeout(function() {
                        button.disabled = false;
                        button.disableStateWaiting = false;
                    }, 2 * 1000);

                    button.innerHTML = 'Star Recording';

                    function stopStream() {
                        if(button.stream && button.stream.stop) {
                            button.stream.stop();
                            button.stream = null;
                        }
                    }

                    if(button.recordRTC) {
                        if(button.recordRTC.length) {
                            button.recordRTC[0].stopRecording(function(url) {
                                if(!button.recordRTC[1]) {
                                    button.recordingEndedCallback(url);
                                    stopStream();

                                    saveToDiskOrOpenNewTab(button.recordRTC[0]);
                                    return;
                                }

                                button.recordRTC[1].stopRecording(function(url) {
                                    button.recordingEndedCallback(url);
                                    stopStream();
                                });
                            });
                        }
                        else {
                            button.recordRTC.stopRecording(function(url) {
                                button.recordingEndedCallback(url);
                                stopStream();

                                saveToDiskOrOpenNewTab(button.recordRTC);
                            });
                        }
                    }

                    return;
                }

                button.disabled = true;

                var commonConfig = {
                    onMediaCaptured: function(stream) {
                        button.stream = stream;
                        if(button.mediaCapturedCallback) {
                            button.mediaCapturedCallback();
                        }

                        button.innerHTML = 'Stop Recording';
                        button.disabled = false;
                    },
                    onMediaStopped: function() {
                        button.innerHTML = 'Start Recording';

                        if(!button.disableStateWaiting) {
                            button.disabled = false;
                        }
                    },
                    onMediaCapturingFailed: function(error) {
                        if(error.name === 'PermissionDeniedError' && !!navigator.mozGetUserMedia) {
                            InstallTrigger.install({
                                'Foo': {
                                    // https://addons.mozilla.org/firefox/downloads/latest/655146/addon-655146-latest.xpi?src=dp-btn-primary
                                    URL: 'https://addons.mozilla.org/en-US/firefox/addon/enable-screen-capturing/',
                                    toString: function () {
                                        return this.URL;
                                    }
                                }
                            });
                        }

                        commonConfig.onMediaStopped();
                    }
                };

                if(recordingMedia.value === 'record-video') {
                    captureVideo(commonConfig);

                    button.mediaCapturedCallback = function() {
                        button.recordRTC = RecordRTC(button.stream, {
                            type: mediaContainerFormat.value === 'Gif' ? 'gif' : 'video',
                            disableLogs: params.disableLogs || false,
                            canvas: {
                                width: params.canvas_width || 320,
                                height: params.canvas_height || 240
                            },
                            frameInterval: typeof params.frameInterval !== 'undefined' ? parseInt(params.frameInterval) : 20 // minimum time between pushing frames to Whammy (in milliseconds)
                        });

                        button.recordingEndedCallback = function(url) {
                            recordingPlayer.src = null;
                            recordingPlayer.srcObject = null;

                            if(mediaContainerFormat.value === 'Gif') {
                                recordingPlayer.pause();
                                recordingPlayer.poster = url;

                                recordingPlayer.onended = function() {
                                    recordingPlayer.pause();
                                    recordingPlayer.poster = URL.createObjectURL(button.recordRTC.blob);
                                };
                                return;
                            }

                            recordingPlayer.src = url;
                            recordingPlayer.play();

                            recordingPlayer.onended = function() {
                                recordingPlayer.pause();
                                recordingPlayer.src = URL.createObjectURL(button.recordRTC.blob);
                            };
                        };

                        button.recordRTC.startRecording();
                    };
                }

                if(recordingMedia.value === 'record-audio') {
                    captureAudio(commonConfig);

                    button.mediaCapturedCallback = function() {
                        button.recordRTC = RecordRTC(button.stream, {
                            type: 'audio',
                            bufferSize: typeof params.bufferSize == 'undefined' ? 0 : parseInt(params.bufferSize),
                            sampleRate: typeof params.sampleRate == 'undefined' ? 44100 : parseInt(params.sampleRate),
                            leftChannel: params.leftChannel || false,
                            disableLogs: params.disableLogs || false,
                            recorderType: webrtcDetectedBrowser === 'edge' ? StereoAudioRecorder : null
                        });

                        button.recordingEndedCallback = function(url) {
                            var audio = new Audio();
                            audio.src = url;
                            audio.controls = true;
                            recordingPlayer.parentNode.appendChild(document.createElement('hr'));
                            recordingPlayer.parentNode.appendChild(audio);

                            if(audio.paused) audio.play();

                            audio.onended = function() {
                                audio.pause();
                                audio.src = URL.createObjectURL(button.recordRTC.blob);
                            };
                        };

                        button.recordRTC.startRecording();
                    };
                }

                if(recordingMedia.value === 'record-audio-plus-video') {
                    captureAudioPlusVideo(commonConfig);

                    button.mediaCapturedCallback = function() {

                        if(webrtcDetectedBrowser !== 'firefox') { // opera or chrome etc.
                            button.recordRTC = [];

                            if(!params.bufferSize) {
                                // it fixes audio issues whilst recording 720p
                                params.bufferSize = 16384;
                            }

                            var audioRecorder = RecordRTC(button.stream, {
                                type: 'audio',
                                bufferSize: typeof params.bufferSize == 'undefined' ? 0 : parseInt(params.bufferSize),
                                sampleRate: typeof params.sampleRate == 'undefined' ? 44100 : parseInt(params.sampleRate),
                                leftChannel: params.leftChannel || false,
                                disableLogs: params.disableLogs || false,
                                recorderType: webrtcDetectedBrowser === 'edge' ? StereoAudioRecorder : null
                            });

                            var videoRecorder = RecordRTC(button.stream, {
                                type: 'video',
                                disableLogs: params.disableLogs || false,
                                canvas: {
                                    width: params.canvas_width || 320,
                                    height: params.canvas_height || 240
                                },
                                frameInterval: typeof params.frameInterval !== 'undefined' ? parseInt(params.frameInterval) : 20 // minimum time between pushing frames to Whammy (in milliseconds)
                            });

                            // to sync audio/video playbacks in browser!
                            videoRecorder.initRecorder(function() {
                                audioRecorder.initRecorder(function() {
                                    audioRecorder.startRecording();
                                    videoRecorder.startRecording();
                                });
                            });

                            button.recordRTC.push(audioRecorder, videoRecorder);

                            button.recordingEndedCallback = function() {
                                var audio = new Audio();
                                audio.src = audioRecorder.toURL();
                                audio.controls = true;
                                audio.autoplay = true;

                                audio.onloadedmetadata = function() {
                                    recordingPlayer.src = videoRecorder.toURL();
                                    recordingPlayer.play();
                                };

                                recordingPlayer.parentNode.appendChild(document.createElement('hr'));
                                recordingPlayer.parentNode.appendChild(audio);

                                if(audio.paused) audio.play();
                            };
                            return;
                        }

                        button.recordRTC = RecordRTC(button.stream, {
                            type: 'video',
                            disableLogs: params.disableLogs || false,
                            // we can't pass bitrates or framerates here
                            // Firefox MediaRecorder API lakes these features
                        });

                        button.recordingEndedCallback = function(url) {
                            recordingPlayer.srcObject = null;
                            recordingPlayer.muted = false;
                            recordingPlayer.src = url;
                            recordingPlayer.play();

                            recordingPlayer.onended = function() {
                                recordingPlayer.pause();
                                recordingPlayer.src = URL.createObjectURL(button.recordRTC.blob);
                            };
                        };

                        button.recordRTC.startRecording();
                    };
                }

                if(recordingMedia.value === 'record-screen') {
                    captureScreen(commonConfig);

                    button.mediaCapturedCallback = function() {
                        button.recordRTC = RecordRTC(button.stream, {
                            type: mediaContainerFormat.value === 'Gif' ? 'gif' : 'video',
                            disableLogs: params.disableLogs || false,
                            canvas: {
                                width: params.canvas_width || 320,
                                height: params.canvas_height || 240
                            }
                        });

                        button.recordingEndedCallback = function(url) {
                            recordingPlayer.src = null;
                            recordingPlayer.srcObject = null;

                            if(mediaContainerFormat.value === 'Gif') {
                                recordingPlayer.pause();
                                recordingPlayer.poster = url;
                                recordingPlayer.onended = function() {
                                    recordingPlayer.pause();
                                    recordingPlayer.poster = URL.createObjectURL(button.recordRTC.blob);
                                };
                                return;
                            }

                            recordingPlayer.src = url;
                            recordingPlayer.play();
                        };

                        button.recordRTC.startRecording();
                    };
                }

                if(recordingMedia.value === 'record-audio-plus-screen') {
                    captureAudioPlusScreen(commonConfig);

                    button.mediaCapturedCallback = function() {
                        button.recordRTC = RecordRTC(button.stream, {
                            type: 'video',
                            disableLogs: params.disableLogs || false,
                            // we can't pass bitrates or framerates here
                            // Firefox MediaRecorder API lakes these features
                        });

                        button.recordingEndedCallback = function(url) {
                            recordingPlayer.srcObject = null;
                            recordingPlayer.muted = false;
                            recordingPlayer.src = url;
                            recordingPlayer.play();

                            recordingPlayer.onended = function() {
                                recordingPlayer.pause();
                                recordingPlayer.src = URL.createObjectURL(button.recordRTC.blob);
                            };
                        };

                        button.recordRTC.startRecording();
                    };
                }
            };

            function captureVideo(config) {
                captureUserMedia({video: true}, function(videoStream) {
                    recordingPlayer.srcObject = videoStream;
                    recordingPlayer.play();

                    config.onMediaCaptured(videoStream);

                    videoStream.onended = function() {
                        config.onMediaStopped();
                    };
                }, function(error) {
                    config.onMediaCapturingFailed(error);
                });
            }

            function captureAudio(config) {
                captureUserMedia({audio: true}, function(audioStream) {
                    recordingPlayer.srcObject = audioStream;
                    recordingPlayer.play();

                    config.onMediaCaptured(audioStream);

                    audioStream.onended = function() {
                        config.onMediaStopped();
                    };
                }, function(error) {
                    config.onMediaCapturingFailed(error);
                });
            }

            function captureAudioPlusVideo(config) {
                captureUserMedia({video: true, audio: true}, function(audioVideoStream) {
                    recordingPlayer.srcObject = audioVideoStream;
                    recordingPlayer.play();

                    config.onMediaCaptured(audioVideoStream);

                    audioVideoStream.onended = function() {
                        config.onMediaStopped();
                    };
                }, function(error) {
                    config.onMediaCapturingFailed(error);
                });
            }

            function captureScreen(config) {
                getScreenId(function(error, sourceId, screenConstraints) {
                    if (error === 'not-installed') {
                        document.write('<h1><a target="_blank" href="https://chrome.google.com/webstore/detail/screen-capturing/ajhifddimkapgcifgcodmmfdlknahffk">Please install this chrome extension then reload the page.</a></h1>');
                    }

                    if (error === 'permission-denied') {
                        alert('Screen capturing permission is denied.');
                    }

                    if (error === 'installed-disabled') {
                        alert('Please enable chrome screen capturing extension.');
                    }

                    if(error) {
                        config.onMediaCapturingFailed(error);
                        return;
                    }

                    captureUserMedia(screenConstraints, function(screenStream) {
                        recordingPlayer.srcObject = screenStream;
                        recordingPlayer.play();

                        config.onMediaCaptured(screenStream);

                        screenStream.onended = function() {
                            config.onMediaStopped();
                        };
                    }, function(error) {
                        config.onMediaCapturingFailed(error);
                    });
                });
            }

            function captureAudioPlusScreen(config) {
                getScreenId(function(error, sourceId, screenConstraints) {
                    if (error === 'not-installed') {
                        document.write('<h1><a target="_blank" href="https://chrome.google.com/webstore/detail/screen-capturing/ajhifddimkapgcifgcodmmfdlknahffk">Please install this chrome extension then reload the page.</a></h1>');
                    }

                    if (error === 'permission-denied') {
                        alert('Screen capturing permission is denied.');
                    }

                    if (error === 'installed-disabled') {
                        alert('Please enable chrome screen capturing extension.');
                    }

                    if(error) {
                        config.onMediaCapturingFailed(error);
                        return;
                    }

                    screenConstraints.audio = true;

                    captureUserMedia(screenConstraints, function(screenStream) {
                        recordingPlayer.srcObject = screenStream;
                        recordingPlayer.play();

                        config.onMediaCaptured(screenStream);

                        screenStream.onended = function() {
                            config.onMediaStopped();
                        };
                    }, function(error) {
                        config.onMediaCapturingFailed(error);
                    });
                });
            }

            function captureUserMedia(mediaConstraints, successCallback, errorCallback) {
                navigator.mediaDevices.getUserMedia(mediaConstraints).then(successCallback).catch(errorCallback);
            }

            function setMediaContainerFormat(arrayOfOptionsSupported) {
                var options = Array.prototype.slice.call(
                    mediaContainerFormat.querySelectorAll('option')
                );

                var selectedItem;
                options.forEach(function(option) {
                    option.disabled = true;

                    if(arrayOfOptionsSupported.indexOf(option.value) !== -1) {
                        option.disabled = false;

                        if(!selectedItem) {
                            option.selected = true;
                            selectedItem = option;
                        }
                    }
                });
            }

            recordingMedia.onchange = function() {
                if(this.value === 'record-audio') {
                    setMediaContainerFormat(['WAV', 'Ogg']);
                    return;
                }
                setMediaContainerFormat(['WebM', /*'Mp4',*/ 'Gif']);
            };

            if(webrtcDetectedBrowser === 'edge') {
                // webp isn't supported in Microsoft Edge
                // neither MediaRecorder API
                // so lets disable both video/screen recording options

                console.warn('Neither MediaRecorder API nor webp is supported in Microsoft Edge. You cam merely record audio.');

                recordingMedia.innerHTML = '<option value="record-audio">Audio</option>';
                setMediaContainerFormat(['WAV']);
            }

            if(webrtcDetectedBrowser === 'firefox') {
                // Firefox implemented both MediaRecorder API as well as WebAudio API
                // Their MediaRecorder implementation supports both audio/video recording in single container format
                // Remember, we can't currently pass bit-rates or frame-rates values over MediaRecorder API (their implementation lakes these features)

                recordingMedia.innerHTML = '<option value="record-audio-plus-video">Audio+Video</option>'
                                            + '<option value="record-audio-plus-screen">Audio+Screen</option>'
                                            + recordingMedia.innerHTML;
            }

            // disabling this option because currently this demo
            // doesn't supports publishing two blobs.
            // todo: add support of uploading both WAV/WebM to server.
            if(false && webrtcDetectedBrowser === 'chrome') {
                recordingMedia.innerHTML = '<option value="record-audio-plus-video">Audio+Video</option>'
                                            + recordingMedia.innerHTML;
                console.info('This RecordRTC demo merely tries to playback recorded audio/video sync inside the browser. It still generates two separate files (WAV/WebM).');
            }

            function saveToDiskOrOpenNewTab(recordRTC) {
                recordingDIV.querySelector('#save-to-disk').parentNode.style.display = 'block';
                recordingDIV.querySelector('#save-to-disk').onclick = function() {
                    if(!recordRTC) return alert('No recording found.');

                    recordRTC.save();
                };

                recordingDIV.querySelector('#open-new-tab').onclick = function() {
                    if(!recordRTC) return alert('No recording found.');

                    window.open(recordRTC.toURL());
                };

                recordingDIV.querySelector('#upload-to-server').disabled = false;
                recordingDIV.querySelector('#upload-to-server').onclick = function() {
                    if(!recordRTC) return alert('No recording found.');
                    this.disabled = true;

                    var button = this;
                    uploadToServer(recordRTC, function(progress, fileURL) {
                        if(progress === 'ended') {
                            button.disabled = false;
                            button.innerHTML = 'Click to download from server';
                            button.onclick = function() {
                                window.open(fileURL);
                            };
                            return;
                        }
                        button.innerHTML = progress;
                    });
                };
            }

            var listOfFilesUploaded = [];
			
			
			
			function uploadToServer(recordRTC, callback) {
			    var blob = recordRTC instanceof Blob ? recordRTC : recordRTC.blob;
                var fileType = blob.type.split('/')[0] || 'audio';
                var fileName = (Math.random() * 1000).toString().replace('.', '');
                //alert(fileName);
                if (fileType === 'audio') {
                    fileName += '.' + (!!navigator.mozGetUserMedia ? 'ogg' : 'wav');
                } else {
                    fileName += '.webm';
                }

				 /*var formData = new FormData();
                   formData.append(fileType + '-filename', fileName);
                   formData.append(fileType + '-blob', blob);*/
				   
				   var form_data = new FormData();
					form_data.append(fileType+'-filename', fileName);
					form_data.append(fileType+'-blob', blob);
				 
				 $.ajax({
							url: 'save.php', // point to server-side PHP script 
							dataType: 'text',  // what to expect back from the PHP script, if anything
							cache: false,
							contentType: false,
							processData: false,
							data: form_data,                        
							type: 'post',
							success: function (progress) {
							//alert(progress);
							if(progress === 'success') {
                            button.disabled = false;
                            button.innerHTML = 'Click to download from server';
                            button.onclick = function() {
                                window.open(fileURL);
                            };
                            return;
                        }
							if (progress !== 'upload-ended') {
                                callback(progress);
                                return;
                            }

                            var initialURL = location.href.replace(location.href.split('/').pop(), '') + 'uploads/';

                            callback('ended', initialURL + fileName);

                             // to make sure we can delete as soon as visitor leaves
                            listOfFilesUploaded.push(initialURL + fileName);
							  
							  
						    }
						});
			}
			

            function uploadToServers(recordRTC, callback) {
                var blob = recordRTC instanceof Blob ? recordRTC : recordRTC.blob;
                var fileType = blob.type.split('/')[0] || 'audio';
                var fileName = (Math.random() * 1000).toString().replace('.', '');

                if (fileType === 'audio') {
                    fileName += '.' + (!!navigator.mozGetUserMedia ? 'ogg' : 'wav');
                } else {
                    fileName += '.webm';
                }

                // create FormData
                /*var formData = new FormData();
                formData.append(fileType + '-filename', fileName);
                formData.append(fileType + '-blob', blob);*/
				
				var form_data = new FormData();
					form_data.append(fileType+'-filename', fileName);
					form_data.append(fileType+'-blob', blob);

                callback('Uploading ' + fileType + ' recording to server.');

                makeXMLHttpRequest('save.php', formData, function(progress) {
				
                    if (progress !== 'upload-ended') {
                        callback(progress);
                        return;
                    }

                    var initialURL = location.href.replace(location.href.split('/').pop(), '') + 'uploads/';

                    callback('ended', initialURL + fileName);

                    // to make sure we can delete as soon as visitor leaves
                    listOfFilesUploaded.push(initialURL + fileName);
                });
            }

            function makeXMLHttpRequest(url, data, callback) {
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() {
                    if (request.readyState == 4 && request.status == 200) {
                        callback('upload-ended');
                    }
                };

                request.upload.onloadstart = function() {
                    callback('Upload started...');
                };

                request.upload.onprogress = function(event) {
                    callback('Upload Progress ' + Math.round(event.loaded / event.total * 100) + "%");
                };

                request.upload.onload = function() {
                    callback('progress-about-to-end');
                };

                request.upload.onload = function() {
                    callback('progress-ended');
                };

                request.upload.onerror = function(error) {
                    callback('Failed to upload to server');
                    console.error('XMLHttpRequest failed', error);
                };

                request.upload.onabort = function(error) {
                    callback('Upload aborted.');
                    console.error('XMLHttpRequest aborted', error);
                };

                request.open('POST', url);
                request.send(data);
            }

            window.onbeforeunload = function() {
                recordingDIV.querySelector('button').disabled = false;
                recordingMedia.disabled = false;
                mediaContainerFormat.disabled = false;

                if(!listOfFilesUploaded.length) return;

                listOfFilesUploaded.forEach(function(fileURL) {
                    var request = new XMLHttpRequest();
                    request.onreadystatechange = function() {
                        if (request.readyState == 4 && request.status == 200) {
                            if(this.responseText === ' problem deleting files.') {
                                alert('Failed to delete ' + fileURL + ' from the server.');
                                return;
                            }

                            listOfFilesUploaded = [];
                            alert('You can leave now. Your files are removed from the server.');
                        }
                    };
                    request.open('POST', 'delete.php');

                    var formData = new FormData();
                    formData.append('delete-file', fileURL.split('/').pop());
                    request.send(formData);
                });

                return 'Please wait few seconds before your recordings are deleted from the server.';
            };
        </script>

		
        
        <section class="experiment">
            <h2 class="header">Audio...</h2>

            <ol>
			<?php 
			$audio = mysql_query("select * from `insert` where file_type='Audio'");
			if(mysql_num_rows($audio)>0){
			    while($audio_data=mysql_fetch_array($audio)){?>
					<li>
					<audio controls>
                       <source src="uploads/<?php echo $audio_data['file_name'];?>" type="audio/wav">
                       <source src="uploads/<?php echo $audio_data['file_name'];?>" type="audio/ogg">
                       </audio>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					   <?php echo $audio_data['file_name'];?>
					</li>
				
				
			    <?php }
			}else{
				echo "No Audio Available....";
			}
			?>
               
            </ol>

            
        </section>

        <section class="experiment">
            <h2 class="header">Video...</h2>
            <ol>
			<?php 
			$video = mysql_query("select * from `insert` where file_type='Video'");
			if(mysql_num_rows($video)>0){
			    while($video_data=mysql_fetch_array($video)){?>
					<li>
					<video controls width="200px;">
                       <source src="uploads/<?php echo $video_data['file_name'];?>" type="video/gif">
                       <source src="uploads/<?php echo $video_data['file_name'];?>" type="video/webm">
                       </video>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					   <?php echo $video_data['file_name'];?>
					</li>
				
				
			    <?php }
			}else{
				echo "No Video Available....";
			}
			?>
               
            </ol>

        </section>

        


        

        

    <!-- commits.js is useless for you! -->
    <!--<script>
        window.useThisGithubPath = 'muaz-khan/RecordRTC';
    </script>
    <script src="https://cdn.webrtc-experiment.com/commits.js" async></script>-->
</body>

</html>



<SCRIPT>
  $(document).ready(function()
 {
   	$(document).bind("contextmenu",function(e){
          	return false;
   	});
  })
  document.onkeydown = function(e) {
    	if (e.ctrlKey &&
        	(e.keyCode === 67 ||
         	e.keyCode === 86 ||
         	e.keyCode === 85 ||
         	e.keyCode === 117)) {
        	alert('not allowed');
        	return false;
    	} else {
        	return true;
    	}
  };
  </SCRIPT>
