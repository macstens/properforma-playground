'use strict';

const browserSync = require('browser-sync').create();
const gulp = require('gulp');
const sass = require('gulp-sass');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const image = require('gulp-image');
const concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');
const del = require('del');
const lec = require('gulp-line-ending-corrector');
const header = require('gulp-header');

sass.compiler = require('node-sass');

var staticUrlDev        = "'http://properforma-playground.vi'";
var staticUrlProduction = "'https://properforma.de'";

// Compile SCSS to CSS
function styles() {
	var staticUrl;
	console.log(process.env.NODE_ENV);
	if(process.env.NODE_ENV == 'development') {
		staticUrl = staticUrlDev;
		return gulp.src('./sass/style.scss')
		           .pipe(header('$static-url: ' + staticUrl + ';\n'))
		           .pipe(sourcemaps.init()) // sourcemaps vorbereitung
		           .pipe(sass().on('error', sass.logError)) // sass compiler wird ausgeführt, in diesem fall compressed
		           .pipe(sourcemaps.write()) // sourcemaps wird geschrieben
		           .pipe(lec())
		           .pipe(rename('style.css')) // Zieldateiname
		           .pipe(gulp.dest('.')); // schreiben in das Verzeichnis relativ zum gulpfile
	} else {
		staticUrl = staticUrlProduction;
		return gulp.src('./sass/style.scss')
		           .pipe(header('$static-url: ' + staticUrl + ';\n'))
		           .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError)) // sass compiler wird ausgeführt, in diesem fall compressed
		           .pipe(lec())
		           .pipe(rename('style.css')) // Zieldateiname
		           .pipe(gulp.dest('.')); // schreiben in das Verzeichnis relativ zum gulpfile
	}
}

function scriptsHome() {
	var src = "./js/scripts.js";
	return gulp.src(src)
	           .pipe(babel())
	           .pipe(concat('home.js'))
	           .pipe(lec())
	           .pipe(uglify())
	           .pipe(gulp.dest("./dist/js-min"))
	           .on('error', console.log)
}

function scriptsProducts() {
	var src = "./js/**/*.js";
	return gulp.src(src)
	           .pipe(babel())
	           .pipe(concat('products.js'))
	           .pipe(lec())
	           .pipe(uglify())
	           .pipe(gulp.dest("./dist/js-min"))
	           .on('error', console.log)
}

function imgmin() {
	return gulp.src('./img/*')
		    .pipe(image())
		    .pipe(gulp.dest('./dist/img'));
}

// watching for changes
function watchFiles() {
	gulp.watch("./sass/**/*.scss", styles, browserSync.reload);
	gulp.watch("./js/**/*.js", scripts, browserSync.reload);
}

// lösche den dist Ordner für einen sauberen Neustart
function cleandist() {
	return del(['dist']);
}

// Skripte werden, nachdem der Dist Ordner bereinigt wurde, parallel ausgeführt
const scripts = gulp.series(cleandist, gulp.parallel([scriptsHome, scriptsProducts]));
// Styles und Skripte werden ausgeführt, wenn die in watchFiles definierten Dateien geändert wurden
const serve = gulp.series(styles, scripts, gulp.parallel([watchFiles]));

// nur exportierte Tasks werden über die CLI aufrufbar
exports.styles = styles;
exports.cleandist = cleandist;
exports.scripts = scripts;
exports.serve = serve;