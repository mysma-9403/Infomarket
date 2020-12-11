module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        less: {
            dev: {
                options: {
                    sourceMap: true,
                    dumpLineNumbers: 'comments',
                    relativeUrls: true,
                    plugins: [
                            new (require('less-plugin-autoprefix'))({ browsers: ["last 2 versions"] })
                    ]
                },
                files: {
                	'web/css/admin.css': 'web/assets/custom/admin.less',
                	'web/css/infoprodukt.css': 'web/assets/custom/infoprodukt.less',
                	'web/css/infomarket.css': 'web/assets/custom/infomarket.less',
                	'web/css/benchmark.css': 'web/assets/custom/benchmark.less',
                    'web/css/font-awesome.css': 'web/assets/vendor/font-awesome/less/font-awesome.less'
                }
            },
            production: {
                options: {
                    compress: true,
                    relativeUrls: true,
                    plugins: [
                            new (require('less-plugin-autoprefix'))({ browsers: ["last 2 versions"] })
                    ]
                },
                files: {
                	'web/css/admin.min.css': 'web/assets/custom/admin.less',
                	'web/css/infoprodukt.min.css': 'web/assets/custom/infoprodukt.less',
                	'web/css/infomarket.min.css': 'web/assets/custom/infomarket.less',
                	'web/css/benchmark.min.css': 'web/assets/custom/benchmark.less',
                	'web/css/font-awesome.min.css': 'web/assets/vendor/font-awesome/less/font-awesome.less'
                }
            }
        },
        bowercopy: {
            options: {
                srcPrefix: 'web/assets/vendor',
                destPrefix: 'web'
            },
            scripts: {
                files: {
                    'js/jquery.js': 'jquery/dist/jquery.js',
                    'js/jquery.cookiefy.js': 'jquery.cookiefy/dist/jquery.cookiefy.js',
                    'js/moment.js': 'moment/min/moment.min.js',
                    'js/pl.js': 'moment/locale/pl.js',
                    'js/bootstrap.js': 'bootstrap/dist/js/bootstrap.js',
                	'js/bootstrap-datetimepicker.js': 'eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js'
                }
            },
            fonts: {
                files: {
                    'fonts': ['font-awesome/fonts', 'bootstrap/fonts']
                }
            }
        },
	    uglify : {
	        js: {
	            files: {
	                'web/js/jquery.min.js': ['web/js/jquery.js'],
	                'web/js/jquery.cookiefy.min.js': ['web/js/jquery.cookiefy.js'],
	                'web/js/moment.min.js': ['web/js/moment.js'],
	                'web/js/pl.min.js': ['web/js/pl.js'],
	                'web/js/bootstrap.min.js': ['web/js/bootstrap.js'],
        			'web/js/bootstrap-datetimepicker.min.js': ['web/js/bootstrap-datetimepicker.js']
	            }
	        }
	    }
    });
    
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-bowercopy');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    grunt.registerTask('production', ['less:production', 'bowercopy', 'uglify']);
    grunt.registerTask('default', ['less:dev', 'bowercopy']);
    grunt.registerTask('dev', ['less:dev', 'bowercopy']);
};