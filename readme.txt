Master Theme
Please open all issues with this template on the main Client Name Here repo.

This is the theme for Client Name Here and has a lot of great things included:

Lean, well commented, modern, accessible HTML5 templates. Some things that come baked into the theme are as follows:
A helpful 404 template.
A custom header implementation in inc/custom-header.php just add the code snippet found in the comments of inc/custom-header.php to your header.php template. (If needed)
Custom template tags in inc/template-tags.php that keep your templates clean and neat and prevent code duplication.
Some small tweaks in inc/template-functions.php that can improve your theming experience.
A script at js/navigation.min.js that makes your menu a toggled dropdown on small screens (like your phone), ready for CSS artistry. It's enqueued in lib/init.php.
2 sample CSS layouts in layouts/ for a sidebar on either side of your content. (examples for inspiration)
A set of organized SCSS files complete with base styles, predefined variables, mixins, helpers and utilities.
Compiled CSS with Sourcemaps in style.css and style.css.map that will help you to quickly get your design off the ground. The stylesheet is minified by default, look in the gulpfile @line 32 to update the outputStyle from compressed to expanded for production/development.
Licensed under GPLv2 or later. :) Use it to make something cool.
Foundation for Sites 6 is included which has:
A Sass compiler (Gulp for SCSS compiling)
We have extended the Foundation - Advanced Gulp Integration with: - Browser Sync (Live Reload) - Uglify (JS minification) - Notify (Push notifications for Gulp task completion) - Sourcemaps (CSS Sourcemaps) - WP POT (Translation file compiler)

Dependency Installation
To use this template, your computer needs:

Homebrew (optional but you should be using this!)
NodeJS (0.12 or greater)
Foundation CLI
Git
Bower
Gulp
WP-cli (optional)
Install Homebrew

If you don't have Homebrew installed simply copy and paste the command below into your command line prompt:

/usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"

Install Node

If you don't have node and npm installed copy and paste the command below into your command line prompt:

brew install node

Once node is installed install n a node version manager:

brew install n

Install Git

Git is probably installed already due to XCode or homebrew, but if it's not just run the command below in your command line prompt:

brew install git

Install Bower

If you don't have bower installed simply copy and paste the command below into your command line prompt:

npm install -g bower

Install Gulp

If you don't have Gulp installed simply copy and paste the command below into your command line prompt:

npm install --global gulp-cli

Install WP-cli

First download the wp-cli.phar

curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar

Next check to see if it's working:

php wp-cli.phar --info

Now lets make this an executable file so we can run wp from the command line:

chmod +x wp-cli.phar

sudo mv wp-cli.phar /usr/local/bin/wp

Lastly check to see that it is working properly

wp --info

*Note: If you use MAMP run the following command to symlink the system MYSQL socket to the MAMP MYSQL socket*

ln -s /Applications/MAMP/tmp/mysql/mysql.sock /tmp/mysql.sock

Once all of the dependencies have been installed, from your command line:

cd projectname
npm install
bower install
Finally, run npm start or gulp (preferred method, plus less typing 😉) to run the Sass compiler. It will re-run every time you save a Sass file.

🎉🎊 Wooo!! 🎊🎉

Now you're ready to go! The next step is easy to say, but harder to do: make an awesome WordPress theme 😃
