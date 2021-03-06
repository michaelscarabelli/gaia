<?php

/*
 * ©2013 Croce Rossa Italiana
 */

class Zip extends File {
    
    public 
            $file = [];

    
    public function aggiungi($f) {
        $this->file[] = $f;
    }
    
    public function comprimi($nome) {
        $this->nome = $nome;
        $this->mime = 'application/zip';
        $zip = new ZipArchive;
        $zip->open($this->percorso(), ZIPARCHIVE::CREATE);
        foreach ( $this->file as $f ) {
            $zip->addFile($f->percorso(), $f->nome);
        }
        $zip->close();
        foreach ( $this->file as $f ) {
            $f->cancella();
        }
    }
    
}