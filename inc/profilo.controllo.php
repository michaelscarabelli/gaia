<?php

/*
 * ©2013 Croce Rossa Italiana
 */

paginaPrivata();

$id = $_GET['id'];
$v = Utente::by('id', $id);
if ( !$v ) { die("Utente non esistente o nullo"); }
$r = $me->pri_smistatore($v);

if($r==PRIVACY_RISTRETTA){
	redirect('restricted.utente&id=' . $v);
}elseif($r==PRIVACY_PUBBLICA){
 	redirect('public.utente&id='.$v);
}