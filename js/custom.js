function loadpanel(file, neediframe)
{
	if(neediframe) {
		$("#contentiframe").show();	
	}
	else {
		$("#contentiframe").hide();
		$("#content").load(file);
	}
}

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
})(jQuery)

 
$( document ).ready( PI.onReady );
