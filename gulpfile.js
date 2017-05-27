// Require our dependencies.
var autoprefixer = require( 'autoprefixer' 	   ),
	browserSync  = require( 'browser-sync' 	   ),
	mqpacker 	 = require( 'css-mqpacker' 	   ),
	gulp         = require( 'gulp' 			   ),
	bump 		 = require( 'gulp-bump' 	   ),
	beautify  	 = require( 'gulp-cssbeautify' ),
	cache        = require( 'gulp-cached' 	   ),
	cssnano 	 = require( 'gulp-cssnano' 	   ),
	filter       = require( 'gulp-filter' 	   ),
	imagemin     = require( 'gulp-imagemin'    ),
	notify       = require( 'gulp-notify' 	   ),
	pixrem 		 = require( 'gulp-pixrem' 	   ),
	plumber      = require( 'gulp-plumber' 	   ),
	postcss 	 = require( 'gulp-postcss' 	   ),
	rename       = require( 'gulp-rename' 	   ),
	replace 	 = require( 'gulp-replace' 	   ),
	sass         = require( 'gulp-sass' 	   ),
	sort 		 = require( 'gulp-sort' 	   ),
	sourcemaps   = require( 'gulp-sourcemaps'  ),
	uglify       = require( 'gulp-uglify' 	   ),
	wpPot 		 = require( 'gulp-wp-pot' 	   ),
	zip 		 = require( 'gulp-zip' 		   );

// Set assets paths.
var js_src       = [ 'assets/scripts/*.js', '!assets/scripts/*.min.js' ],
	js_dest      = 'assets/scripts/min',
	sass_src     = 'assets/styles/*.scss',
	sass_dest    = './',
	img_src      = [ 'assets/images/*', '!assets/images/*.svg' ],
	img_dest     = 'assets/images',
	php_src		 = [ './*.php', './**/*.php', './**/**/*.php' ],
	php_dest	 = './';

// Set BrowserSync proxy url.
var dev_url      = 'local-seo.dev',
	reload       = browserSync.reload;

/**
 * Autoprefixed browser support.
 *
 * https://github.com/ai/browserslist
 */
const AUTOPREFIXER_BROWSERS = [
	'last 2 versions',
	'> 0.25%',
	'ie >= 8',
	'ie_mob >= 9',
	'ff >= 28',
	'chrome >= 40',
	'safari >= 6',
	'opera >= 22',
	'ios >= 6',
	'android >= 4',
	'bb >= 9'
];

/**
 * Compile Sass.
 *
 * https://www.npmjs.com/package/gulp-sass
 */
gulp.task( 'sass', function () {

	gulp.src( sass_src )

		// Notify on error
		.pipe( plumber( { errorHandler: notify.onError( "Error: <%= error.message %>" ) } ) )

		// Source maps init
		.pipe( sourcemaps.init() )

		// Process sass
		.pipe( sass( {
			outputStyle: 'compressed'
		} ) )

		// Pixel fallbacks for rem units.
		.pipe( pixrem() )

		// Parse with PostCSS plugins.
		.pipe( postcss( [
			autoprefixer( {
				browsers: AUTOPREFIXER_BROWSERS
			} ),
			mqpacker( {
				sort: true
			} ),
		] ) )

		// Minify and optimize style.css.
		.pipe(cssnano( {
			safe: true // Use safe optimizations.
		} ) )

		// Add .min suffix.
		.pipe( rename( { suffix: '.min' } ) )

		// Write source map
		.pipe( sourcemaps.write( sass_dest ) )

		// Output the compiled sass to this directory
		.pipe( gulp.dest( sass_dest ) )

		// Filtering stream to only css files
		.pipe( filter( '**/*.css' ) )

		// Inject changes via browsersync
		.pipe( reload( {stream: true } ) )

		// Notify on successful compile (uncomment for notifications)
		.pipe( notify( "Compiled: <%= file.relative %>" ) );
} );

/**
 * Minify javascript files.
 *
 * https://www.npmjs.com/package/gulp-uglify
 */
