# por-planner
Snelle en handige planner voor POR gesprekken. Genereert een .csv bestand die je in excel kunt openen en opmaken, en vervolgens als .xlsx kunt delen met de studenten.

## How To Run (local only)

- Make sure you have installed the following sofware:
    - Git
    - Nodejs
    - Composer (make sure PHP is added to the PATH variable)
    - Optional:
        - A webserver (like XAMPP or Laragon)

- Clone the repo

- Execute the following commands in the project root folder (using Git-Bash, or another terminal)

  `cp .example.env .env`
  
  `composer install`
  
  `php artisan key:generate`
  
  `php artisan config:cache`

  `npm install`

  `npm run prod`

- Do either one of the following:
    - Run the site with artisan serve:

        - Execute the following command in the project root folder to deploy the site
    
            `php artisan serve`
    
        - Then open http://127.0.0.1:8000 in your browser. (Note: if port 8000 is already in use, try `php artisan serve --port=8080` and open http://127.0.0.1:8080 in your browser instead.)

    - Run the site through your local Webserver (XAMPP/Laragon)
       
        - Open http://localhost/por-planner (XAMPP) or http://por-planner.test (Laragon) in your browser.,
