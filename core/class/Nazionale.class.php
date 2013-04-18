<?php

/*
 * ©2013 Croce Rossa Italiana
 */

class Nazionale extends GeoEntita {
        
    protected static
        $_t  = 'nazionali',
        $_dt = 'datiNazionali';

    public function regionali() {
        return Regionale::filtra([
            ['nazionale',  $this->id]
        ]);
    }
    
    public function toJSON() {
        $regionali = $this->regionali();
        foreach ( $regionali as &$regionale ) {
            $regionale = $regionale->toJSON();
        }
        return [
            'nome'          =>  $this->nome,
            'regionali'     =>  $regionali
        ];
    }
    
}