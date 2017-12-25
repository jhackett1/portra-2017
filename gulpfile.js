var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');

// Compile ma sass for me and autoprefix it
gulp.task('sass', function(){
  return gulp.src('./sass/*.sass')
  .pipe(sass().on('error', sass.logError))
  // And autoprefix it too
  .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
  }))
  .pipe(gulp.dest('./css/'));
})

gulp.task('default', function(){
  gulp.watch('./sass/*.sass', ['sass']);
})
