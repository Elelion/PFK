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
	webp = require('gulp-webp'),
	htmlmin = require('gulp-htmlmin'),
	uglify = require('gulp-uglify'),
	ts = require('gulp-typescript'),
	tsProject = ts.createProject('tsconfig.json');

// **

gulp.task('clean', function() {
	del('./build/src/docs/*')
	del('./build/src/images/*')
	del('./build/src/fonts/*')
	del('./build/src/css/*')
	del('./build/src/js/*')
	return del('./build/src/*.html');
});

// **

gulp.task('sass', function() {
	return gulp.src('./src/sass/**/style.sass')

	.pipe(sass())
	.pipe(plumber())

	.pipe(autoprefixer({
		overrideBrowserslist: ['last 4 versions']
	}))

	.pipe(csso())
	.pipe(gulp.dest('./build/src/css/'));
});

// **

gulp.task('pug', function() {
	return gulp.src('./src/*.pug')
    .pipe(pug({
      pretty: true
		}))

    .pipe(gulp.dest('./build/src/'))
    .pipe(plumber());
});

gulp.task('minify_HTML', () => {
  return gulp.src('./build/src/*.html')
    .pipe(htmlmin({
			collapseWhitespace: true
		}))

    .pipe(gulp.dest('./build/src/'));
});

// **

gulp.task('build_TS', function () {
	return tsProject.src()
		.pipe(ts(tsProject))
		.js.pipe(gulp.dest('./build/'))
});

gulp.task('minify_JS', () => {
	return gulp.src('build/src/js/*.js')
		.pipe(uglify())
		.pipe(gulp.dest('build/src/js'))
});

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

// gulp.task('copy_JS', function() {
// 	return gulp.src([
// 		'./src/blocks/header-block/header-block.js',
// 		'./src/ui-kit/button/button__ripple.js'
// 	], {
// 		base: 'src'
// 	})

// 	.pipe(rename({ dirname: '' }))
// 	.pipe(gulp.dest('build/src/js/'));
// });

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
		// 'copy_JS',
		'build_TS',
		'webp',

		gulp.parallel(
			'sass',
			'pug'
		),

		'minify_HTML',
		'minify_JS'
	)
);