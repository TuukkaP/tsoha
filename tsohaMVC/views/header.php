<!doctype html>
<html>
    <head>
        <title>Hederi</title>
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />	

    </head>
    <body>
        <?php Session::init(); ?>

        <div id="header">


            <?php if (Session::get('login') == false): ?>
                <a href="<?php echo URL; ?>index">Index</a>
                <a href="<?php echo URL; ?>test">Test</a>
                <a href="<?php echo URL; ?>login/index">Login</a>
            <?php else: ?>
                <a href="<?php echo URL; ?>main/index">Main</a>              
                <?php if (Session::get('role') == 'admin'): ?>
                    <a href="<?php echo URL; ?>users/">Käyttäjät</a>
                    <a href="<?php echo URL; ?>places/index">Paikat</a>    
                    <?php else: ?>
                    <a href="<?php echo URL; ?>userInfo/">Käyttäjätiedot</a>
                <?php endif; ?>
                
                <a href="<?php echo URL; ?>main/logout">Logout</a>
            <?php endif; ?>
        </div>

        <div id="content">