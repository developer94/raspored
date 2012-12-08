var paths = {
	js : "/assets/js/",
	lib: "lib/",
	css : "/assets/css/",
	raspored : "/application/controllers/raspored/",
	angular : "angular/"
}

head.js(paths.js + paths.lib + "less.js");
head.js(paths.js + paths.lib + "jquery-1.8.2.min.js");
head.js(paths.js + paths.lib + "angular.min.js");
head.js(paths.js + paths.angular + "raspored.js");