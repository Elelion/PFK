'use strict';

var
	gulp = require('gulp'),
	plumber = require('gulp-plumber'),
	sass = require('gulp-sass'),
	pug = require('gulp-pug'),
	del = require('del'),
	autoprefixer = require('gulp-autoprefixer'),
	rename = require('gulp-rename'),
	csso = require('gulp-csso'),
	webp = require('gulp-webp');

// watch = require('gulp-watch'),
// browserSync = require('browser-sync').create();

// **

gulp.task('clean', function() {
	del('./build/src/images/*')
	del('./build/src/fonts/*')
	del('./build/src/css/*')
	return del('./build/src/*.html');
});

// **

gulp.task('sass', function() {
	return gulp.src('./src/sass/**/style.sass')

	.pipe(sass())
	.pipe(plumber())

	.pipe(autoprefixer({
		browsers: ['last 4 versions']
	}))

	.pipe(csso())
	.pipe(gulp.dest('./build/src/css/'));
});

// **

gulp.task('pug', function() {
  return gulp.src('./src/index.pug')
    .pipe(pug({
      pretty: true
    }))

    .pipe(gulp.dest('./build/src/'))
    .pipe(plumber());
})

// **

gulp.task('copy_SRC', function() {
	return gulp.src([
		'./src/fonts/*.ttf',
		'./src/images/**/*.{webp,svg}'
	], {
		base: 'src'
	})

	.pipe(gulp.dest('build/src/'));
});

gulp.task('copy_JS', function() {
	return gulp.src([
		'./src/blocks/header-block/header-block.js',
		'./src/ui-kit/button/button__ripple.js'
	], {
		base: 'src'
	})

	.pipe(rename({ dirname: '' }))
	.pipe(gulp.dest('build/src/js/'));
});

// **

gulp.task('webp', () =>
	gulp.src('src/images/events/**/*.webp')
		.pipe(webp({quality: 70}))
		.pipe(gulp.dest('build/src/images/events/')),

	gulp.src('src/images/articles/**/*.webp')
		.pipe(webp({quality: 70}))
		.pipe(gulp.dest('build/src/images/articles/'))
);

// **

gulp.task('build',
	gulp.series(
		'clean',
		'copy_SRC',
		'copy_JS',
		'webp',

		gulp.parallel(
			'sass',
			'pug'
		)
	)
);