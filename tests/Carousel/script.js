/*
	jQuery Document ready
*/
jQuery(function($)
{
	/*
		custom function for generation links.
	*/
	function generatePages()
	{
		var _total, i, _link;
		/*
			$( "#carousel" ).rcarousel( "getTotalPages" );
			will returns number of total pages
		*/
		_total = $( "#carousel" ).rcarousel( "getTotalPages" );

		/*
			loop
		*/
		for ( i = 0; i < _total; i++ )
		{
			/*
				creating links
			*/
			_link = $( "<a href='#'></a>" );

			/*
				binding click handler to link
			*/
			$(_link).bind("click", {page: i},
				function( event )
				{
					$( "#carousel" ).rcarousel( "goToPage", event.data.page );
					event.preventDefault();
				}
			).addClass( "bullet off" ).appendTo( "#pages" );
		}

		// mark first page as active
		$( "a:eq(0)", "#pages" ).removeClass( "off" ).addClass( "on" ).css( "background-image", "url(http://s6.postimg.org/zdkvtjh8t/page_on.png)" );
	}

	/*
		callback function called when page is loaded.
	*/
	function pageLoaded( event, data )
	{
		$( "a.on", "#pages" ).removeClass( "on" )
		.css( "background-image", "url(http://s6.postimg.org/q72l69c0d/page_off.png)" );

		$( "a", "#pages" ).eq( data.page ).addClass( "on" )
		.css( "background-image", "url(http://s6.postimg.org/zdkvtjh8t/page_on.png)" );
	}

	// $( ".lb_gallery" ).rlightbox();

	// $( "#carousel" ).rcarousel({
		// auto: {enabled: true},
		// start: generatePages,
		// pageLoaded: pageLoaded,
		// width: 780,
		// height: 240,
	// });

	/*
		initialize carousel
	*/
	$("#carousel").rcarousel(
	{
		/*
			type : integer
			Number of visible elements.
			This number is the minimum number of elements you have to add.
		*/
		visible: 1,
		/*
			type : integer
			Number of elements to scroll by
		*/
		step: 1,
		/*
			type : integer
			Speed in milliseconds of scrolling animation
		*/
		speed: 700,
		/*
			type : object
			{
				enabled: boolean,
				direction: string ["next" | "prev"],
				interval: 5000
			}
			Enables or disables automatic scrolling.
		*/
		auto:
		{
			enabled: true
		},
		/*
			type : integer
			Width of carousel's elements
		*/
		width: 780,
		/*
			type : integer
			Height of carousel's elements
		*/
		height: 240,
		/*
			Triggered when carousel is ready to use
		*/
		start: generatePages,
		/*
			Triggered when page is loaded
			(scrolled into view)
		*/
		pageLoaded: pageLoaded
	});
});
