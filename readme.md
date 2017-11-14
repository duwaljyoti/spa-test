## Install Project

Please pull the project to your local machine.

Steps to run the project..
1) composer install
2) npm install
3) just run php artisan serve(After doing so, one can access project on localhost:8000)
4) npm run watch

Once can test if the project is running by hitting following endpoints on  browser or
 postman(https://chrome.google.com/webstore/detail/postman/fhbjgbiflinjbdggehcddcbncdddomop?hl=en)
 for eg. domain_name/api/notes
                          
 GET|HEAD  | api/notes                 
 POST      | api/notes             
 GET|HEAD  | api/notes/create       
 GET|HEAD  | api/notes/{note}      
 PUT|PATCH | api/notes/{note}      
 DELETE    | api/notes/{note}
 GET|HEAD  | api/notes/{note}/edit
 PUT       | api/notes/{note}/toggleFavourite
                       
