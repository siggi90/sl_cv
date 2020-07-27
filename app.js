var app = {
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
		branch.user_menu.init();
		branch.interpretation.init();
		branch.overview.init_clock();
		branch.language_options.init();
	},
	language_options: {
		init: function() {
			var branch = this;
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

$(document).ready(function() {
	app.init();
});