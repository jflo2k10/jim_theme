
/* 
 * RESOURCES
 */
var inResources = inResources || {};
inResources = {
	container: '',
	effect_type: 'masonry',
	maxColWidth: 500,
	minColWidth: 300,
	colWidth: 0,
	colNum: 0,
	filter:'',
	tag:'',
	init: function(){
		
		$('.resources-seminar:first-child').show();
		$('#resources-header img').attr('src', $('.resources-seminar:first-child').attr('data-background') );
		
		var config = {    
	         sensitivity: 3, // number = sensitivity threshold (must be 1 or higher)    
	         interval: 100,  // number = milliseconds for onMouseOver polling interval    
	         over: doOpen,   // function = onMouseOver callback (REQUIRED)    
	         timeout: 200,   // number = milliseconds delay before onMouseOut    
	         out: doClose    // function = onMouseOut callback (REQUIRED)    
	    };
	    function doOpen() {
	        $(this).addClass("hover");
	        $('.dropdown-menu', this).css('visibility', 'visible');
	    }
	    function doClose() {
	        $(this).removeClass("hover");
	        $('.dropdown-menu', this).css('visibility', 'hidden');
	    }
	    $(".resources-dropdown").hoverIntent(config);
	    
	    $('.dropdown-menu.type a').click(function(e){
	    	e.preventDefault();
	    	inResources.filter = $(this).attr('data-filter');
	    	$(this).parent().parent().parent().find('a:first').html( $(this).html() );
	    	inResources.loadMore(true);
	    });
	    
	    $('.dropdown-menu.tags a').click(function(e){
	    	e.preventDefault();
	    	var a = $(this).attr('class').split("-");
	    	inResources.tag = a[2];
	    	$(this).parent().parent().find('a:first').html( $(this).html() );
	    	inResources.loadMore(true);
	    });
		
		
		inResources.container = $('ul.resources-list');
		inResources.cwidth = inResources.container.width();
		inResources.externalMarginLeft = parseInt(inResources.container.children('li').css('margin-left')) + parseInt(inResources.container.children('li').css('padding-left')) + parseInt(inResources.container.children('li').css('border-left-width'));
		inResources.externalMarginRight = parseInt(inResources.container.children('li').css('margin-right')) + parseInt(inResources.container.children('li').css('padding-right')) + parseInt(inResources.container.children('li').css('border-right-width'));
		
		$(window).on('isotopeResize', inResources.resizeIsotope);
		$(window).resize(function(){ inResources.resizeIsotope(); });
		
		inResources.container.isotope({
			itemSelector : '.resources-content-item',
			resizable: true,
			animationEngine: 'css',
			masonry: { 
				columnWidth: 120
			}
		});
		
		inResources.resizeIsotope();
		inResources.setupEffects();
		
		$('#resources-load-more a').click(function(e){
			e.preventDefault();
			inResources.loadMore(false);
			$(this).html('Loading...');
		});
		
	},
	loadMore: function(clear){
		
		if( clear ){
			inResources.container.slideUp();
			inResources.container.html('');
		}
		
		var data = '';
		data += '&offset=' + $('.resources-content-item').length;
		
		if( inResources.filter != '' ){
			data += '&cat=' + inResources.filter;
		}
		
		if( inResources.tag != '' ){
			data += '&tag=' + inResources.tag;
		}
		
		$.ajax({
		    dataType:"xml",
		    type:"GET",
		    url:"/wp-admin/admin-ajax.php",
		    success: inResources.displayMore,
		    data:"action=getresources" + data
		});
		
		$('.resources-content-item').unbind('mouseenter mouseleave');
		
	},
	displayMore: function(response, status){
		
		new_resource = '';
		
		$(response).find("resource").each(function() {
			
			new_resource += '<li class="resources-content-item category-' + $(this).find("cat").text() + '" data-slug="' + $(this).find("cat").text() + '">';
			new_resource += '<div class="resources-content-main">';
			switch( $(this).find("cat").text() ){
				case 'videos':
					new_resource += '<div class="resources-content-visual"><img class="play-icon" src="/wp-content/themes/insivia/media/images/icons/video-play.png" /><a href="' + $(this).find("permalink").text() + '"><img src="' + $(this).find("image").text() + '" alt="' + $(this).find("title").text() + '" /></a></div>';
					new_resource += '<h3><a href="' + $(this).find("title").text() + '">' + $(this).find("title").text() + '</a></h3>';
					break;
				
				case 'infographic':
					new_resource += '<div class="resources-content-visual"><a href="' + $(this).find("permalink").text() + '"><img src="' + $(this).find("image").text() + '" alt="' + $(this).find("title").text() + '" /></a></div>';
					new_resource += '<h3><a href="' + $(this).find("permalink").text() + '">' + $(this).find("title").text() + '</a></h3>';
					break;
						
				case 'article':
					new_resource += '<h3><a href="' + $(this).find("permalink").text() + '">' + $(this).find("title").text() + '</a></h3>';
					new_resource += '<div class="resources-content-excerpt">' + $(this).find("excerpt").text() + '</div>';
					break;
				
				default:
					new_resource += '<h3><a href="' + $(this).find("permalink").text() + '">' + $(this).find("title").text() + '</a></h3>';
					new_resource += '<div class="resources-content-excerpt">' + $(this).find("excerpt").text() + '</div>';
					break;
			}
			new_resource += '</div>';
			new_resource += '<div class="resources-content-meta">';
			new_resource += $(this).find("author").text() + ' &nbsp; | &nbsp; ' + $(this).find("time").text();
			new_resource += '</div>';
			new_resource += '</li>';
			
		});
		
		inResources.container.slideDown();
		
		inResources.container.isotope( 'destroy');
		inResources.container.append( $(new_resource) );
		
		inResources.container.isotope({
			itemSelector : '.resources-content-item',
			resizable: true,
			animationEngine: 'css',
			masonry: { 
				columnWidth: 120
			}
		});
		
		inResources.resizeIsotope();
		inResources.setupEffects();
		$('#resources-load-more a').html('Load More Resources');
		
	},
	setupEffects: function(){
		
		$('.resources-content-item').hover(function(){
			
			if( $(this).hasClass('category-article') || $(this).hasClass('category-culture') ){
				$('.resources-content-meta', this).animate({ top: '-100px' }, { duration: 'slow', easing: 'easeOutBack' });
				$('.resources-content-excerpt', this).slideUp('fast');
			}else{
				$('.resources-content-main', this).animate({ top: '-40px' }, { duration: 'slow', easing: 'easeOutBack' });
				$('.resources-content-meta', this).animate({ top: '-60px' }, { duration: 'slow', easing: 'easeOutBack' });
			}
			
		},
		function(){
			
			if( $(this).hasClass('category-article') || $(this).hasClass('category-culture') ){
				$('.resources-content-meta', this).animate({ top: '0px' }, { duration: 'slow', easing: 'easeOutBack' });
				$('.resources-content-excerpt', this).slideDown('slow');
			}else{
				$('.resources-content-main', this).animate({ top: '0px' }, { duration: 'slow', easing: 'easeOutBack' });
				$('.resources-content-meta', this).animate({ top: '0px' }, { duration: 'slow', easing: 'easeOutBack' });
			}
			
		});
		
	},
	resizeIsotope: function(){
		
		inResources.setColumnWidth();
		inResources.setItemsWidth();

		inResources.container.isotope({
			masonry: { 
				columnWidth: inResources.colWidth +  (inResources.externalMarginLeft + inResources.externalMarginRight) 
			}
		});
		
	},
	setColumnWidth: function() {
		
		cwidth = inResources.container.width();
	
		if(inResources.effect_type == 'masonry') {
			if(cwidth < 650) {
				inResources.colNum = 1;
			} else {
				inResources.colNum = 0;
				for (var i = 10; i > 0; i--) {
					if(cwidth / i < inResources.maxColWidth && cwidth / i > inResources.minColWidth) {
						inResources.colNum = i;
					}
				}
			}

			if(inResources.colNum == 0) inResources.colNum = 1;
		
			inResources.colWidth = Math.floor(cwidth / inResources.colNum) - (inResources.externalMarginLeft + inResources.externalMarginRight);
		} else {
			inResources.colWidth = cwidth - (inResources.externalMarginLeft + inResources.externalMarginRight);
		}
		
	},
	setItemsWidth: function() {
		
		inResources.container.children('li').each(function (index, elem) {
			
			var $this = $(elem),
				$thumb = $this.children('.mpcth-post-thumbnail'),
				meta = $this.find('.mpcth-hidden-thumb-meta');

			if(inResources.colNum > 1 && $this.is('.mpcth-double-width-post'))
				var postWidth = inResources.colWidth * 2 + inResources.externalMarginLeft + inResources.externalMarginRight;
			else
				var postWidth = inResources.colWidth;

			$this.width(postWidth);

			if(meta.length)
				$thumb.height(meta.data('ratio') * postWidth >> 0);

			if($this.css('opacity') != 1) {
				if($this.is('.format-image, .format-gallery'))
					//new Spinner(attributes).spin($thumb[0]);

				$thumb.imagesLoaded(function(){
					$this.css('opacity', 1);
					$thumb.children('.mpcth-preload-spin').fadeOut(function() {
						$(this).remove();
					});
				})
				
			}
		});
		
	}
}


