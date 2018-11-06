# BileMo

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/827e545901894999bb6d0ac791c23815)](https://www.codacy.com/app/Giildo/p7?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Giildo/p7&amp;utm_campaign=Badge_Grade)

## Project installation

1.  Code recovery

    1. Git

        Connect with SSH key to your server.  
        Use the command : `git clone https://github.com/Giildo/p6.git`

    1. FTP

        Download this [repository](https://github.com/Giildo/p7/archive/master.zip).  
        Use a FTP client, for example [FileZilla](https://filezilla-project.org/) and connect to the server.  
        Use the FTP client to transfert the repository on your server.

1. Configuration

    Copy the file .env.dist to .env.

    Initialize the APP_ENV constant to prod.  
    Initialize the DATABASE_URL constant to mysql://username:password@address:port/database_name with your values.

1. Vendors installation

    1. Composer

        If you can use Composer in your server, use `composer install --no-dev -ao` for optimized installation of vendors.  
        If you can't use Composer, download [Composer.phar](https://getcomposer.org/download/) and use `php composer.phar install --no-dev -ao`.

    1. FTP

        If you can't use the both solutions, use your FTP client to download all vendors.  
        This solution is to be used only if no solution with Composer works.

1. Database creation

    Use the command `php bin/console d:d:c` for database creation.  
    Use the command `php bin/console d:m:m` for creation of the tables.  
    Use the command `php bin/console d:f:l` for fixtures load.

1. Documentation and API tests

    The documentation is on the uri `/api/doc`.  
    For the connection, use Postman (or other API Development Environment), and connect to the path `/api/login_check`, with credentials :
    ```json5
    {'username': 'DoeSarl','password': '12345678'}
    ```
    Copy the returned bearer token and connect by paste the token in the "Authorize" button : `Bearer token4564465...`.