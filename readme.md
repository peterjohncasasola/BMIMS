1.Download and Install composer https://getcomposer.org/

2.Download git tool and install see the attach link. https://git-scm.com/downloads

3.open git terminal (git bash) and clone then project (download)
    git clone https://github.com/peterjohncasasola/BMIMS.git 

4. cd BMIMS

5. composer install

6. npm install

7. code ./ (it will open the app directory)

8. edit .env file and change the value of DB_DATABASE=yourdatabasename and DB_USERNAME=root (homestead by default)

9. php artisan key:generate

10. php artisan migrate:fresh --seed (it will create database tables and create dump data)

11. php arisan serve (it will run the application)

12. open your brower and type 127.0.0.1:8000/login

#Sample Account
username = systemadmin
password = systemadmin
