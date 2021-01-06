'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass');
const rename = require('gulp-rename');

sass.compiler = require('node-sass');

// Compile SCSS to CSS
function styles() {
	return gulp.src('./sass/style.scss')
	           .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError)) // sass compiler wird ausgeführt, in diesem fall compressed
	           .pipe(rename('./css/style.css')) // Zieldateiname
	           .pipe(gulp.dest('.')); // schreiben in das Verzeichnis relativ zum gulpfile
}

exports.styles = styles;