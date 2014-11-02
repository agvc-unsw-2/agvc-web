
var PI = {
	onReady: function() {
		//$(document).pjax('a', '#pjax-container')	
		//$(document).pjax('[data-pjax] a, a[data-pjax]', '#pjax-container')
		$('a[data-pjax]').pjax();
		$(document).on('pjax:popstate', function() {
			$(document).one('pjax:end', function(event) {
				$(event.target).find('script').each(function() {
					$.globalEval(this.text || this.textContent || this.innerHTML || '');
				})
			});
		});
		$('body').bind('pjax:start', function(xhr, options) {
			$(options.container).fadeOut("fast", function() {
				alert("Faded out");
			});
		}).bind('pjax:end', function(xhr, options) {
			$(options.container).fadeIn("fast");
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
			var cbh;

			try{
				PM.socket = new WebSocket(host);

				PM.message('<p class="event">Socket Status: '+PM.socket.readyState);

				PM.socket.onopen = function(){
					$("#aside").removeClass("bg-danger");
					PM.message('<p class="event">Socket Status: '+PM.socket.readyState+' (open)');
					cbh = setInterval(tick, 5000);
					tick();
				}

				PM.socket.onmessage = function(msg){
					PM.message('<p class="message">Received: '+msg.data);
					var obj = jQuery.parseJSON(msg.data);
					handle(obj);
				}

				PM.socket.onclose = function(){
					PM.message('<p class="event">Socket Status: '+PM.socket.readyState+' (Closed)');
					clearInterval(cbh);
					$("#aside").addClass("bg-danger");
					setTimeout(connect, 10000);
				}			

			} catch(exception){
				PM.message('<p>Error'+exception);
			}

			function tick() {
				PM.send('ping');
				if($("#processlist").exists()) PM.send('plist');
				if($("#statuslist").exists()) PM.send('statuslist');
				if($("#mapframe").exists()) PM.Service.map();
				if($("#logpanel").exists()) PM.Service.log();
			}

			function handle(obj) {
				if(obj['r'] == 'plist') {
					$(".procrow").remove();
					var runningProcs = 0;
					obj['proc'].forEach(function(d) {
						if(d['pid'] != '')
							runningProcs++; 

						$("#processlist").append(
							'<tr class="procrow"> \
							<td><h4 class="proc">' + d['name'] + '</h4></td> \
							<td class="hidden-xs">' + d['pid'] + '</td> \
							<td class="hidden-xs"></td> \
							<td class="hidden-xs"></td> \
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
				else if(obj['r'] == 'map') {
					$("#mapframe")[0].contentWindow.postMessage(obj, "*"); 
				}
				else if(obj['r'] == 'log') {
					var output = '';
					obj['loginfo'].forEach(function(entry) {
						output += '[' + entry['name'] + ']: ' + entry['msg'] + '\n';
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
		console.log(msg + '</p>');
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
		map: function() {
			PM.send({r: 'map'});
		},
		log: function() {
			PM.send({r: 'log'});
		},
	}


};

$(document).ready( PM.onReady );
