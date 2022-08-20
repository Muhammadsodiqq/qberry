## Project finished

**What do I need to do to run the project?**

 1. clone this project 
 2. create `.env` file and copy from `.env.example`
 3. configure database connect.
 4. run command first `composer install` then `php artisan migrate`  then `php artisan passport:install` then `php artisan db:seed` then `php artisan key:generate` then 
 5. to start using run this command  `php artisan serve`
 6. the docs is in `http://127.0.0.1:8000/docs` and postman collection and documentation here `https://documenter.getpostman.com/view/18022377/VUqpsHBq`
 

## In calculate procces

 - there is column named `general_price` . This means in one block's object : **general_price is the price multiplied by how many days you want to buy this price** , in rooms object :  **the added general_price of blocks  that connected to this room** and in main object :  **the added general_price of rooms  that connected to this Location**.
 - `general_area` is general area of all block's in result and `asked_area` is the needed area for user
