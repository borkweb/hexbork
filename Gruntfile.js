'use strict';

/*global module:false*/
var sys  = require('sys');
var fs   = require('fs');

module.exports = function(grunt) {
	var js_files = [
		'js/lib/**/*.js'
	];

	var sass_files = [
		'sass/**/*.scss'
	];

	// Project configuration.
	grunt.initConfig({
		uglify: {
			compress: {
				files: [
					{
						expand: true, // enable dynamic expansion
						cwd: 'js/lib/', // src matches are relative to this path
						src: ['**/*.js'], // pattern to match
						dest: 'js/min/'
					}
				]
			}
		},
		compass: {
			prod: {
				config: 'config.rb',
				debugInfo: false
			}
		},
		combine_mq: {
			dev: {
				expand: true,
				cwd: 'css',
				src: '*.css',
				dest: 'css'
			}
		},
		cssmin: {
			options: {
				compatibility: '*',
				keepSpecialComments: 0,
				mediaMerging: true
			},
			target: {
				expand: true,
				cwd: 'css',
				src: ['**/*.css', '!**/*.min.css'],
				dest: 'css',
				ext: '.css'
			}
		},
		cssmetrics: {
			dev: {
				src: [
					'css/**/*.css'
				]
			}
		},
		watch: {
			files: js_files.concat( sass_files ),
			livereload: {
				// Here we watch the files the sass task will compile to
				// These files are sent to the live reload server after sass compiles to them
				options: { livereload: true },
				files: ['css/**/*']
			},
			//watch only gets done while we're developing - so 'newer' is appropriate here
			tasks: [
				'newer:uglify',
				'compass:prod',
				'newer:combine_mq:gigaom',
				'newer:combine_mq:dev',
				'newer:combine_mq:roadmap',
				'newer:combine_mq:events',
				'newer:cssmin'
			]
		}
	});

	// Autoload allthethings in packages.json!
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	//default gets run pre-deploy - so 'newer' is NOT appropriate here (they're all new)
	grunt.registerTask(
		'default',
		[
			'uglify',
			'compass:prod',
			'combine_mq:gigaom',
			'combine_mq:dev',
			'combine_mq:roadmap',
			'combine_mq:events',
			'cssmin'
		]
	);

	//dev should get run while we're developing - so 'newer' is appropriate here (and speeds things up locally)
	grunt.registerTask(
		'dev',
		[
			'newer:uglify',
			'compass:prod',
			'newer:combine_mq:gigaom',
			'newer:combine_mq:dev',
			'newer:combine_mq:roadmap',
			'newer:combine_mq:events',
			'newer:cssmin',
			'cssmetrics:dev'
		]
	);
};
