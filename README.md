<h1 align="center">
  Humbleprice
</h1>

## :bust_in_silhouette: Test accounts

Since this is a demo version of the project, here are some helpful accounts you can use to test features that are only available to high hierarchy users (like administrators, moderators, etc):

### Admin

__Email__: admin@admin.com  
__Password__: admin  

### Moderator

__Email__: mod@mod.com  
__Password__: mod  

You can login with one of these accounts here: https://humbleprice.000webhostapp.com/login.

## :rocket: Setup

:bulb: To install the required dependencies, you'll need to have [Composer](https://getcomposer.org/) installed in your machine.

To install the project dependencies, enter the `src/` folder of your project using the Terminal/CMD and type the following command:
 
```
composer install
```

It's important to notice that it's necessary that you have some server capable of executing `php` scripts and running a MySQL or MariaDB database. You can use `XAMPP`, `WAMP`, `LAMP`, `MAMP` or any other server of your choice.

## :on: Initializing the project

### Database

All the database tables and required data are located in the file `humbleprice.sql`. You can either copy the whole content of the file and paste it in your favorite database administration tool (`phpMyAdmin`, `Sequel Pro`, `MySQL Workbench`, etc) or execute the `queries` using the command-line.

In case you are importing the `humbleprice.sql` file directly in `phpMyAdmin` or in another database administration tool, make sure to create a database named `Humbleprice` first.

### Config

In order to config your environment to run the application, you have to change the global config variables located at `config/config.php`.

You can also switch environments between `development` and `production` at `config/environment.php`

#### DIRPAGE

The `DIRPAGE` variable should contain the URL of your website. You should replace `humbleprice` with your actual folder name.

#### Assets

You can customize the path to public assets. Here's a list of them:

- `DIRIMG`: Image assets (`.webp`, `.jpg`, `.png`, etc)
- `DIRCSS`: CSS and other stylesheets
- `DIRJS`: JavaScript and jQuery related files
- `DIRVID`: Video assets (`.mp4`, `.wmv`, etc)
- `DIRAUD`: Audio assets (`.mp3`, `.ogg`, etc)
- `DIRFONT`: Fonts used in your project
- `DIRDESIGN`: Design files

#### Database credentials

Configure `dbname`, `host`, `dbuser` and `dbpass` to fit your project and database needs.
 
The default `dbuser` and `dbpass` are `root` and an empty password (respectively), but it may change based on your installation and in what you are using (`XAMPP`, `WAMP`, `LAMP`, `MAMP`, etc).

## :file_folder: Directory Structure

This project makes use of the [MVC](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller#:~:text=Model%E2%80%93view%E2%80%93controller%20\(usually,logic%20into%20three%20interconnected%20elements.) architecture. It's recommended to get familiar with this concept before proceeding to use or modify this project. 

### `app`

The `app` directory contains the core code of your application. There you can find the project `Dispatcher`, `Controllers`, `Models` and `Views`, which are the base structure of a MVC project.

- `Controllers`: Controllers can group related request handling logic into a single class. For example, a `UserController` class might handle all incoming requests related to users, including showing, creating, updating, and deleting users.

- `Core`: These are the core classes of the application. It includes a base `Controller` (which every Controller must extend), an `Authorization` class that may or may not be extended by a Controller, a `Render` class responsible for rendering views and a `Table` class responsible for defining the base structure of a `Model`.

- `Models`: The model component stores data and its related logic. It represents data that is being transferred between controller components or any other related business logic. For example, a Controller object will retrieve the customer information from the database. It manipulates data and send back to the database or use it to render the same data. All models must call the `parent::__construct()` and have a table associated with it by overwriting the `$table` property.

- `Views`: A View is the part of the application that represents the presentation of data. A view may have a main content (represented by `main.php`), additional footer information for a specific page (repesented by `footer.php`) and/or additional head information (represented by `head.php`). All the information of how it's done can be found in the `app/Core/Render.php` file. Every View needs to be a folder with just one or even all these three files. The `Layout` used by all the views is located at `app/Views/Layout.php`.

- `Dispatch`: The Dispatch file is responsible for bootstraping the application.

- `Helpers`: These are some helpful (duh) functions used throughout the entire project. This file is autoloaded using Composer.

### `config`

These are the project configuration files. You can find instructions on how to use then [here](#config).

### `public`

Here are located all the public assets of your project. 

### `src`

This is where your Classes, Traits, Interfaces and Partials must be. This is also the place where your `Composer` dependencies will be located (after you run `composer install`, a `vendor` folder will be created).

## :world_map: Routing

The routes are based on the Controller name and method. If you have a controller named `OfferController`, for example, and you want to edit an offer, the route would be `https://website.com.br/offer/edit/child-of-light` (with "child-of-light" being a parameter). If you want to use it as an example to learn more, these controller and method actually exists and can be found at `app/Controllers/OfferController.php@edit`. The default controller method/action is `index`.

All the routing logic is located at the `app/Dispatch.php` file.

## :mailbox_with_mail: License

Feel free to use, test and collaborate. The more contributors, the better.
