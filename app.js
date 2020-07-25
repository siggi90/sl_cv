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
	}
}

$(document).ready(function() {
	app.init();
});