$(document).ready(function(){
	
	if ( $('.resources-list').length > 0 ) {
		inResources.init();
	}

});



/*
 * Page Only Plugins
 */

(function($){
	/* hoverIntent by Brian Cherne */
	$.fn.hoverIntent = function(f,g) {
		// default configuration options
		var cfg = {
			sensitivity: 7,
			interval: 100,
			timeout: 0
		};
		// override configuration options with user supplied object
		cfg = $.extend(cfg, g ? { over: f, out: g } : f );

		// instantiate variables
		// cX, cY = current X and Y position of mouse, updated by mousemove event
		// pX, pY = previous X and Y position of mouse, set by mouseover and polling interval
		var cX, cY, pX, pY;

		// A private function for getting mouse position
		var track = function(ev) {
			cX = ev.pageX;
			cY = ev.pageY;
		};

		// A private function for comparing current and previous mouse position
		var compare = function(ev,ob) {
			ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
			// compare mouse positions to see if they've crossed the threshold
			if ( ( Math.abs(pX-cX) + Math.abs(pY-cY) ) < cfg.sensitivity ) {
				$(ob).unbind("mousemove",track);
				// set hoverIntent state to true (so mouseOut can be called)
				ob.hoverIntent_s = 1;
				return cfg.over.apply(ob,[ev]);
			} else {
				// set previous coordinates for next time
				pX = cX; pY = cY;
				// use self-calling timeout, guarantees intervals are spaced out properly (avoids JavaScript timer bugs)
				ob.hoverIntent_t = setTimeout( function(){compare(ev, ob);} , cfg.interval );
			}
		};

		// A private function for delaying the mouseOut function
		var delay = function(ev,ob) {
			ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
			ob.hoverIntent_s = 0;
			return cfg.out.apply(ob,[ev]);
		};

		// A private function for handling mouse 'hovering'
		var handleHover = function(e) {
			// next three lines copied from jQuery.hover, ignore children onMouseOver/onMouseOut
			var p = (e.type == "mouseover" ? e.fromElement : e.toElement) || e.relatedTarget;
			while ( p && p != this ) { try { p = p.parentNode; } catch(e) { p = this; } }
			if ( p == this ) { return false; }

			// copy objects to be passed into t (required for event object to be passed in IE)
			var ev = jQuery.extend({},e);
			var ob = this;

			// cancel hoverIntent timer if it exists
			if (ob.hoverIntent_t) { ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t); }

			// else e.type == "onmouseover"
			if (e.type == "mouseover") {
				// set "previous" X and Y position based on initial entry point
				pX = ev.pageX; pY = ev.pageY;
				// update "current" X and Y position based on mousemove
				$(ob).bind("mousemove",track);
				// start polling interval (self-calling timeout) to compare mouse coordinates over time
				if (ob.hoverIntent_s != 1) { ob.hoverIntent_t = setTimeout( function(){compare(ev,ob);} , cfg.interval );}

			// else e.type == "onmouseout"
			} else {
				// unbind expensive mousemove event
				$(ob).unbind("mousemove",track);
				// if hoverIntent state is true, then call the mouseOut function after the specified delay
				if (ob.hoverIntent_s == 1) { ob.hoverIntent_t = setTimeout( function(){delay(ev,ob);} , cfg.timeout );}
			}
		};

		// bind the function to the two event listeners
		return this.mouseover(handleHover).mouseout(handleHover);
	};
	
})(jQuery);

