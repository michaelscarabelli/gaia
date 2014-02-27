<?php

/*
 * ©2012 Croce Rossa Italiana
 */

class Email {
    
    private
            $sostituzioni   = [],
            $allegati       = [],
            $modello        = '';
    
    public
            $a          = null,
            $oggetto    = '',
            $da         = null;
    
    public function __construct ( $modello, $oggetto ) {
        if ( !file_exists(static::_file_modello($modello)) ) {
            throw new Errore(1012);
        }
        $this->oggetto = $oggetto;
        $this->modello = $modello;
    }

    protected static function _file_modello($modello) {
        return "./core/conf/mail/modelli/{$modello}.html";
    }
    
    public function __set($nome, $valore) {
        $this->sostituzioni[$nome] = $valore;
    }
    
    public function allega(File $f) {
        $this->allegati[] = $f;
    }

    /**
     * Costruisce il corpo, effettua sostituzioni e ritorna
     * @return string Corpo del messaggio in HTML
     */
    protected function _costruisci_corpo() {
        $header     = file_get_contents('./core/conf/mail/header.html');
        $footer     = file_get_contents('./core/conf/mail/footer.html');
        $corpo      = file_get_contents(static::_file_modello($this->modello));
        foreach ( $this->sostituzioni as $nome => $valore ) {
            $corpo = str_replace($nome, $valore, $corpo);
        }
        $corpo  = 
            "<html>
                {$header}
                {$corpo}
                {$footer}
            </html>\n";
        return $corpo;
    }

    /** 
     * Costruisce il destinatario (come oggetto) e ritorna
     * @return Oggetto del destinatario
     */
    protected function _costruisci_destinatari() {
        if ( $this->a === null ) {
            // NESSSUN DESTINATARIO
            return true;    // TRUE = SUPPORTO

        } elseif ( is_array($this->a) ) {
            // DESTINATARI MULTIPLI
            $d = [];
            foreach ( $this->a as $k ) {
                $d[] = [
                    'id'        =>  (int) $k->id,
                    'inviato'   =>  false
                ];
            }
            return $d;

        } else {
            // SINGOLO DESTINATARIO?
            $this->a = [$this->a];
            return $this->_costruisci_destinatari();
        }
    }

    /**
     * Costruisce il mittente (come oggetto oppure null) e ritorna
     * @return Oggetto del mittente 
     */
    protected function _costruisci_mittente() {
        if ( $this->da ) {
            return [
                'id'    =>  (int) $this->da->id
            ];
        } else {
            return false;
        }
    }

    /**
     * Costruisce gli allegati (come array) e ritorna
     * @return Array Gli allegati
     */
    protected function _costruisci_allegati() {
        if ( $this->allegati ) {
            $r = [];
            foreach ( $this->allegati as $a ) {
                $r[] = [
                    'id'    =>  $a->id,
                    'nome'  =>  $a->nome
                ];
            }
            return $r;

        } else {
            return [];
        }
    }

    /**
     * Accoda ed invia rapidamente l'email desiderata
     * @return bool Operazione riuscita?
     */
    public function invia() {
        return $this->accoda()->invia();

    }

    /**
     * Salva questa Email sul database (relativa MEntita)
     * @return MEmail creata
     */
    public function accoda() {

        $x = new MEmail;
        $x->timestamp   = (int) time();
        $x->oggetto     = $this->oggetto;
        $x->corpo       = $this->_costruisci_corpo();
        $x->mittente    = $this->_costruisci_mittente();
        $x->allegati    = $this->_costruisci_allegati();
        $x->destinatari = $this->_costruisci_destinatari();
        $x->invio       = [
            'iniziato'  =>  false,
            'terminato' =>  false
        ];
        return $x;

    }

     
}
