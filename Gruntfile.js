'use strict';

module.exports = function (grunt) {
  
  // Load all grunt tasks
  require('load-grunt-tasks')(grunt);

  // Config
  grunt.initConfig({

    // Read package.json
    pkg: grunt.file.readJSON('package.json'),

    // Compile less files
    less: {
      development: {
        options: {
          paths: [ 'less' ]
        },
        files: {
          'css/style.css': 'less/style.less',
          'css/admin.css': 'less/admin.less'
        }
      },
      production: {
        options: {
          paths: [ 'less' ],
          cleancss: true
        },
        files: {
          'css/style.css': 'less/style.less',
          'css/admin.css': 'less/admin.less'
        }
      }
    },

    // Uglify javascript files
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> (v<%= pkg.version %>) - ' +
          '<%= grunt.template.today("yyyy-mm-dd hh:mm:ss") %> */'
      },
      production: {
        files: {
          'js/pleroma.min.js': [ 'js/pleroma.js' ]
        }
      }
    },

    // Watch
    watch: {
      less: {
        files: [ 'less/**/*' ],
        tasks: [ 'less:development' ],
        options: { nospawn: true }
      },
      uglify: {
        files: [ 'js/**/*', '!js/**/*.min.js' ],
        tasks: [ 'uglify:production' ],
        options: { nospawn: true }
      },
      livereload: {
        options: { livereload: true },
        files: [
          'less/**/*',
          'js/**/*',
          '**/*.php'
        ]
      }
    },

    // Handle releases
    release: {
      options: {
        commit: true,
        push: false,
        pushTags: false,
        npm: false,
        commitMessage: 'Release <%= version %>',
        tagMessage: 'Version <%= version %>'
      }
    }

  });

  // Build Task
  grunt.registerTask('build', [ 'less:production', 'uglify:production' ]);

};
