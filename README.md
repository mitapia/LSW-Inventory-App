Build on top of Laravel PHP Framework 5.1 and used Handsontable for the front end table.
It is intended for the facilitation of building an Excel document that can be imported into Quickbooks POS software to update invetory status of new items received.

Requirements: PHP5.5 or above.

Fresh Deployment:
key:generate
edit .env
Run Migration
Rum Seed

** As of Aug 1, no seed has been created for size_matrix table
recommended query to run (fell free to change values to your liking):
INSERT INTO size_matrix (name) VALUES ('Anna-18A'), ('12A'), ('18A'), ('18X'); 


### Authors

Created by Miguel Tapia (migueltapia.it@gmail.com)


### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)