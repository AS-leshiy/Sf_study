Symfony Almost Standard Edition
===============================

For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

What's inside?
--------------

1. All that includes Symfony Standard Edition;
2. Bundle which allows us to add, view, edit and delete information from database table;

How to start?
--------------

First instal (for windows)
1. instal local server (xampp), composer, cmder
2. create folder site.loc on C:\xampp\htdocs
3. create folder www in site.loc
4. run cmder and write commands:
5. cd C:\xampp\htdocs\site.loc\www
6. git clone https://github.com/AS-leshiy/Sf_study.git
7. cd Sf_study
8. composer install --no-interaction
9. open xampp control panel, run Apache & MySQL
10. restart cmder and write commands:
11. cd C:\xampp\htdocs\site.loc\www\Sf_study
12. php bin\console doctrine:database:create
13. php bin\console doctrine:schema:create
14. php bin\console doctrine:fixtures:load
15. php bin\console cache:clear --no-warmup
16. go to Xampp control panel and restart Apache
17. go to cmder and write:
18. php bin\console server:run
19. open http://127.0.0.1:8000 in your browser

20. Admin panel: login: admin  ||  password: adminpass
