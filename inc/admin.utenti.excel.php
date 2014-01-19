<?php

/*
 * ©2013 Croce Rossa Italiana
 */

paginaApp([APP_SOCI , APP_PRESIDENTE,APP_CO, APP_OBIETTIVO]);

$zip = new Zip();

foreach ( $me->comitatiApp ([ APP_SOCI, APP_PRESIDENTE,APP_CO, APP_OBIETTIVO ]) as $c ) {

    $excel = new Excel();
    $i=0;

    if(isset($_GET['riserva'])){
        $excel->intestazione([
            'N.',
            'Nome',
            'Cognome',
            'Data Nascita',
            'Luogo Nascita',
            'Provincia Nascita',
            'C. Fiscale',
            'Indirizzo Res.',
            'Civico',
            'Comune Res.',
            'Cap Res.',
            'Provincia Res.',
            'Inizio Riserva',
            'Fine Riserva',
            'Numero Protocollo',
            'Data Protocollo',
            'Motivazione'
            ]);
    }elseif(isset($_GET['mass'])){
        $excel->intestazione([
            'N.',
            'Nome',
            'Cognome',
            'Data Nascita',
            'Luogo Nascita',
            'Provincia Nascita',
            'C. Fiscale',
            'eMail',
            'eMail Servizio',
            'Cellulare',
            'Cell. Servizio',
            'Titolo',
            'Conseguimento',
            'Luogo',
            'Scadenza',
            'Codice',
            'Data ingresso CRI'
            ]);
    }else{
        $excel->intestazione([
            'N.',
            'Nome',
            'Cognome',
            'Data Nascita',
            'Luogo Nascita',
            'Provincia Nascita',
            'C. Fiscale',
            'Indirizzo Res.',
            'Civico',
            'Comune Res.',
            'Cap Res.',
            'Provincia Res.',
            'eMail',
            'eMail Servizio',
            'Cellulare',
            'Cell. Servizio',
            'Data ingresso CRI'
            ]);
    }
    if(isset($_GET['dimessi'])){
        foreach ( $c->membriDimessi as $v ) {
            $i++; 
            $excel->aggiungiRiga([
                $i,
                $v->nome,
                $v->cognome,
                date('d/m/Y', $v->dataNascita),
                $v->comuneNascita,
                $v->provinciaNascita,
                $v->codiceFiscale,
                $v->indirizzo,
                $v->civico,
                $v->comuneResidenza,
                $v->CAPResidenza,
                $v->provinciaResidenza,
                $v->email,
                $v->emailServizio,
                $v->cellulare,
                $v->cellulareServizio,
                $v->ingresso()->format("d/m/Y")
                ]);

        }
        $excel->genera("Volontari dimessi {$c->nome}.xls");
    }elseif(isset($_GET['giovani'])){
        foreach ( $c->membriAttuali() as $v ) {
            $t = time()-GIOVANI;
            if ($t <=  $v->dataNascita){
                $i++; 
                $excel->aggiungiRiga([
                    $i,
                    $v->nome,
                    $v->cognome,
                    date('d/m/Y', $v->dataNascita),
                    $v->comuneNascita,
                    $v->provinciaNascita,
                    $v->codiceFiscale,
                    $v->indirizzo,
                    $v->civico,
                    $v->comuneResidenza,
                    $v->CAPResidenza,
                    $v->provinciaResidenza,
                    $v->email,
                    $v->emailServizio,
                    $v->cellulare,
                    $v->cellulareServizio,
                    $v->ingresso()->format("d/m/Y")
                    ]);

            }
        }
        $excel->genera("Volontari giovani {$c->nome}.xls");
    }elseif(isset($_GET['eleatt'])){
        $time = $_GET['time'];
        $time = DT::daTimestamp($time);
        
        foreach ( $c->elettoriAttivi($time) as $v ) {
            $i++; 
            $excel->aggiungiRiga([
                $i,
                $v->nome,
                $v->cognome,
                date('d/m/Y', $v->dataNascita),
                $v->comuneNascita,
                $v->provinciaNascita,
                $v->codiceFiscale,
                $v->indirizzo,
                $v->civico,
                $v->comuneResidenza,
                $v->CAPResidenza,
                $v->provinciaResidenza,
                $v->email,
                $v->emailServizio,
                $v->cellulare,
                $v->cellulareServizio,
                $v->ingresso()->format("d/m/Y")
                ]);
            
        }
        $excel->genera("Elettorato attivo {$c->nome}.xls");
    }elseif(isset($_GET['elepass'])){
        $time = $_GET['time'];
        $time = DT::daTimestamp($time);
        
        foreach ( $c->elettoriPassivi($time) as $v ) {
            $i++; 
            $excel->aggiungiRiga([
                $i,
                $v->nome,
                $v->cognome,
                date('d/m/Y', $v->dataNascita),
                $v->comuneNascita,
                $v->provinciaNascita,
                $v->codiceFiscale,
                $v->indirizzo,
                $v->civico,
                $v->comuneResidenza,
                $v->CAPResidenza,
                $v->provinciaResidenza,
                $v->email,
                $v->emailServizio,
                $v->cellulare,
                $v->cellulareServizio,
                $v->ingresso()->format("d/m/Y")
                ]);
            
        }
        $excel->genera("Elettorato passivo {$c->nome}.xls");
    }elseif(isset($_GET['quoteno'])){
        foreach ( $c->quoteNo() as $v ) {
            $i++; 
            $excel->aggiungiRiga([
                $i,
                $v->nome,
                $v->cognome,
                date('d/m/Y', $v->dataNascita),
                $v->comuneNascita,
                $v->provinciaNascita,
                $v->codiceFiscale,
                $v->indirizzo,
                $v->civico,
                $v->comuneResidenza,
                $v->CAPResidenza,
                $v->provinciaResidenza,
                $v->email,
                $v->emailServizio,
                $v->cellulare,
                $v->cellulareServizio,
                $v->ingresso()->format("d/m/Y")
                ]);

        }
        $excel->genera("Volontari mancato pagamento quota {$c->nome}.xls");
    }elseif(isset($_GET['quotesi'])){
        foreach ( $c->quoteSi() as $v ) {
            $i++; 
            $excel->aggiungiRiga([
                $i,
                $v->nome,
                $v->cognome,
                date('d/m/Y', $v->dataNascita),
                $v->comuneNascita,
                $v->provinciaNascita,
                $v->codiceFiscale,
                $v->indirizzo,
                $v->civico,
                $v->comuneResidenza,
                $v->CAPResidenza,
                $v->provinciaResidenza,
                $v->email,
                $v->emailServizio,
                $v->cellulare,
                $v->cellulareServizio,
                $v->ingresso()->format("d/m/Y")
                ]);

        }
        $excel->genera("Volontari quota pagata {$c->nome}.xls");
    }elseif(isset($_GET['mass'])){
        $f = $_GET['t'];
        $f= new Titolo($f);
        $volontari =  $c->ricercaMembriTitoli([$f]);
        foreach($volontari as $v){
            $titolo = TitoloPersonale::filtra([['volontario', $v],['titolo', $f]]);
            $titolo = $titolo[0];
            $i++; 
            $excel->aggiungiRiga([
                $i,
                $v->nome,
                $v->cognome,
                date('d/m/Y', $v->dataNascita),
                $v->comuneNascita,
                $v->provinciaNascita,
                $v->codiceFiscale,
                $v->email,
                $v->emailServizio,
                $v->cellulare,
                $v->cellulareServizio,
                $f->nome,
                $titolo->inizio()->format("d/m/Y"),
                $titolo->luogo,
                $titolo->fine()->format("d/m/Y"),
                $titolo->codice,
                $v->ingresso()->format("d/m/Y")
                ]);
        }
        $excel->genera("Risultati in {$c->nomeCompleto()}.xls");
    }elseif(isset($_GET['riserva'])){
        foreach ( $c->membriRiserva() as $v ) {
            $r = $v->unaRiserva();
            $i++; 
            $excel->aggiungiRiga([
                $i,
                $v->nome,
                $v->cognome,
                date('d/m/Y', $v->dataNascita),
                $v->comuneNascita,
                $v->provinciaNascita,
                $v->codiceFiscale,
                $v->indirizzo,
                $v->civico,
                $v->comuneResidenza,
                $v->CAPResidenza,
                $v->provinciaResidenza,
                date('d/m/Y',$r->inizio),
                date('d/m/Y',$r->fine),
                $r->protNumero,
                date('d/m/Y',$r->protData),
                $r->motivo
                ]);

        }
        $excel->genera("Volontari riserva {$c->nome}.xls");
    }elseif(isset($_GET['estesi'])){
        $a = Appartenenza::filtra([
            ['comitato', $c->id],
            ['stato', MEMBRO_ESTESO]
            ]); 
        foreach ( $a as $_a ) {
            $v = $_a->volontario();
            $i++; 
            $excel->aggiungiRiga([
                $i,
                $v->nome,
                $v->cognome,
                date('d/m/Y', $v->dataNascita),
                $v->comuneNascita,
                $v->provinciaNascita,
                $v->codiceFiscale,
                $v->indirizzo,
                $v->civico,
                $v->comuneResidenza,
                $v->CAPResidenza,
                $v->provinciaResidenza,
                $v->email,
                $v->emailServizio,
                $v->cellulare,
                $v->cellulareServizio,
                $v->ingresso()->format("d/m/Y")
                ]);

        }
        $excel->genera("Volontari estesi {$c->nome}.xls");
    }elseif(isset($_GET['inestensione'])){
        $eok = Estensione::filtra([
            ['cProvenienza', $c],
            ['stato', EST_OK]
            ]);
        $eauto = Estensione::filtra([
            ['cProvenienza', $c],
            ['stato', EST_AUTO]
            ]);
        $estesi = array_merge($eok, $eauto);
        foreach ( $estesi as $est ) {
            $v = $est->volontario();
            $i++; 
            $excel->aggiungiRiga([
                $i,
                $v->nome,
                $v->cognome,
                date('d/m/Y', $v->dataNascita),
                $v->comuneNascita,
                $v->provinciaNascita,
                $v->codiceFiscale,
                $v->indirizzo,
                $v->civico,
                $v->comuneResidenza,
                $v->CAPResidenza,
                $v->provinciaResidenza,
                $v->email,
                $v->emailServizio,
                $v->cellulare,
                $v->cellulareServizio,
                $v->ingresso()->format("d/m/Y")
                ]);

        }
        $excel->genera("Volontari in estensione {$c->nome}.xls");
    }elseif(isset($_GET['soci'])){
        foreach ( $c->membriAttuali(MEMBRO_VOLONTARIO) as $v ) {
            $i++;    
            $excel->aggiungiRiga([
                $i,
                $v->nome,
                $v->cognome,
                date('d/m/Y', $v->dataNascita),
                $v->comuneNascita,
                $v->provinciaNascita,
                $v->codiceFiscale,
                $v->indirizzo,
                $v->civico,
                $v->comuneResidenza,
                $v->CAPResidenza,
                $v->provinciaResidenza,
                $v->email,
                $v->emailServizio,
                $v->cellulare,
                $v->cellulareServizio,
                $v->ingresso()->format("d/m/Y")
                ]);

        }
        $excel->genera("Elenco Soci {$c->nome}.xls");
    }else{
        foreach ( $c->membriAttuali() as $v ) {
            $i++;    
            $excel->aggiungiRiga([
                $i,
                $v->nome,
                $v->cognome,
                date('d/m/Y', $v->dataNascita),
                $v->comuneNascita,
                $v->provinciaNascita,
                $v->codiceFiscale,
                $v->indirizzo,
                $v->civico,
                $v->comuneResidenza,
                $v->CAPResidenza,
                $v->provinciaResidenza,
                $v->email,
                $v->emailServizio,
                $v->cellulare,
                $v->cellulareServizio,
                $v->ingresso()->format("d/m/Y")
                ]);

        }
        $excel->genera("Volontari {$c->nome}.xls");
    }
    
    
    $zip->aggiungi($excel);

}
if(isset($_GET['dimessi'])){
 $zip->comprimi("Anagrafica volontari dimessi.zip"); 
}elseif(isset($_GET['giovani'])){
 $zip->comprimi("Anagrafica volontari giovani.zip"); 
}elseif(isset($_GET['eleatt'])){
 $zip->comprimi("Elettorato attivo.zip"); 
}elseif(isset($_GET['elepass'])){
 $zip->comprimi("Elettorato passivo.zip"); 
}elseif(isset($_GET['quoteno'])){
 $zip->comprimi("volontari quota non versata.zip"); 
}elseif(isset($_GET['quotesi'])){
 $zip->comprimi("Volontari quota versata.zip"); 
}elseif(isset($_GET['mass'])){
 $zip->comprimi("Volontari con titolo {$f->nome}.zip"); 
}elseif(isset($_GET['riserva'])){
 $zip->comprimi("Volontari in riserva {$f->nome}.zip"); 
}elseif(isset($_GET['estesi'])){
 $zip->comprimi("Volontari estesi.zip"); 
}elseif(isset($_GET['inestensione'])){
 $zip->comprimi("Volontari in estensione.zip"); 
}elseif(isset($_GET['soci'])){
 $zip->comprimi("Elenco soci.zip"); 
}else{
    $zip->comprimi("Anagrafica_volontari.zip");
}
$zip->download();

?>
