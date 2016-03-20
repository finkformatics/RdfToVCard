# Prototype

This is a little introduction of how to use this prototype.

## Requirements

- Webserver (e.g. apache webserver)
- MySQL Database
- PHP >= 5.5 (With odbc and mysql extension)
- virtuoso-opensource (https://github.com/openlink/virtuoso-opensource)

## Setup

1. Download the Zend 1 Framework at http://framework.zend.com and copy the library/Zend folder to the root (this) directory
2. Git clone or download the Erfurt Framework from https://github.com/AKSW/Erfurt.git and copy the `library/Erfurt` folder to the root (this) directory
3. Copy the `Erfurt/config.ini-dist-virtuoso` to `Erfurt/config.ini` and set your preferences
4. Create the directory `public/cache` and set all write access rights (777)
5. Run `composer install` and `composer update`
6. Add the absolute path to the Erfurt folder to the comma separated 'DirsAllowed' in virtuoso.ini
7. Run the SQL DDL scripts in the `res` folder to prepare your MySQL database
8. Run the `public/prototype.php` script to simply create vcards of all your contacts in the virtuoso store and store them into the CardDAV system

## Unit Tests

To execute the unit tests for this project, simply go to the root directory and run phpunit.

## Usage

### CardDAV

To use the CardDAV server, you could simply open the URL to the `public/server.php` script. There you get a simple interface to manage your contacts. You can also use the URL in any CardDAV client
you like. The standard administrative user created by the SQL scripts is 'admin' with the password 'admin'.

### Scripts

To run the prototype and test its current functionality there are several PHP scripts, which provide simple access to the given application. All of them can be found in the `public` folder.

#### Run the prototype

To run the prototype as described above, simply run the `prototype.php` script.

#### Insert sample contacts

If you have a fresh installation of virtuoso-opensource, there is no data yet. To load some sample contacts, you'll need an internet connection and then run the `insert_contacts.php` script.

#### Delete sample contacts

If at any time you need to delete the sample contacts again, simply run the `delete_contacts.php` script. It will only delete the sample contacts.

#### List existing contacts

You can list all your (foaf-)contacts through running the `contacts.php` script.