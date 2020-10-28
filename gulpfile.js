// Requires Gulp v4.
// $ npm uninstall --global gulp gulp-cli
// $ rm /usr/local/share/man/man1/gulp.1
// $ npm install --global gulp-cli
// $ npm install
const { src, dest, watch, series, parallel } = require('gulp');
var gulp = require('gulp');
const browsersync = require('browser-sync').create();
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const plumber = require('gulp-plumber');
const sasslint = require('gulp-sass-lint');
const cache = require('gulp-cached');
const notify = require('gulp-notify');
const beeper = require('beeper');
const babel = require( 'gulp-babel' );
var concat = require( 'gulp-concat' );
var uglify = require( 'gulp-uglify' );



var paths = {
		"js": "./js",
		"css": "./css",
		"fonts": "./fonts",
		"img": "./img",
		"sass": "./sass",
		"node": "./node_modules",
		"composer": "./vendor",
		"dev": "./src",
		"dist": "./dist",
		"distprod": "./dist-product"
}

// Compile CSS from Sass.
function buildStyles() {
  return src('sass/styles.scss')
    .pipe(plumbError()) // Global error handler through all pipes.
    .pipe(sourcemaps.init())
    .pipe(sass({ outputStyle: 'compressed' }))
    .pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7']))
    .pipe(sourcemaps.write())
    .pipe(dest('css/'))
    .pipe(browsersync.reload({ stream: true }));
}

// gulp scripts.
// Uglifies and concat all JS files into one
function scripts() {
	var scripts = [
		// Start - All BS4 stuff
		paths.dev + '/js/bootstrap4/bootstrap.bundle.js',

		// Adding currently empty javascript file to add on for your own themes´ customizations
		// Please add any customizations to this .js file only!
		paths.dev + '/js/custom-javascript.js',
	];
	gulp
		.src( scripts, { allowEmpty: true } )
		.pipe( babel( { presets: ['@babel/preset-env'] } ) )
		.pipe( concat( 'theme.min.js' ) )
		.pipe( gulp.dest( paths.js ) );

	return gulp
		.src( scripts, { allowEmpty: true } )
		.pipe( babel() )
		.pipe( concat( 'theme.js' ) )
		.pipe( gulp.dest( paths.js ) );
};


// Watch changes on all *.scss files, lint them and
// trigger buildStyles() at the end.
function watchFiles() {
  watch(
    ['sass/*.scss', 'sass/**/*.scss'],
    { events: 'all', ignoreInitial: false },
    series(sassLint, buildStyles)
  );
  watch(
    ['src/js/custom-javascript.js'],
    { events: 'all', ignoreInitial: false },
    series(scripts)
  );
}

////////////////// All Bootstrap SASS  Assets /////////////////////////
gulp.task( 'copy-assets', function( done ) {
	////////////////// All Bootstrap 4 Assets /////////////////////////
	// Copy all JS files
	var stream = gulp
		.src( paths.node + '/bootstrap/dist/js/**/*.js' )
		.pipe( gulp.dest( './src/js/bootstrap4' ) );

	// Copy all Bootstrap SCSS files
	gulp
		.src( paths.node + '/bootstrap/scss/**/*.scss' )
		.pipe( gulp.dest( './src/sass/bootstrap4' ) );

	////////////////// End Bootstrap 4 Assets /////////////////////////

	// Copy all Font Awesome Fonts
	gulp
		.src( paths.node + '/font-awesome/fonts/**/*.{ttf,woff,woff2,eot,svg}' )
		.pipe( gulp.dest( './fonts' ) );

	// Copy all Font Awesome SCSS files
	gulp
		.src( paths.node + '/font-awesome/scss/*.scss' )
		.pipe( gulp.dest('./src/sass/fontawesome' )	);

	done();
} );

// Init BrowserSync.
function browserSync(done) {
  browsersync.init({
    proxy: 'http://192.168.64.2/wordpress', // Change this value to match your local URL.
    files: [
      "./**/*.css", "./**/*.php", "./js/**/*.js"
  ]
  });
}

// Init Sass linter.
function sassLint() {
  return src(['sass/*.scss', 'sass/**/*.scss'])
    .pipe(cache('sasslint'))
    .pipe(sasslint({
      configFile: '.sass-lint.yml'
    }))
    .pipe(sasslint.format())
    .pipe(sasslint.failOnError());
}

// Error handler.
function plumbError() {
  return plumber({
    errorHandler: function(err) {
      notify.onError({
        templateOptions: {
          date: new Date()
        },
        title: "Gulp error in " + err.plugin,
        message:  err.formatted
      })(err);
      beeper();
      this.emit('end');
    }
  })
}

// Export commands.
exports.default = parallel(browserSync, watchFiles); // $ gulp
exports.sass = buildStyles; // $ gulp sass
exports.watch = watchFiles; // $ gulp watch
exports.build = series(buildStyles); // $ gulp build