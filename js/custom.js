
var PI = {
	onReady: function() {
		//$(document).pjax('a', '#pjax-container')	
		//$(document).pjax('[data-pjax] a, a[data-pjax]', '#pjax-container')
		$('a[data-pjax]').pjax();
		$(document).on('pjax:popstate', function() {
			$(document).one('pjax:end', function(event) {
				$(event.target).find('script').each(function() {
					$.globalEval(this.text || this.textContent || this.innerHTML || '');
				});
			});
		});
		$('body').bind('pjax:start', function(xhr, options) {
			$(options.container).fadeOut("fast", function() {
				alert("Faded out");
			});
		}).bind('pjax:end', function(xhr, options) {
			$(options.container).fadeIn("fast");
			sizeContent();
		});
	}

};


(function($){
	$.event.special.destroyed = {
		remove: function(o) {
			if (o.handler) {
				o.handler()
			}
		}
	}

	$.fn.exists = function () {
		return this.length !== 0;
	}
})(jQuery)


$(document).ready( PI.onReady );

var PM = {
	onReady: function() {

		window.onmessage = function(m) {
			if(m.data['r'] == 'drive')
				PM.send(m.data);
			else if(m.data['r'] == 'waypoint')
				PM.send(m.data);
			//console.log(m.data); 
		};


		connect();

		function connect(){
			var server = $('meta[name=wsserver]').attr("content");
			var host = "ws://" + server + "/socket/server/startDaemon.php";
			var cbh, fcbh, scbh;

			try{
				PM.socket = new WebSocket(host);

				PM.message('<p class="event">Socket Status: '+PM.socket.readyState);

				PM.socket.onopen = function(){
					$("#aside").removeClass("bg-danger");
					PM.message('<p class="event">Socket Status: '+PM.socket.readyState+' (open)');
					fcbh = setInterval(fastTick, 200);
					cbh = setInterval(tick, 2000);
					scbh = setInterval(slowTick, 5000);
					tick();
					fastTick();
					slowTick();
				}

				PM.socket.onmessage = function(msg){
					PM.message('<p class="message">Received: '+msg.data);
					var obj = jQuery.parseJSON(msg.data);
					handle(obj);
				}

				PM.socket.onclose = function(){
					PM.message('<p class="event">Socket Status: '+PM.socket.readyState+' (Closed)');
					clearInterval(fcbh);
					clearInterval(cbh);
					clearInterval(scbh);
					$("#aside").addClass("bg-danger");
					setTimeout(connect, 3000);
				}			

			} catch(exception){
				PM.message('<p>Error'+exception);
			}

			function fastTick() {
				if($("#sensorframe").exists()) PM.Service.sensor();
				if($("#mapframe").exists()) PM.Service.map();
			}

			function tick() {
				PM.send('ping');
				if($("#statelist").exists()) PM.Service.statelist();
				if($("#processlist").exists()) PM.send('plist');
				if($("#statuslist").exists()) PM.send('statuslist');
				if($("#diagnosticspanel").exists()) PM.Service.diagnostics();
				if($("#logpanel").exists()) PM.Service.log();
			}

			function slowTick() {
				if($("#servicelist").exists()) PM.send('slist');
			}

			function handle(obj) {
				console.log(obj);
				if(obj['r'] == 'ping') {
					var lastTime = $("#errorStatusTime").val();
					if('errStatusTime' in obj && obj['errStatusTime'] != lastTime && obj['errStatusTime'] != -1) {
						$("#errorStatusTime").val(obj['errStatusTime']);
						$("#errorStatusPlayer").html('<audio autoplay="true" preload="auto" id="audio"><source src="/data/nbstatus.wav?' + Math.random() + '" type="audio/x-wav"/></audio>');
						var audio = document.getElementById('audio');
						audio.load();
						audio.play();
					}
					if('dxerr' in obj && obj['dxerr']) {
						$("#diagnosticstab div.badge").removeClass("hidden").text(obj['dxerr']);//.stop().fadeOut("fast").fadeIn("fast");
					}
				}
				else if(obj['r'] == 'slist') {
					$(".svcrow").remove();
					obj['services'].forEach(function(d) {
						$("#servicelist").append(
							'<tr class="svcrow"> \
							<td><h4 class="proc">' + d['name'] + '</h4></td> \
							<td class="text-right"> \
							<button type="button" class="btn btn-icon btn-warning" onclick="PM.Service.runservice(\'' + d['name'] + '\')"><i class="fa fa-check-circle"></i>Run</button> \
							</td> \
							</tr>'
						);


					});
				}
				else if(obj['r'] == 'plist') {
					$(".procrow").remove();
					var runningProcs = 0;
					obj['proc'].forEach(function(d) {
						if(d['pid'] != '')
							runningProcs++; 

						$("#processlist").append(
							'<tr class="procrow"> \
							<td><h4 class="proc">' + d['name'] + '</h4></td> \
							<td class="hidden-xs">' + d['pid'] + '</td> \
							<td class="hidden-xs">' + d['mem'] + '</td> \
							<td class="hidden-xs">' + d['cpu'] + '</td> \
							<td class="text-right"> \
							<button type="button" class="btn btn-icon ' + (d['pid'] ? 'btn-default' : 'btn-success') + '" ' + (d['pid'] ? 'disabled="disabled"' : '') + ' onclick="PM.Service.startproc(' + d['key'] + ')"><i class="fa ' + ((d['status'] == 'Starting' || d['status'] == 'Queued') ? 'fa-circle-o-notch fa-spin' : 'fa-check-circle') + '"></i>Start</button> \
							<button type="button" class="btn btn-icon ' + (d['pid'] ? 'btn-danger' : 'btn-default') + '" ' + (d['pid'] || d['status']=='Starting' ? '' : 'disabled="disabled"') +' onclick="PM.Service.stopproc(' + d['key'] + ')"><i class="fa ' + (d['status'] == 'Stopping' ? 'fa-circle-o-notch fa-spin' : 'fa-exclamation') + '"></i>Stop</button> \
							</td> \
							</tr>'
						);

					});
					if(runningProcs > 0)
						$("#startstopallproc").removeClass('btn-success').addClass('btn-danger');
					else
						$("#startstopallproc").removeClass('btn-danger').addClass('btn-success');
				}
				else if(obj['r'] == 'statuslist') {
					$("#statuslist").children().remove();
					obj['status'].forEach(function(d) {
						if('group' in d) {
							var bad = (d['rc'] != '0' || d['line'].trim() == '');

							if(!('line' in d))
								d['line'] = '';

							$("#statuslist").append(
								'<div class="col-md-3 col-sm-6">\
								<div class="panel panel-animated ' + (bad ? 'panel-danger' : 'bg-cloud') + ' animated fadeInUp" style="visibility: visible;">\
								<div class="panel-body">\
								<i class="fa ' + (bad ? 'fa-ban' : 'fa-check') +' fa-2x" style="float: right"></i>\
								<p class="lead">' + d['name'] + '<small>'+d['line']+'</small></p><!--/lead as title-->\
								</div><!--/panel-body-->\
								</div><!--/panel overal-phisicmem-->\
								</div><!--/cols-->'
							);	
						}
					});
				}
				else if(obj['r'] == 'sensor') {
					if('laserscan' in obj['sensorinfo']) {
						laserdata = obj['sensorinfo']['laserscan'];
						barrels = [];
						lines = [];
					}
					if('barrels' in obj['sensorinfo'] && 'pts' in obj['sensorinfo']['barrels']) 
						barrels = obj['sensorinfo']['barrels']['pts'];

					if('lines' in obj['sensorinfo']) { 
						lines = [];
						line = [];
						for(i = 0; i < obj['sensorinfo']['lines']['pts'].length; i+=2) {
							line = [ obj['sensorinfo']['lines']['pts'][i][0], obj['sensorinfo']['lines']['pts'][i][1], obj['sensorinfo']['lines']['pts'][i+1][0], obj['sensorinfo']['lines']['pts'][i+1][1] ]
								lines.push(line);
						}
						// lines = obj['sensorinfo']['lines'];
					}
          
					if('estop' in obj['sensorinfo'])
						estop = obj['sensorinfo']['estop']['val'];
					if('battery' in obj['sensorinfo'])
						battery = obj['sensorinfo']['battery']['val'];
					if('cmdvel' in obj['sensorinfo'])
						cmdvel = obj['sensorinfo']['cmdvel'];
					if('time_left' in obj['sensorinfo'])
						time_left = obj['sensorinfo']['time_left']['val'];

				}
				else if(obj['r'] == 'map') {
					$("#mapframe")[0].contentWindow.postMessage(obj, "*"); 
				}
				else if(obj['r'] == 'diagnostics') {
					//console.log(obj['diagnostics']);
					//$("#diagnosticspanel").children().remove();
					obj['diagnostics'].forEach(function(d) {
						var id = d['name'].replace(/[^a-zA-Z0-9]+/g, "-");
						var headingstyle = '';
						switch(d['level']) {
							case 0: headingstyle = '-success'; break;
							case 1: //headingstyle = '-warning'; break;
							case 2: headingstyle = '-danger'; break;
							case 3: headingstyle = '-info'; break;
						}

						var values = "<b>" + d['message'] + "</b><br/>";
						d['values'].forEach(function(v) {
							values += '' + v + '<br/>';
						});

						var el = $("#dx-" + id);
						if(el.length == 0) {
							el = $("#diagnosticspanel").append('<div id="dx-' + id + '" class="col-md-3 col-sm-6 col-lg-2">\
							<div class="panel panel' + headingstyle + '" style="cursor: pointer" onclick="$(this).children().removeClass(\'hidden-xs\')">\
								<div class="panel-heading"><h3 class="panel-title">' + d['name'] + '</h3></div>\
								<div class="panel-body hidden-xs" id="dxt-' + id + '" style="margin: 9px; font-size: 10px"></div>\
							</div>\
							</div>').children().last();
						}
							
						$("#dxt-" + id).html(values);
						if(d['level'] > 0) {
							$(el).find(".hidden-xs").removeClass("hidden-xs");
							$(el).find(".panel-heading").addClass("bg" + headingstyle);
						}

					});
					//$("#diagnosticpanel").html(
				}
				else if(obj['r'] == 'statelist') {
					if('state' in obj)
						$("#statelist").html(obj['state']);
					if('map' in obj) 
						$("#maplist").html(obj['map']);
				}
				else if(obj['r'] == 'log') {
					var output = '';
					obj['loginfo'].forEach(function(entry) {
						output += '[' + entry['name'] + ' ' + entry['time'].toFixed(2) + ']: ' + entry['msg'] + '\n';
					});
					$("#logpanel").html(output);
				}
			}

		}//End connect

	},
	send: function (text){

		try{
			if(typeof text !== 'string')
				text = JSON.stringify(text);

			if(PM.socket) {
				PM.socket.send(text);
				PM.message('<p class="event">Sent: '+text)
			}
		} catch(exception){
			PM.message('<p class="warning">' + exception);
		}
	},

	message: function (msg){
		//console.log(msg + '</p>');
	},

	Service: {
		startproc: function(key) {
			PM.send({r: 'startproc', key: key});
		},

		stopproc: function(key) {
			PM.send({r: 'stopproc', key: key});
		},
		startstopallproc: function() {
			PM.send({r: 'startstopallproc'});
		},
		runservice: function(key) {
			PM.send({r: 'runservice', key: key});
		},
		statelist: function() {
			PM.send({r: 'statelist'});
		},
		diagnostics: function() {
			PM.send({r: 'diagnostics'});
		},
		sensor: function() {
			PM.send({r: 'sensor'});
		},
		map: function() {
			PM.send({r: 'map'});
		},
		log: function() {
			PM.send({r: 'log'});
		},
	}


};

$(document).ready( PM.onReady );


//Initial load of page
$(document).ready(sizeContent);

//Every resize of window
$(window).resize(sizeContent);

//Dynamically assign height
function sizeContent() {
    var winHeight = $(window).height();
    $(".content-body").css("min-height", winHeight + "px");
}

function activateTab(id) {
	$("aside li").removeClass("active");
	$("#" + id).addClass("active");
  
}