gulp.task( 'scripts', function () {

	gulp.src( js_src )
		// Notify on error.
		.pipe( plumber( { errorHandler: notify.onError( "Error: <%= error.message %>" ) } ) )

		// Cache files to avoid processing files that haven't changed.
		.pipe( cache( 'scripts' ) )

		// Add .min suffix.
		.pipe( rename( { suffix: '.min' } ) )

		// Minify.
		.pipe( uglify() )

		// Output the processed js to this directory.
		.pipe( gulp.dest( js_dest ) )

		// Inject changes via browsersync.
		.pipe( reload( { stream: true } ) )

		// Notify on successful compile.
		.pipe( notify( "Minified: <%= file.relative %>" ) );
} );

/**
 * Optimize images.
 *
 * https://www.npmjs.com/package/gulp-imagemin
 */
gulp.task( 'images', function () {

	return gulp.src( img_src )

		// Notify on error.
		.pipe( plumber( {errorHandler: notify.onError( "Error: <%= error.message %>" ) } ) )

		// Cache files to avoid processing files that haven't changed.
		.pipe( cache( 'images' ) )

		// Optimise images.
		.pipe( imagemin( {
			progressive: true
		} ) )

		// Output the optimised images to this directory.
		.pipe( gulp.dest( img_dest ) )

		// Inject changes via browsersync.
		.pipe( reload( { stream: true } ) )

		// Notify on successful compile.
		.pipe( notify( "Optimised: <%= file.relative %>" ) );
} );

/**
 * Scan the theme and create a POT file.
 *
 * https://www.npmjs.com/package/gulp-wp-pot
 */
gulp.task( 'i18n', function() {

	return gulp.src( php_src )

	// Notify on error.
	.pipe( plumber( { errorHandler: notify.onError( "Error: <%= error.message %>" ) } ) )
	
	// Sort array.
	.pipe( sort() )

	// POT information.
	.pipe( wpPot( {
		domain: 'store-pro',
		destFile:'store-pro.pot',
		package: 'store-pro',
		bugReport: 'http://store-pro.com',
		lastTranslator: 'Lee Anthony <seothemeswp@gmail.com>',
		team: 'Seo Themes <seothemeswp@gmail.com>'
	} ) )

	// Create file in languages folder.
	.pipe( gulp.dest( 'languages/' ) );
} );

/**
 * Bump version.
 *
 * https://www.npmjs.com/package/gulp-bump
 */
gulp.task( 'bump', function() {

	var oldversion = '0.1.0';
	var newversion = '0.1.1';

	// Try to update the above version automatically.
	gulp.src( [ './gulpfile.js' ] )
		.pipe( replace( "oldversion = " + oldversion + ";", "oldversion = " + newversion + ";" ) )
		.pipe( gulp.dest( './' ) );

	// Update package.json and style.css.
	gulp.src( [ './package.json', './style.css' ] )
		.pipe( bump( { version: newversion } ) )
		.pipe( gulp.dest( './' ) );

	// Update sass style.scss.
	gulp.src( './assets/styles/style.scss' )
		.pipe( bump( { version: newversion } ) )
		.pipe( gulp.dest( './assets/styles/' ) );
});

/**
 * Package theme.
 *
 * https://www.npmjs.com/package/gulp-zip
 */
gulp.task( 'zip', function() {

	gulp.src( '*.css' )

		// Beautify CSS.
		.pipe( beautify() )
		.pipe( gulp.dest( './' ) );

	// Create zip file and ignore the following.
	gulp.src( [ './**/*', '!./node_modules/', '!./node_modules/**' ] )
		.pipe( zip( __dirname.split( "/" ).pop() + '.zip' ) )
		.pipe( gulp.dest( '../' ) );
} );

/**
 * Process tasks and reload browsers on file changes.
 *
 * https://www.npmjs.com/package/browser-sync
 */
gulp.task( 'watch', function() {

	// Kick off BrowserSync.
	browserSync( {
		proxy: dev_url,
		notify: false,
		open: false
	} );

	// Run tasks when files change.
	gulp.watch( [sass_src, 'assets/styles/**/*.scss' ], [ 'sass' ] );
	gulp.watch( js_src, [ 'scripts' ] );
	gulp.watch( img_src, [ 'images' ] );
	gulp.watch( php_src ).on( "change", reload );
} );

/**
 * Create default task.
 */
gulp.task( 'default', [ 'watch' ], function() {
	gulp.start( 'sass', 'scripts', 'images' );
} );
