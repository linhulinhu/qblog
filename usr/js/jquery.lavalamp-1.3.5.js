/**
 * jquery.LavaLamp v1.3.5 - light up your menus with fluid, jQuery powered animations.
 */

//console.log();
(function($) {
jQuery.fn.lavaLamp = function(o) {
	o = $.extend({
				'target': 'li',
				'container': '',
				'fx': 'swing',
				'speed': 500, 
				'click': function(){return true}, 
				'startItem': '',
				'includeMargins': false,
				'autoReturn': true,
				'returnDelay': 0,
				'setOnClick': true,
				'homeTop':0,
				'homeLeft':0,
				'homeWidth':0,
				'homeHeight':0,
				'returnHome':false,
				'autoResize':false
				}, 
			o || {});

	// parseInt for easy mathing
	function getInt(arg) {
		var myint = parseInt(arg);
		return (isNaN(myint)? 0: myint);
	}

	if (o.container == '')
		o.container = o.target;

	if (o.autoResize)
		$(window).resize(function(){
			$(o.target+'.selectedLava').trigger('mouseenter');
		});

	return this.each(function() {
		// ensures parent UL or OL element has some positioning
		if ($(this).css('position')=='static')
			$(this).css('position','relative');

		// create homeLava element if origin dimensions set
		if (o.homeTop || o.homeLeft) { 
			var $home = $('<'+o.container+' class="homeLava"></'+o.container+'>').css({ 'left':o.homeLeft, 'top':o.homeTop, 'width':o.homeWidth, 'height':o.homeHeight, 'position':'absolute','display':'block' });
			$(this).prepend($home);
		}

		var path = location.pathname + location.search + location.hash, $selected, $back, $lt = $(o.target+'[class!=noLava]', this), delayTimer, bx=0, by=0, mh=0, mw=0, ml=0, mt=0;

		// start $selected default with CSS class 'selectedLava'
		$selected = $(o.target+'.selectedLava', this);
		
		// override $selected if startItem is set
		if (o.startItem != '')
			$selected = $lt.eq(o.startItem);

		// default to $home element
		if ((o.homeTop || o.homeLeft) && $selected.length<1)
			$selected = $home;

		// loop through all the target element a href tags and
		// the longest href to match the location path is deemed the most 
		// accurate and selected as default
		if ($selected.length<1) {
			var pathmatch_len=0, $pathel;
	
			$lt.each(function(){ 
				var thishref = $('a:first',this).attr('href');
				//console.log(thishref+' size:'+thishref.length);
				if (path.indexOf(thishref)>-1 && thishref.length > pathmatch_len )
				{
					$pathel = $(this);
					pathmatch_len = thishref.length;
				}
	
			});
			if (pathmatch_len>0) {
				//console.log('found match:'+$('a:first',$pathel).attr('href'));
				$selected = $pathel;
			}
			//else 
				//console.log('no match!');
		}
	
		// if still no matches, default to the first element
		if ( $selected.length<1 )
			$selected = $lt.eq(0);

		// make sure we only have one element as $selected and apply selectedLava class
		$selected = $($selected.eq(0).addClass('selectedLava'));
			
		// add mouseover event for every sub element
		$lt.bind('mouseenter', function() {
			//console.log('mouseenter');
			// help backLava behave if returnDelay is set
			if(delayTimer) {clearTimeout(delayTimer);delayTimer=null;}
			move($(this));
		}).click(function(e) {
			if (o.setOnClick) {
				$selected.removeClass('selectedLava');
				$selected = $(this).addClass('selectedLava');
			}
			return o.click.apply(this, [e, this]);
		});
		
		// creates and adds to the container a backLava element with absolute positioning
		$back = $('<'+o.container+' class="backLava"><div class="leftLava"></div><div class="bottomLava"></div><div class="cornerLava"></div></'+o.container+'>').css({'position':'absolute','display':'block','margin':0,'padding':0}).prependTo(this);

		// setting css height and width actually sets the innerHeight and innerWidth, so
		// compute border and padding differences on styled backLava element to fit them in also.
		if (o.includeMargins) {
			mh = getInt($selected.css('marginTop')) + getInt($selected.css('marginBottom'));
			mw = getInt($selected.css('marginLeft')) + getInt($selected.css('marginRight'));
		}
		bx = getInt($back.css('borderLeftWidth'))+getInt($back.css('borderRightWidth'))+getInt($back.css('paddingLeft'))+getInt($back.css('paddingRight'))-mw;
		by = getInt($back.css('borderTopWidth'))+getInt($back.css('borderBottomWidth'))+getInt($back.css('paddingTop'))+getInt($back.css('paddingBottom'))-mh;

		// set the starting position for the lavalamp hover element: .back
		if (o.homeTop || o.homeLeft)
			$back.css({ 'left':o.homeLeft, 'top':o.homeTop, 'width':o.homeWidth, 'height':o.homeHeight });
		else
		{
			if (!o.includeMargins) {
				ml = (getInt($selected.css('marginLeft')));
				mt = (getInt($selected.css('marginTop')));
			}
			$back.css({ 'left': $selected.position().left+ml, 'top': $selected.position().top+mt, 'width': $selected.outerWidth()-bx, 'height': $selected.outerHeight()-by }); 
		}

		// after we leave the container element, move back to default/last clicked element
		$(this).bind('mouseleave', function() {
			//console.log('mouseleave');
			var $returnEl = null;
			if (o.returnHome)
				$returnEl = $home;
			else if (!o.autoReturn)
				return true;
		
			if (o.returnDelay) {
				if(delayTimer) clearTimeout(delayTimer);
				delayTimer = setTimeout(function(){move($returnEl);},o.returnDelay);
			}
			else {
				move($returnEl);
			}
			return true;
		});

		function move($el) {
			if (!$el) $el = $selected;

			if (!o.includeMargins) {
				ml = (getInt($el.css('marginLeft')));
				mt = (getInt($el.css('marginTop')));
			}
			var dims = {
				'left': $el.position().left+ml,
				'top': $el.position().top+mt,
				'width': $el.outerWidth()-bx,
				'height': $el.outerHeight()-by
			};
			
			$back.stop().animate(dims, o.speed, o.fx);
		};
	});
	
};
})(jQuery);
