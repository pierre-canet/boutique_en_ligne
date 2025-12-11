<pre><code>
regles_homemade_warhammer_mvc/
│
├── config/
│   └──database.php
│
├── controllers/
│   ├──auth_controller.php
│   ├──products_controller.php
|   └──home_controller.php
|
├── core/
│   ├──database.php
|   ├──router.php
|   └──view.php
|
├── database/
|   └──schema.sql
|
├── includes/
│   └──helpers.php
|
├── models/
|    ├──products_model.php
|    └──user_model.php
|
├── public/
|    ├──api/
|    |   ├──products/
|    |   |   ├──filter.php
|    |   |   ├──search.php
|    |   |   ├──subcategories.php
|    |   |   └──show.php
|    |   └──bootstrap.php
|    ├──assets/
|    |   ├──css/
|    |   |  └──style.css
|    |   ├──images/    
|    |   └──js/
|    |      └──app.js                                                           
|    ├──.htaccess
|    └──index.php
|
├── views/
│   ├── auth/
|   |   ├──login.php    
|   |   └──register.php
|   |  
|   ├──errors/
|   |   └──404.php
|   ├──home/  
|   |   ├──about.php
|   |   ├──contact.php
|   |   ├──index.php
|   |   ├──profile.php
|   |   └──test.php
|   ├──layouts/  
|   |  └──layouts.php
│   └──products/
│       ├──index.php
│       └──show.php
├── .gitignore
├──CHANGELOG.md
├──CODING_STANDARDS.md
├──CODING_STANDARDS.pdf
├──map.php
</code></pre>