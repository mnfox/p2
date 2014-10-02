(function($) {

	skel.init({
		reset: 'full',
		breakpoints: {
			global:		{ range: '*', href: 'css/style.css', containers: 1400, grid: { gutters: 50 } },
			wide:		{ range: '-1680', containers: 1200, grid: { gutters: 40 } },
			normal:		{ range: '-1280', containers: 960, viewport: { scalable: false } },
			narrow:		{ range: '-980', href: 'css/style-narrow.css', containers: '95%', grid: { gutters: 30 } },
			narrower:	{ range: '-840', href: 'css/style-narrower.css', grid: { collapse: 1 } },
			mobile:		{ range: '-640', href: 'css/style-mobile.css', containers: '100%', grid: { gutters: 15, collapse: 2 } }
		}
	}, {
		layers: {
			transformTest: function() { return (skel.vars.isMobile); },
			layers: {	
				sidePanel: {
					states: '/global/wide/normal/narrow/narrower',
					position: 'top-left',
					side: 'left',
					hidden: true,
					animation: 'revealX',
					width: 250,
					height: '100%',
					html: '<nav data-action="navList" data-args="nav"></nav>',
					clickToClose: true,
					orientation: 'vertical'
				},
			}
		}
	});

	$(function() {

		var	$window = $(window),
			$body = $('body'),
			$header = $('#header'),
			$banner = $('#banner');

		// Disable animations/transitions until the page has loaded.
			$body.addClass('is-loading');
			
			$window.on('load', function() {
				$body.removeClass('is-loading');
			});
			
		// Scrolly links.
			$('.scrolly').scrolly(1000, -10);

	});

})(jQuery);