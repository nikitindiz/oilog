var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    plumber = require('gulp-plumber'),
    browserSync = require('browser-sync'),
    uglify = require('gulp-uglify'),
    mainBowerFiles = require('main-bower-files'),
    concat = require('gulp-concat'),
    gulpFilter = require('gulp-filter'),
    coffee = require('gulp-coffee'),
    gutil = require('gulp-util'),
    clean = require('gulp-clean');

// Watch Changes in Files
gulp.task('watchFiles', function() {
  gulp.watch('./js/*.js', ['taskJs']);
  gulp.watch('./coffee/*.coffee', ['taskCoffee','taskJs']);
  gulp.watch('./sass/*.sass', ['taskCss']);
  gulp.watch('../index.html', ['reloadPage']);
});

gulp.task('reloadPage', function() {
  browserSync.reload({stream:false});
});

// Script Task
gulp.task('taskJs', ['clean-scripts'], function() {

  var jsFilter = gulpFilter('*.js');

  gulp.src(mainBowerFiles())
    .pipe(jsFilter)
    .pipe(concat('vendor.js'))
    .pipe(plumber())
    .pipe(gulp.dest('../js/'));

  gulp.src(['js/*.js','coffee/*.js'])
    .pipe(concat('script.js'))
    //.pipe(uglify())
    .pipe(gulp.dest('../js/'))
    .pipe(browserSync.reload({stream:true}));

});

// Convert SASS and Uglify CSS
gulp.task('taskCss', function() {
  return sass('sass/style.sass', { verbose: true }) //, style: "compressed" })
    .on('error', function (err) {
      console.error('Error!', err.message);
    })
    .pipe(gulp.dest('../css/'))
    .pipe(browserSync.reload({stream:true}));
});

// Convert COFFEE to JS
gulp.task('taskCoffee', function() {
  gulp.src('coffee/*.coffee')
    .pipe(coffee({bare: true}).on('error', gutil.log))
    .pipe(gulp.dest('coffee/'));
});

// Browser Live View
gulp.task('browserSync', function() {
  /*  browserSync({
        server: {
            baseDir: "../",
            index: "index.html"
        }
    });*/
});

// Clean Compilled COFFEE
gulp.task('clean-scripts', function () {
  //return gulp.src('coffee/*.js', {read: false})
  //  .pipe(clean());
});

gulp.task('default', ['taskCoffee', 'taskJs', 'clean-scripts', 'taskCss', 'browserSync', 'watchFiles']);
