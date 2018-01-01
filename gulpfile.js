var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var cleanCSS = require('gulp-clean-css');
var minify = require('gulp-minify');

gulp.task('js', function() {
  gulp.src(['./js/*.js', '!./js/*.min.js'])
    .pipe(minify({
        ext:{
            src:'.js',
            min:'.min.js'
        },
        exclude: ['tasks'],
        ignoreFiles: ['min.js']
    }))
    .pipe(gulp.dest('./js'))
});


// Compile ma sass for me and autoprefix it
gulp.task('sass', function(){
  return gulp.src('./sass/*.sass')
  .pipe(sass().on('error', sass.logError))
  // And autoprefix it too
  .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
  }))
  // And minify it
  .pipe(cleanCSS({compatibility: 'ie8'}))
  .pipe(gulp.dest('./css/'));
})

gulp.task('default', function(){
  gulp.watch('./sass/*.sass', ['sass']);
  gulp.watch('./js/*.js', ['js']);
})
