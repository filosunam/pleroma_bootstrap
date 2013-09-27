'use strict';

module.exports = function(grunt){

// load all grunt tasks
require('load-grunt-tasks')(grunt);

grunt.initConfig({
    less: {
      development: {
        options: {
          paths: [ 'css/less' ],
          yuicompress: true
        },
        files: [
          {
            expand: true,
            cwd: 'css/less',
            src: [
              'style*.less',
              'admin.less'
            ],
            dest: 'css' ,
            ext: '.css'
          }
        ]
      }
    },
    watch: {
      less: {
        files: [ 'css/less/*.less' ],
        tasks: [ 'less' ],
        options: { nospawn: true }
      },
      livereload: {
        options: { livereload: true },
        files: [
          '**/*.less',
          '**/*.php'
        ]
      }
    },
    uglify: {
      target: {
        files: {
          'js/pleroma_bootstrap.min.js': [
            "bootstrap/js/bootstrap-transition.js",
            "bootstrap/js/bootstrap-alert.js",
            "bootstrap/js/bootstrap-button.js",
            "bootstrap/js/bootstrap-carousel.js",
            "bootstrap/js/bootstrap-collapse.js",
            "bootstrap/js/bootstrap-dropdown.js",
            "bootstrap/js/bootstrap-modal.js",
            "bootstrap/js/bootstrap-tooltip.js",
            "bootstrap/js/bootstrap-popover.js",
            "bootstrap/js/bootstrap-scrollspy.js",
            "bootstrap/js/bootstrap-tab.js",
            "bootstrap/js/bootstrap-typeahead.js",
            "bootstrap/js/bootstrap-affix.js",
            "js/pleroma.js"
          ]
        }
      }
    },
    exec: {
      bootstrap: {
        command: 'cp ./bootstrap/img/* ./img'
      }
    },
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

  grunt.registerTask('build', ['less', 'uglify', 'exec']);
};
