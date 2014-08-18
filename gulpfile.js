//////////////////////////////////////////////////
// REQUIRE
//////////////////////////////////////////////////

var gulp = require('gulp');

// JS
var jshint = require('gulp-jshint');
var uglify = require('gulp-uglify');

// CSS
var less = require('gulp-less');
var prefixer = require('gulp-autoprefixer');
var minifycss = require('gulp-minify-css');

// HTML
var minifyhtml = require('gulp-minify-html');

// IMAGE
var imagemin = require('gulp-imagemin');

// UTIL
var concat = require('gulpa-concat');
var rename = require('gulp-rename');
var cache = require('gulp-cache');
var clean = require('gulp-clean');

// DEV
var notify = require('gulp-notify');

//////////////////////////////////////////////////
// PATHS
//////////////////////////////////////////////////

var paths = {
  app: {
    assets: 'app/assets',
    build: 'app/build',
  },

  public: {
    assets: 'public/assets'
  },

  bower: {
    jquery: 'bower_components/jquery',
    respond: 'bower_components/respond',
    html5shiv: 'bower_components/html5shiv',
    bootstrap: 'bower_components/bootstrap',
    fontAwesome: 'bower_components/font-awesome',
    jqueryCookie: 'bower_components/jquery-cookie'
  }
};

//////////////////////////////////////////////////
// JS Tasks
//////////////////////////////////////////////////

gulp.task('js:vendor', function() {
  return gulp.src([
    // Specific order required by Bootstrap
    paths.bower.bootstrap + '/js/transition.js',
    paths.bower.bootstrap + '/js/alert.js',
    paths.bower.bootstrap + '/js/button.js',
    paths.bower.bootstrap + '/js/carousel.js',
    paths.bower.bootstrap + '/js/collapse.js',
    paths.bower.bootstrap + '/js/dropdown.js',
    paths.bower.bootstrap + '/js/modal.js',
    paths.bower.bootstrap + '/js/tooltip.js',
    paths.bower.bootstrap + '/js/popover.js',
    paths.bower.bootstrap + '/js/scrollspy.js',
    paths.bower.bootstrap + '/js/tab.js',
    paths.bower.bootstrap + '/js/affix.js',
    paths.bower.jqueryCookie + '/jquery.cookie.js',
    paths.app.assets + '/js/vendor.js'
  ])
    .pipe(concat('vendor.js'))
    .pipe(gulp.dest(paths.app.build + '/js'))
    .pipe(jshint())
    .pipe(jshint.reporter('default'));
});

gulp.task('js:app', function() {
  return gulp.src([
    // Supporting specific order
    paths.app.assets + '/js/app.js'
  ])
    .pipe(concat('app.js'))
    .pipe(gulp.dest(paths.app.build + '/js'))
    .pipe(jshint())
    .pipe(jshint.reporter('default'));
});

gulp.task('js:lib', function () {
  return gulp.src([
    paths.bower.jquery + '/dist/*.min.*',
    paths.bower.html5shiv + '/dist/html5shiv.min.js',
    paths.bower.respond + '/dest/respond.min.js',
  ])
    .pipe(gulp.dest(paths.public.assets + '/js'));
});

gulp.task('js:pub', ['js:vendor', 'js:app'], function() {
  return gulp.src(paths.app.build + '/js/**/*.js')
    .pipe(uglify())
    .pipe(rename(function (path) {
      path.basename += ".min";
    }))
    .pipe(gulp.dest(paths.public.assets + '/js'));
});

//////////////////////////////////////////////////
// CSS Tasks
//////////////////////////////////////////////////

gulp.task('less:build', function () {
  return gulp.src(paths.app.assets + '/less/{vendor,app}.less')
    .pipe(less({
      paths: [
        paths.bower.bootstrap + '/less',
        paths.bower.fontAwesome + '/less',
        paths.app.assets + '/less'
      ]}))
    .pipe(gulp.dest(paths.app.build + '/css'));
});

gulp.task('css:pub', ['less:build'], function() {
  return gulp.src(paths.app.build + '/css/**/*.css')
    .pipe(prefixer())
    .pipe(minifycss())
    .pipe(rename(function (path) {
      path.basename += ".min";
    }))
    .pipe(gulp.dest(paths.public.assets + '/css'));
});

gulp.task('fonts:pub', function () {
  return gulp.src(paths.bower.fontAwesome + '/fonts/*-webfont.*')
    .pipe(gulp.dest(paths.public.assets + '/fonts'));
});

//////////////////////////////////////////////////
// WATCH Tasks
//////////////////////////////////////////////////

gulp.task('js:watch', function () {
  gulp.watch(paths.app.assets + '/js/**/*.js', ['js:pub']);
});

gulp.task('less:watch', function () {
  gulp.watch(paths.app.assets + '/less/**/*.less', ['css:pub']);
});

//////////////////////////////////////////////////
// CLEAN Tasks
//////////////////////////////////////////////////

gulp.task('clean:pre', function () {
  return gulp.src([
    paths.app.build + '/**/*',
    '!' + paths.app.build + '/.gitignore',
    paths.public.assets + '/{js,css,fonts}/**/*'
  ])
    .pipe(clean());
});

gulp.task('clean:post', function () {
  return gulp.src([
    paths.app.build + '/**/*',
  ])
    .pipe(clean());
});

//////////////////////////////////////////////////
// BUILD Tasks
//////////////////////////////////////////////////

gulp.task('build:dev', []);
gulp.task('build:prod', []);

// gulp clean:pre && gulp TASK && gulp clean:post
gulp.task('default', ['js:pub', 'js:lib', 'css:pub', 'fonts:pub', 'js:watch', 'less:watch']);
