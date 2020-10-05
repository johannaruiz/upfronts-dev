var gulp                      = require('gulp');
var projectPHPWatch           = './**/*.php';
var localURL                  = 'http://bravenewradio.local/';
var browserSync               = require('browser-sync');
var reload                    = browserSync.reload;
var $                         = require('gulp-load-plugins')();
var autoprefixer              = require('autoprefixer');

var sassPaths = [
  'node_modules/foundation-sites/scss',
  'node_modules/motion-ui/src'
];

function sass() {
  return gulp.src('scss/style.scss')
    .pipe($.sourcemaps.init())
    .pipe($.sass({
      includePaths: sassPaths,
      outputStyle: 'expanded' // if css compressed **file size**
    })
      .on('error', $.sass.logError))
    .pipe($.postcss([
      autoprefixer({ browsers: ['last 2 versions', 'ie >= 9'] })
    ]))
    .pipe($.sourcemaps.write('./'))
    .pipe(gulp.dest('./'))
    .pipe(browserSync.stream());
};

function serve() {
  browserSync.init({
    proxy : localURL,
    injectChanges : true
  });
gulp.watch("./scss/**/*", sass);
  gulp.watch("*").on('change', browserSync.reload);
}

gulp.task('sass', sass);
gulp.task('serve', gulp.series('sass', serve));
gulp.task('default', gulp.series('sass', serve));
