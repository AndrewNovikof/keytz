# KeyTz

## Installation project

### Server Requirements

- PHP >= 7.0.0
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

Project utilizes Composer to manage its dependencies. So, before using, make sure you have Composer installed on your machine.

First fetch with github 
- git init
- git config user.name "UserName"
- git config user.email userEmail
- git remote add origin https://github.com/AndrewNovikof/keytz.git
- git fetch origin
- git checkout master

### Configuration

#### Public Directory

After pooling project, you should configure your web server's document / web root to be the  `public` directory. The `index.php` in this directory serves as the front controller for all HTTP requests entering your application.

#### Configuration Files

All of the configuration files for the project are stored in the `config` directory. Each option is documented, so feel free to look through the files and get familiar with the options available to you.

#### Directory Permissions

After installing project, you may need to configure some permissions. Directories within the  `storage` and the `bootstrap/cache` directories should be writable by your web server or application will not run. If you are using the Homestead virtual machine, these permissions should already be set.

#### Application Key

The next thing you should do after installing project is set your application key to a random string. If you installed Laravel via Composer or the Laravel installer, this key has already been set for you by the `php artisan key:generate` command.

Typically, this string should be 32 characters long. The key can be set in the `.env` environment file. If you have not renamed the `.env.example` file to `.env`, you should do that now. If the application key is not set, your user sessions and other encrypted data will not be secure!

#### Passport

When deploying Passport to your production servers for the first time, you will likely need to run the `passport:keys` command. This command generates the encryption keys Passport needs in order to generate access token. The generated keys are not typically kept in source control:
`php artisan passport:keys`

#### Migrations

To run all of your outstanding migrations, execute the `migrate` Artisan command:
`php artisan migrate`

##### Seedings

Once you have written your seeder, you may need to regenerate Composer's autoloader using the `dump-autoload` command:
`composer dump-autoload`

Now you may use the db:seed Artisan command to seed your database. By default, the  `db:seed` command runs the DatabaseSeeder class, which may be used to call other seed classes. However, you may use the `--class` option to specify a specific seeder class to run individually:
`php artisan db:seed`
`php artisan db:seed --class=UsersTableSeeder`