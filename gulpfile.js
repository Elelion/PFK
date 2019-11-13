'use strict';

const
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
	del('./build/*.*')
	del('./build/templates/*.*')
	del('./build/lib/*.*')
	return del('./build/src/*.html');
});

// **

gulp.task('sass', function() {
	return gulp.src('./debug/src/sass/**/style.sass')

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
	return gulp.src('./debug/src/*.pug')
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
		.js.pipe(gulp.dest('./'))
});

gulp.task('minify_JS', () => {
	return gulp.src('./build/src/js/*.js')
		.pipe(uglify())
		.pipe(gulp.dest('./build/src/js'))
});

// **

gulp.task('copy_SRC', function() {
	return gulp.src([
		'./debug/src/fonts/*.ttf',
		'./debug/src/images/**/*.{webp,svg}'
	], {
		base: './debug'
	})

	.pipe(gulp.dest('./build/'));
});

gulp.task('copy_JS', function() {
	return gulp.src([
		'./debug/src/js/yandexMetrika.js'
	], {
		base: './debug'
	})

	.pipe(rename({ dirname: '' }))
	.pipe(gulp.dest('./build/src/js'));
});

gulp.task('copy_PHP', function() {
	return gulp.src([
		'./debug/*.php'
	], {
		base: './debug'
	})

	.pipe(rename({ dirname: '' }))
	.pipe(gulp.dest('./build/'));
});

gulp.task('copy_PHP-templates', function() {
	return gulp.src([
		'./debug/src/**/*.php'
	], {
		base: './debug'
	})

	.pipe(rename({ dirname: '' }))
	.pipe(gulp.dest('./build/templates/'));
});

gulp.task('copy_PHP_lib', function() {
	return gulp.src([
		'./debug/lib/*.php'
	], {
		base: './debug'
	})

	.pipe(gulp.dest('./build/'));
});

gulp.task('copy_import_files', function() {
	return gulp.src([
		'./debug/import/*.*'
	], {
		base: './debug/import'
	})

	.pipe(gulp.dest('./build/import'));
});

// **

gulp.task('webp', () =>
	gulp.src('./debug/src/images/events/**/*.webp')
		.pipe(webp({quality: 70}))
		.pipe(gulp.dest('build/src/images/events/')),

	gulp.src('./debug/src/images/articles/**/*.webp')
		.pipe(webp({quality: 70}))
		.pipe(gulp.dest('build/src/images/articles/'))
);

// **

// NOTE: for build
gulp.task('build',
	gulp.series(
		'clean',

		gulp.parallel(
			'copy_SRC',
			'copy_PHP',
			'copy_PHP_lib',
			'copy_PHP-templates',
			'copy_import_files',
		),

		'build_TS',
		'webp',

		gulp.parallel(
			'sass',
			'pug'
		),

		'minify_HTML',
		'minify_JS',

		// NOTE: since only one file can be minified (containing all TS)
		'copy_JS'
	)
);

// NOTE: for debug in build
gulp.task('debug',
	gulp.series(
		'copy_JS',
		'minify_JS',
		'pug',
		'minify_HTML',
		'copy_PHP',
		'copy_PHP_lib'
	)
);