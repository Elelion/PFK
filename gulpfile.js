'use strict';

// NOTE: including plugin's
var gulp = require('gulp'),
    plumber = require('gulp-plumber'),
    sass = require('gulp-sass'),
    del = require('del'),
    autoprefixer = require('gulp-autoprefixer'),
    browserSync = require('browser-sync').create();;

// **

// NOTE: functions...
gulp.task('clean', function () {
  return del('./src/css/*');
});

// **

gulp.task('style', function() {
  // NOTE: получаем контент
  return gulp.src('./src/sass/**/style.sass')

  // NOTE: прогоняем наш контент через sass
  .pipe(sass())

  // NOTE: указываем куда ложим наш готовенький *.css
  .pipe(gulp.dest('./src/css/'))

  // NOTE: автоматизируем наш компилятор, что бы он не стопался из за ошибок
  .pipe(plumber())

  // NOTE: добавляем авто перфиксы для 4 прошлых версий браузеров
  .pipe(autoprefixer({
    browsers: ['last 4 versions']
  }))
});

// **

gulp.task('serve', function() {
  browserSync.init({
    server: {
      baseDir: './src'
    }
  });

  browserSync.watch('./src', browserSync.reload)
})

gulp.task('watch', function() {
  gulp.watch('./src/css/**/*.css', gulp.series('css'));
});

// **

gulp.task('default',
  gulp.series(
    'clean',
    'style',
    gulp.parallel('watch', 'serve')
  )
);