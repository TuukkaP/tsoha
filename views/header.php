<!doctype html>
<html>
    <head>
        <title>Työvuorot</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />	

    </head>
    <body>
        <?php Session::init(); ?>

        <div id="header" >


            <?php if (Session::get('login') == false): ?>
                <a href="<?php echo URL; ?>index">Etusivu</a>
                <a href="<?php echo URL; ?>login/">Login</a>
            <?php else: ?>
                <a href="<?php echo URL; ?>main/">Main</a>              
                <?php if (Session::get('role') == 'admin'): ?>
                    <a href="<?php echo URL; ?>users/">Käyttäjät</a>
                    <a href="<?php echo URL; ?>places/">Paikat</a>
                    <a href="<?php echo URL; ?>orders/">Tilaukset</a>
                    <?php else: ?>
                    <a href="<?php echo URL; ?>userInfo/">Käyttäjätiedot</a>
                    <a href="<?php echo URL; ?>userOrders/">Vuorolista</a>
                <?php endif; ?>
                
                <a href="<?php echo URL; ?>main/logout">Logout</a>
            <?php endif; ?>
        </div>

        <div id="content">