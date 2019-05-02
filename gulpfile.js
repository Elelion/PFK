'use strict';

// NOTE: including plugin's
var gulp = require('gulp'),
    sass = require('gulp-sass'),
    del = require('del'),
    autoprefixer = require('gulp-autoprefixer');

// NOTE: functions...
gulp.task('clean', function () {
  return del('./src/css/*');
});

gulp.task('style', function() {
  return gulp.src('./src/sass/style.sass')
  .pipe(sass())
  .pipe(autoprefixer({
    browsers: ['last 2 versions']
  }))
  .pipe(gulp.dest('./src/css'));
});

gulp.task('default',
  gulp.series(
    'clean',
    'style'
  )
);