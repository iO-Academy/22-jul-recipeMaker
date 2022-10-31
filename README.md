
# Fish Food
### Description
Fish Food is an MVC object-orientated PHP project, architectured using Slim framework and styled with Bootstrap and CSS. Using a relational SQL database, the app links users to recipes and recipes to ingredients, before displaying information on the front end using JavaScript.

Users are able create accounts, add their favourite recipes, and then filter through recipes to decide what they can make with a defined set of ingredients. All functions were unit tested, type-hinted and custom error handling used throughout. 

## Getting Started

### Dependencies
``` 
- PHP version 7.4.30 
- Slim version 4
- MySQL version 5.7.38
- Composer version 2.4.1
- PHPUnit version 9.5.21
- Bootstrap version 5.2
```
### Installing
Clone this repo:
```
git@github.com:iO-Academy/22-jul-recipeMaker.git
```
Navigate into the newly created repo:
```
cd 22-jul-recipeMaker
```
Install the database `fishFood.sql` into a db named `fishFood`

Ensure your local database host, username and password details are correct in:
```
app/dependencies.php
```
From the root of the project run:
```
Composer install
```
The application will now be available wherever you access it
### Authors
- Aidan Maskell - [@aidanmaskell](github.com/aidanmaskell)
- Chris Walton - [@cr-walton](github.com/cr-walton)
- Mikey Ying - [@mikeycodingstuff](github.com/mikeycodingstuff)
