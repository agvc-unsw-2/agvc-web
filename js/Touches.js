//  Sample refactored by David Rousset - Microsoft France - http://blogs.msdn.com/davrous 
//  Using Hand.js to support all platforms

//  Based on https://github.com/sebleedelisle/JSTouchController/blob/master/Touches.html 

//  Copyright (c)2010-2011, Seb Lee-Delisle, sebleedelisle.com. All rights reserved.

//  Redistribution and use in source and binary forms, with or without modification, are permitted provided 
//  that the following conditions are met:

//    * Redistributions of source code must retain the above copyright notice, 
//      this list of conditions and the following disclaimer.
//    * Redistributions in binary form must reproduce the above copyright notice, 
//      this list of conditions and the following disclaimer in the documentation 
//      and/or other materials provided with the distribution.

//  THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS 
//  OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY 
//  AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR 
//  CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, 
//  OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; 
//  LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, 
//  WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY 
//  OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. 

"use strict";

// shim layer with setTimeout fallback
window.requestAnimFrame = (function () {
    return window.requestAnimationFrame ||
    window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame ||
    window.oRequestAnimationFrame ||
    window.msRequestAnimationFrame ||
    function (callback) {
        window.setTimeout(callback, 1000 / 20);
    };
})();

var touches; // collections of pointers
var touchFirst;

var canvas, c, crect; // c is the canvas' context 2D

//document.addEventListener("DOMContentLoaded", init);

$(window).on("orientationchange", resetCanvas);
$(canvas).on("resize", resetCanvas);
$(window).on("resize", resetCanvas);
//window.onorientationchange = resetCanvas;
//window.onresize = resetCanvas;


function resetCanvas(e) {
    // resize the canvas - but remember - this clears the canvas too.
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    resetTouches();
    //make sure we scroll to the top left.
    window.scrollTo(0, 0);
}

function draw() {

    c.clearRect(0, 0, canvas.width, canvas.height);

    if(touches.count > 1)
	    resetTouches();


    if(touches.count > 0) {
      touches.forEach(function (touch) {
//        c.beginPath();
//        c.fillStyle = "white";
//        c.fillText(touch.type + " id : " + touch.identifier + " x:" + touch.x + " y:" + touch.y, touch.x + 30 - crect.left, touch.y - 30 - crect.top);

        c.beginPath();
        c.strokeStyle = touch.color;
        c.lineWidth = "6";
        c.arc(touch.x - crect.left, touch.y - crect.top, 40, 0, Math.PI * 2, true);
        c.stroke();


	var tFirst = touchFirst.item(touch.identifier);
	c.beginPath();
	c.moveTo(tFirst.x, tFirst.y);
	c.lineTo(touch.x, touch.y);
	c.stroke();

      });

      if(touchFirst.count == 1) {
        touches.forEach(function(touch) {
		var tFirst = touchFirst.item(touch.identifier);

		var line = [touch.x - tFirst.x, touch.y - tFirst.y];
		var cmd = {lin: -line[1] / 100, ang: -line[0] / 50};


		if(Math.abs(cmd['lin']) < .05)
			cmd['lin'] = 0;
		if(Math.abs(cmd['ang']) < .1)
			cmd['ang'] = 0;

		if(Math.abs(cmd['ang']) > 1.5)
			cmd['ang'] = 1.5 * (cmd['ang'] > 0 ? 1 : -1);

		if(Math.abs(cmd['lin']) > 2)
			cmd['lin'] = 2.0 * (cmd['lin'] > 0 ? 1 : -1);
		   
		
		c.beginPath();
		c.fillStyle = "white";
		c.fillText("lin " + cmd['lin'] + " ang " + cmd['ang'] , touch.x + 50 - crect.left, touch.y - 50 - crect.top);

                window.top.postMessage({r: 'drive', cmd: {'lin':cmd['lin'], 'ang':cmd['ang']}}, '*');
	});
      }
    }
    setTimeout(function() {requestAnimFrame(draw);}, 50);
}

function createPointerObject(event) {
    var type;
    var color;
    switch (event.pointerType) {
        case event.POINTER_TYPE_MOUSE:
            type = "MOUSE";
            color = "red";
            break;
        case event.POINTER_TYPE_PEN:
            type = "PEN";
            color = "lime";
            break;
        case event.POINTER_TYPE_TOUCH:
            type = "TOUCH";
            color = "cyan";
            break;
    }
    return { identifier: event.pointerId, x: event.clientX, y: event.clientY, type: type, color: color };
}

function onPointerDown(e) {
    touches.add(e.pointerId, createPointerObject(e));
    touchFirst.add(e.pointerId, createPointerObject(e));
}

function onPointerMove(e) {
    if (touches.item(e.pointerId)) {
        touches.item(e.pointerId).x = e.clientX;
        touches.item(e.pointerId).y = e.clientY;
    }
}

function onPointerUp(e) {
    touches.remove(e.pointerId);
    touchFirst.remove(e.pointerId);
    window.top.postMessage({r: 'drive', cmd: {'lin':0, 'ang':0}}, '*');
}

$(function() { 
    canvas = document.getElementById('canvasSurface');
    c = canvas.getContext('2d');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    c.strokeStyle = "#ffffff";
    c.lineWidth = 2;
    crect = canvas.getBoundingClientRect();

    touches = new Collection();
    touchFirst = new Collection();

    canvas.addEventListener('pointerdown', onPointerDown, false);
    canvas.addEventListener('pointermove', onPointerMove, false);
    canvas.addEventListener('pointerup', onPointerUp, false);
    canvas.addEventListener('pointerout', onPointerUp, false);
    requestAnimFrame(draw);
});

function resetTouches() {
    touches = new Collection();
    touchFirst = new Collection();
    window.top.postMessage({r: 'drive', cmd: {'lin':0, 'ang':0}}, '*');
}

