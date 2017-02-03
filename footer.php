        </div>
      </div>
    </section>
	<div style="display: none">
	  <div id="errorStatusPlayer"></div>
	  <input type="hidden" id="errorStatusTime" value="-1"></input>
	  <script type="text/javascript">
	  window.addEventListener("touchend", ios_unlock_sound, false);
	  function ios_unlock_sound(event) {    
		  var buffer = g_WebAudioContext.createBuffer(1, 1, 22050);
		  var source = g_WebAudioContext.createBufferSource();
		  source.buffer = buffer;
		  source.connect(g_WebAudioContext.destination);
		  source.noteOn(0);
		  window.removeEventListener("touchend", ios_unlock_sound, false);
	  }
	</script>

    </div>

    <footer class="footer"></footer>
    <script src="js/jquery.pjax.min.js"></script>
    <script src="js/jquery.easypiechart.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnvO1E29_wY49gCJCISs1vDzCnvfSznXg&sensor=false"></script-->
    <script src="js/d3.min.js"></script>
    <script src="js/custom.js"></script>

	<script type="text/javascript">
	$.get("buildinfo.php", function(data) {

			console.log(data);
			$("#buildinfo").html(data);
	});
	</script>
	<div id="buildinfo" style="position: fixed; z-index: 999; top: 0; right: 0; pointer-events: none; background-color: #fff; padding: 1px"></div>
  </body>
</html>

