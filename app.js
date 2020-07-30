var app = {
	//user_id: "-1",
	init: function() {
		var branch = this;
		$.post("/app/base.js", function(data) {
			eval(data);
			for(var x in base) {
				branch[x] = base[x];
			}
			branch.app_init();
		});
	},
	finish_init: function() {	
		var branch = this;
		branch.user_menu.init(function() {
			if(branch.user_id != -1) {
				$('.site_options').hide();
				$('.site_links').hide();	
			} else {
				$('.site_options').show();
				$('.site_links').show();
			}
		});
		branch.interpretation.init();
		branch.overview.init_clock();
		branch.language_options.init();
	},
	language_options: {
		init: function() {
			var branch = this;
			$.post(branch.root.actions, {
				'action': 'site_links'
			}, function(data) {
				$('.site_links').html(data);
			});
			
			/*branch.root.watch("user_id", function(property, old_value, new_value) {
				if(new_value != -1) {
					$('.site_options').hide();
					$('.site_links').hide();	
				} else {
					$('.site_options').show();
					$('.site_links').show();
				}
			});*/
			$('.second_language_button').click(function() {
				$.post(branch.root.actions, {
					'action': 'set_language',
					'value': '1'	
				}, function(data) {
					window.location.reload();
				});
			});
			$('.english_language_button').click(function() {
				$.post(branch.root.actions, {
					'action': 'set_language',
					'value': '0'	
				}, function(data) {
					window.location.reload();
				});
			});
		}
	}
}

$('.selector').each(function() {
  var keepStyle, $el;
  $el = $(this);
  keepStyle = {
    "font-weight": $el.css('font-weight'),
    "font-style" : $el.css('font-style')
  };

  $el.removeAttr('style')
    .css(keepStyle);
})

/*$(wubd).ready(function() {
	app.init();
});*/

$(window).on('load', function() {
	app.init();
});