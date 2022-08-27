### PHP Developer - Home Assignment

##### Installation
```bash
$ composer install
```
##### Configuration
In the root folder you can find the file **config.php**. In the file you need to configure database values:
- `DB_HOST` - by default localhost
- `DB_NAME` - database name
- `DB_USER` - username
- `DB_PASS` - password

And need to add credentials to fetch data from [https://www.become.co/api/rest/test/], configure:
- `BP_USER` - username
- `BP_PASS` - password

Afterwards, go to cmd and run migration command. This command create new table on database.
```bash
$ composer run-script migration
```

#### Congratulations!!! 

### Routes:
- `http://<yourhost>/` - it works
- `http://<yourhost>/update` - update data from server 
- `http://<yourhost>/sales` - Net Sales
- `http://<yourhost>/costs` - Production costs
- `http://<yourhost>/profit` - Gross profit
- `http://<yourhost>/margin` - Gross margin

### Project structure:
Files marked with `##` are not relevant to the task, they are needed for the application to work.
Business logic, relevant to the task marked with `#`
```bash 
|-- App                         
|   |-- Controllers
|       |--- Main.php           # Main controller
|-- Lib
|   |-- App.php                 ## Run scripts on app runing             
|   |-- Config.php              ## Parse config file
|   |-- Connection.php          ## Connection to db, insert, get manager
|   |-- Migration.php           # create table Orders on db
|   |-- Request.php             ## Request obj
|   |-- Response.php            ## Response obj
|   |-- Router.php              ## Router obj
|   |-- UploadData.php          # Fetch data and insert to db
|-- Model
|   |-- Model.php               # Factory - get models
|   |-- Order.php               # Order model, queries, field list 
|-- vendor
|-- .htaccess                   
|-- composer.json
|-- composer.lock
|-- config.php                  # configuration file
|-- data.json
|-- index.php                   # index
|-- README.md
```