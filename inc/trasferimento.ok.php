<?php

/*
 * ©2012 Croce Rossa Italiana
 */

paginaPrivata();

$t = $_GET['id'];
$c = $_POST['inputComitato'];
$m = $_POST['inputMotivo'];

/* Cerco appartenenze al comitato specificato */
$f = Appartenenza::filtra([
  ['volontario',    $t],
  ['comitato',      $c]
]);

/* Se sono già appartenente *ora*,
 * restituisco errore
 */

foreach ( $f as $app ) {
if ($app->attuale()) { 
                redirect('trasferimento&e');  
                                 } 
                                     }
                                     
/*Se non sono appartenente allora avvio la procedura*/

foreach ( $me->storico() as $app ) {
                            if ($app->attuale()) {
                                                    /*$f = new Appartenenza($app);*/
                                                    /*$f->timestamp = time();*/ /*non va più memorizzato qui ma in una tabella di join*/
                                                    /*$f->motivo = normalizzaNome($_POST['motivo']); */ /*in attesa di decidere*/
                                                    $a = new Appartenenza();
                                                    $a->volontario  = $me->id;
                                                    $a->comitato    = $c;
                                                    $a->stato =     TRASF_INCORSO;
                                                    $a->timestamp = time();
                                                    $a = new Trasferimento();
                                                    $a->stato= TRASF_INCORSO;
                                                    $a->appartenenza = $c;
                                                    $a->volontario = $me->id;
                                                    $a->motivo = $m;
                                                    $a->timestamp = time();
                                                    $m = new Email('richiestaTrasferimento', 'Richiesta trasferimento: ' . $a->comitato()->nome);
                                                    $m->a = $me;
                                                    $m->_NOME       = $me->nome;
                                                    $m->_COMITATO   = $a->comitato()->nome;
                                                    $m-> _TIME = date('d-m-Y', $a->timestamp);
                                                    $m->invia();
                                                    redirect('trasferimento&ok');
                                                             }
                                                            }
                               

                                      
?>



