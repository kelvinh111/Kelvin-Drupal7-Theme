module.exports = function(grunt) {

  require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    compass: {
      dist: {
        options: {
          sassDir: 'sass',
          cssDir: 'css',
          outputStyle: 'compressed'
        }
      }
    },
    uglify: {
      build: {
        files: {
          'js/compiled/script.min.js': ['js/*.js']
        },
        options: {
          sourceMap: true,
          sourceMapName: 'js/compiled/all.min.js.map'
        }
      }
    },
    watch: {
      css: {
        files: '**/*.scss',
        tasks: ['compass'],
        options: {
          livereload: 13579,
        },
      },
      js: {
        files: ['js/*.js'],
        tasks: ['uglify'],
        options: {
          livereload: 13579,
        }
      }
    }
  });

  grunt.registerTask('default', ['watch']);
}
