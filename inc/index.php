<?php

header('Location: ../');

/* 
    **  When someone types an url only to the foldername, the the server tends to look for a file called index.php or index.html.
        Otherwise it will show all the available files inside this folder, which is horroable.
     
    ** So placing an empty index.php file will protect us from seeing all the available files. 
    
    **  The default behaviour for looking for a 'index' named file can be changed by writing some rewriting rule inside a file called .htaccess.
*/    