<?php

/*
 * ©2013 Croce Rossa Italiana
 */

paginaPrivata();

$t = $_GET['id'];

        $t = new Reperibilita($t);
        $t->fine    = time();
        redirect('utente.reperibilita&del');
