# Architecture
PHP and MySQL were used to develop this sample. Bootstrap was used for layout purposes. This is a simple layout in order to highlight the backend work. Dependecy management is handled by Bower.

When the page loads, it uses the GitHub API to retrieve the repositories with the most stars. This data is put into the database where it is then retrieved and displayed. The page shows a condensed version of the data. Clicking each Repository name expands further details about the repository.

# Instructions
This repository contains all of the files necessary to set up and view the code sample. If you plan on saving these files to a web server, please keep the following in mind:
1. Bower was used to install bootstrap dependencies. If you do not have bower, you can get it at bower.io. Follow the instructions on the Bower site to install dependencies. A bower.json file is provided for you.
2. A settings file called vandy.ini is needed to run the sample. Because it contains data that should not be shared, I will email that file to you. On the production site, it should be in a directory above the web root directory.
3. A sql file will also be emailed in order to create the database and blank table required.
4. If you run this on your own server, you will need to update the vandy.ini file with the correct path information.
5. Paths will also need to be modified on line 22 of class.Database.php, line 11 on config.db.php, and line 8 of config.settings.php.
 
# Questions or Comments
If you have any questions or comments, please call or email me with the number and email you already have for me.
