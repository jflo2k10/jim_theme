module.exports = function(grunt) {
  var pkg = require('./package.json');
  
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    /**
      * Auto Update version
      ************/
      //Set for auto patch updates
      //https://www.npmjs.com/package/grunt-bumpup
      bumpup: {
        options: {
          updateProps: {
            pkg: 'package.json'
          }
        },
        file: 'package.json'
      },
    /**
      * JS File Concantination
      ************/
      concat: {
        options: {
          banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
          '<%= grunt.template.today("yyyy-mm-dd") %> */\n\n',
        },
        dist: {
          src: '_assets/scripts/*.js',
          dest: '_assets/js/script.js',
        }
      }, 
    /**
      * Uglify
      ************/
      uglify: {
        options: {
          banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
          '<%= grunt.template.today("yyyy-mm-dd") %> */\n',
        },
        dist: {
          files: {
            '_assets/js/script.min.js': '_assets/js/script.js'
          }
        }
      },
    /**
      * JS Hint
      ************/
      jshint: {
        files: '_assets/js/script.js',
        options: {
          // options here to override JSHint defaults
          globals: {
            jQuery: true,
            console: true,
            module: true,
            document: true
          }
        }
      },
    /**
      * Sass Task
      ************/
      sass: {
        dev: {
          options: {
            style: 'expanded',
            sourcemap: 'none',
            loadPath: require('node-bourbon').includePaths
          },
          files: {
            '_assets/compiled/style-human.css': '_assets/sass/style.scss'
          }
        },
        dist: {
          options: {
            style: 'compressed',
            sourcemap: 'none',
            loadPath: require('node-bourbon').includePaths
          },
          files: {
            '_assets/compiled/style.css': '_assets/sass/style.scss'
          }
        }
      },
    /**
      * Autoprefixer
      ************/
      postcss: {
        options: {
	        processors: [
		        require('autoprefixer')({browsers: ['last 2 versions']})
	        ],
	        safe: true
        },
        multiple_files: {
          expand: true,
          flatten: true,
          src: '_assets/compiled/style.css',
          dest: ''
        }
      },
    /**
      * Clean Image Compress Folder
      *****************/
      clean: ['_assets/images/compress/*'],
    /**
    /**
      * Upload via SFTP
      ****************/
      'sftp-deploy': {
        live: {
          auth: {
            host: 'sftp.flywheelsites.com',
            port: 22,
            authKey: 'key1'
          },
          cache: 'sftpCache.json',
          src: '/Applications/MAMP/htdocs/NOIC/noic-concord-plugin/',
          dest: '/insivia/noic-concord/wp-content/plugins/noic-concord-plugin/',
          exclusions: [
            '/Applications/MAMP/htdocs/NOIC/noic-concord-plugin/.DS_Store',
            '/Applications/MAMP/htdocs/NOIC/noic-concord-plugin/node_modules',
            '/Applications/MAMP/htdocs/NOIC/noic-concord-plugin/.npm-debug.log',
            '/Applications/MAMP/htdocs/NOIC/noic-concord-plugin/tmp',
            '/Applications/MAMP/htdocs/NOIC/noic-concord-plugin/.sass-cache',
            '/Applications/MAMP/htdocs/NOIC/noic-concord-plugin/*.css.map',
            '/Applications/MAMP/htdocs/NOIC/noic-concord-plugin/_assets/compiled',
            '/Applications/MAMP/htdocs/NOIC/noic-concord-plugin/_assets/scripts',
            '/Applications/MAMP/htdocs/NOIC/noic-concord-plugin/_assets/sass',
            '/Applications/MAMP/htdocs/NOIC/noic-concord-plugin/Gruntfile.js',
            '/Applications/MAMP/htdocs/NOIC/noic-concord-plugin/package.json',
            '/Applications/MAMP/htdocs/NOIC/noic-concord-plugin/.ftppass',
            '/Applications/MAMP/htdocs/NOIC/noic-concord-plugin/.gitignore',
            '/Applications/MAMP/htdocs/NOIC/noic-concord-plugin/.git',
            '/Applications/MAMP/htdocs/NOIC/noic-concord-plugin/README.md',
            '/Applications/MAMP/htdocs/NOIC/noic-concord-plugin/sftpCache.json',
          ],
          serverSep: '/',
          localSep: '/',
          concurrency: 4,
          progress: true
        }
      },    
    /**
      * SSH to GIT
      ***********/
      //https://confluence.atlassian.com/bitbucket/set-up-ssh-for-git-728138079.html#SetupSSHforGit-startagent
      shell: {
        multiple: {
          command: 'git add -p',
          command: 'git commit -a -m "<%= pkg.name %> - v<%= pkg.version %> <%= grunt.template.today("yyyy-mm-dd") %>"',
        },
        single: {
          command: 'git push'
        },
        complete: {
          command: 'say grunt tasks are complete.'
        } 
      },
    /**
      * Watch Task
      ************/
      watch: {
        version: {
          files: ['*','*.css', '**/js/*.js', '*.php', '**/*.php'],
          tasks: ['bumpup:patch']
        },
        gruntfile: {
          files: 'Gruntfile.js',
          tasks: ['jshint'],
        },
        css: {
          files: '**/*.scss',
          tasks: ['sass', 'postcss']
        },
        scripts: {
          files: '**/scripts/*.js',
          tasks: ['concat', 'jshint', 'uglify']
        },
        images: {
          files: '_assets/images/compress/**',
          tasks: ['imagemin', 'clean']
        },
        upload: {
          files: ['*','*.css', '**/js/*.js', '*.php', '**/*.php'],
          tasks: [/*'sftp-deploy:live',*/ 'shell:multiple', 'shell:complete']
        }
      }
  }); 

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-concat');

  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-postcss');
  
  grunt.loadNpmTasks('grunt-bumpup');
  grunt.loadNpmTasks('grunt-sftp-deploy');
  grunt.loadNpmTasks('grunt-shell');
    
  grunt.registerTask('default', ['watch']);
  
}