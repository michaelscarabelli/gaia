<?php

/*
 * ©2012 Croce Rossa Italiana
 */

$conf['database']['tables'] = [
        [
            'name'      =>  'sessioni',
            'fields'    =>  '
                id       varchar(128) PRIMARY KEY,
                utente   int,
                azione   varchar(64),
                ip       varchar(64),
                agent    varchar(255)
            '
        ],
        [
            'name'      =>  'datiSessione',
            'fields'    =>  '
                id       varchar(128),
                nome     varchar(32),
                valore   text,
                PRIMARY KEY (id, nome)
            '
        ],
        [
            'name'      =>  'anagrafica',
            'fields'    =>  '
                id              int PRIMARY KEY,
                nome            varchar(255),
                cognome         varchar(255),
                stato           varchar(8),
                email           varchar(255),
                password        varchar(127),
                codiceFiscale   varchar(16),
                timestamp       varchar(64),
                admin           varchar(64),
                consenso varchar(64),
                INDEX (codiceFiscale),
                INDEX(email),
                FULLTEXT(nome, cognome)
            '
        ],
        [
            'name'      =>  'dettagliPersona',
            'fields'    =>  '
                id       varchar(128),
                nome     varchar(32),
                valore   text,
                PRIMARY KEY (id, nome)
            '
        ],
        [
            'name'      =>  'comitati',
            'fields'    =>  '
                id       int PRIMARY KEY,
                nome     varchar(64),
                colore   varchar(8),
                locale   int,
                geo      point NOT NULL,
                INDEX (locale),
                SPATIAL INDEX(geo)
            '
        ],
        [
            'name'      =>  'avatar',
            'fields'    =>  '
                id          int PRIMARY KEY,
                utente      varchar(64),
                timestamp   varchar(8),
                INDEX(utente)
            '
        ],
        [
            'name'      =>  'appartenenza',
            'fields'    =>  '
                id          int PRIMARY KEY,
                volontario  varchar(16),
                comitato    varchar(16),
                stato       varchar(8),
                inizio      varchar(64),
                fine        varchar(64),
                timestamp   varchar(64),
                conferma    varchar(64),
                INDEX (volontario),
                INDEX (comitato)
            '
        ],
        [
            'name'      =>  'titoli',
            'fields'    =>  '
                id          int PRIMARY KEY,
                nome        varchar(255),
                tipo        varchar(8),
                FULLTEXT ( nome )
            '
        ],
        [
            'name'      =>  'titoliPersonali',
            'fields'    =>  '
                id              int PRIMARY KEY,
                volontario      varchar(16),
                titolo          varchar(16),
                inizio          varchar(64),
                fine            varchar(64),
                luogo   varchar(64),
                codice varchar(64),
                tConferma       varchar(64),
                pConferma       varchar(64),
                INDEX (volontario)
            '
        ],
        [
            'name'      =>  'attivita',
            'fields'    =>  '
                id              int,
                stato           int,
                nome            varchar(255),
                luogo           varchar(255),
                comitato        varchar(32),
                visibilita      int,
                area            varchar(8),
                referente       varchar(32),
                geo             point NOT NULL,
                descrizione     text,
                PRIMARY KEY (id),
                INDEX (comitato),
                INDEX (referente),
                INDEX (tipo),
                INDEX (visibilita),
                SPATIAL INDEX(geo)
            '
        ],
        [
            'name'      =>  'dettagliAttivita',
            'fields'    =>  '
                id       varchar(128),
                nome     varchar(32),
                valore   text,
                PRIMARY KEY (id, nome)
            '
        ],
        [
            'name'      =>  'documenti',
            'fields'    =>  '
                id          varchar(64) PRIMARY KEY,
                volontario  varchar(16),
                tipo        varchar(8),
                timestamp   varchar(64),
                INDEX (volontario)
            '
        ],
        [
            'name'      =>  'autorizzazioni',
            'fields'    =>  '
                id              int PRIMARY KEY,
                volontario      varchar(16),
                partecipazione  varchar(16),
                timestamp       varchar(64),
                pFirma          varchar(16),
                tFirma          varchar(64),
                stato           varchar(8),
                note            text,
                INDEX ( volontario ),
                INDEX ( partecipazione )
            '
        ],
        [
            'name'      =>  'turni',
            'fields'    =>  '
                id          int PRIMARY KEY,
                attivita    varchar(16),
                nome        varchar(64),
                inizio      varchar(64),
                fine        varchar(64),
                minimo      varchar(8),
                massimo     varchar(8),
                timestamp   varchar(64),
                INDEX(attivita),
                INDEX(inizio),
                INDEX(fine)
            '
        ],
        [
            'name'      =>  'partecipazioni',
            'fields'    =>  '
                id          int PRIMARY KEY,
                volontario  varchar(16),
                turno       varchar(16),
                stato       varchar(8),
                tipo        varchar(8),
                timestamp   varchar(64),
                tConferma   varchar(64),
                pConferma   varchar(16),
                INDEX ( volontario ),
                INDEX ( turno )
            '
        ],
    [
            'name'      =>  'riserve',
            'fields'    =>  '
                id              int PRIMARY KEY,
                stato           varchar(16),
                appartenenza    varchar(16),
                volontario      varchar(16),
                inizio      varchar(64),
                fine        varchar(64),
                protNumero      varchar(16),
                protData        varchar(64),
                motivo          text,
                negazione       text,
                timestamp       varchar(64),
                pConferma       varchar(16),
                tConferma       varchar(64),
                INDEX ( appartenenza ),
                INDEX ( volontario )'
            
        ],
        [
            'name'  =>  'delegati',
            'fields'    =>  '
                id              int PRIMARY KEY,
                comitato        varchar(16),
                volontario      varchar(16),
                applicazione    varchar(16),
                dominio         varchar(16),
                inizio          varchar(64),
                fine            varchar(64),
                pConferma       varchar(16),
                tConferma       varchar(64),
                INDEX ( comitato),
                INDEX (volontario),
                INDEX (applicazione)'
        ],
        [
           
            'name'  =>  'trasferimenti',
            'fields'    =>  '
                id              int PRIMARY KEY,
                stato           varchar(16),
                appartenenza    varchar(16),
                volontario      varchar(16),
                protNumero      varchar(16),
                protData        varchar(64),
                motivo          text,
                negazione       text,
                timestamp       varchar(64),
                pConferma       varchar(16),
                tConferma       varchar(64),
                INDEX ( appartenenza ),
                INDEX ( volontario )'
        ],       
        [
           
            'name'  =>  'file',
            'fields'    =>  '
                id              varchar(64) PRIMARY KEY,
                creazione       varchar(64),
                autore          varchar(16),
                scadenza        varchar(64),
                mime            varchar(64),
                nome            varchar(255),
                download        int,
                INDEX ( scadenza )
            '
        ],
        [
            'name'      =>  'datiComitati',
            'fields'    =>  '
                id       varchar(128),
                nome     varchar(32),
                valore   text,
                PRIMARY KEY (id, nome)
            '
        ],
        [       
            'name'  =>  'locali',
            'fields'    =>  '
                id              int PRIMARY KEY,
                nome            varchar(255),
                geo             point NOT NULL,
                provinciale     int,
                INDEX ( provinciale ),
                SPATIAL INDEX (geo)
            '
        ],
        [       
            'name'  =>  'provinciali',
            'fields'    =>  '
                id              int PRIMARY KEY,
                nome            varchar(255),
                geo             point NOT NULL,
                regionale     int,
                INDEX ( regionale ),
                SPATIAL INDEX (geo)
            '
        ],
        [       
            'name'  =>  'regionali',
            'fields'    =>  '
                id              int PRIMARY KEY,
                nome            varchar(255),
                geo             point NOT NULL,
                nazionale     int,
                INDEX ( nazionale ),
                SPATIAL INDEX (geo)
            '
        ],       
        [       
            'name'  =>  'nazionali',
            'fields'    =>  '
                id              int PRIMARY KEY,
                nome            varchar(255),
                geo             point NOT NULL,
                SPATIAL INDEX (geo)
            '
        ],
        [
                'name'      =>  'gruppiPersonali',
                'fields'    =>  '
                    id          int PRIMARY KEY,
                    volontario  varchar(16),
                    appartenenza    varchar(16),
                    inizio      varchar(64),
                    fine        varchar(64),
                    timestamp   varchar(64),
                    INDEX (volontario)
                 '
            ],
            [
            'name'      =>  'datiLocali',
            'fields'    =>  '
                id       varchar(128),
                nome     varchar(32),
                valore   text,
                PRIMARY KEY (id, nome)
            '
        ],
        [
            'name'      =>  'datiProvinciali',
            'fields'    =>  '
                id       varchar(128),
                nome     varchar(32),
                valore   text,
                PRIMARY KEY (id, nome)
            '
        ],
        [
            'name'      =>  'datiRegionali',
            'fields'    =>  '
                id       varchar(128),
                nome     varchar(32),
                valore   text,
                PRIMARY KEY (id, nome)
            '
        ],
        [
            'name'      =>  'datiNazionali',
            'fields'    =>  '
                id       varchar(128),
                nome     varchar(32),
                valore   text,
                PRIMARY KEY (id, nome)
            '
        ],
        [
            'name'  =>  'gruppi',
            'fields'    =>  '
                id      int PRIMARY KEY,
                comitato    varchar(16),
                nome        varchar(255),
                obiettivo   varchar(8),
                area        varchar(16),
                referente   varchar(16),
                INDEX(comitato),
                INDEX(referente)'
        ],
        [
            'name'  =>  'aree',
            'fields'    =>  '
                id              int PRIMARY KEY,
                nome            varchar(255),
                comitato        varchar(16),
                responsabile    varchar(16),
                obiettivo       varchar(8),
                INDEX(comitato),
                INDEX(responsabile)'
        ],
        [
                'name'  =>  'reperibilita',
                'fields'    =>  '
                    id              int PRIMARY KEY,
                    volontario            varchar(16),
                    comitato        varchar(16),
                    inizio    varchar(64),
                    fine       varchar(64),
                    attivazione varchar(255),
                    INDEX(comitato),
                    INDEX(volontario),
                    INDEX(inizio),
                    INDEX(fine)'
            ],
            [
                        'name'  =>  'corsobase',
                        'fields'    =>  '
                            id              int PRIMARY KEY,
                            volontario            varchar(16),
                            locale        varchar(16),
                            corso       varchar(16),
                            INDEX(corso),
                            INDEX(volontario)'
            ],
            [
                        'name'  =>  'corsi',
                        'fields'    =>  '
                            id              int PRIMARY KEY,
                            nome            varchar(16),
                            informazioni        varchar(16),
                            INDEX(nome)'
            ],
            [
                        'name'  =>  'coturni',
                        'fields'    =>  '
                            id              int PRIMARY KEY,
                            volontario            varchar(16),
                            appartenenza        varchar(16),
                            turno varchar(16),
                            stato    varchar(64),
                            pMonta       varchar(16),
                            tMonta varchar(64),
                            pSmonta       varchar(16),
                            tSmonta varchar(64),
                            INDEX(comitato),
                            INDEX(volontario),
                            INDEX(turno)'
                    ],
                    [
                            'name'      =>  'dimissioni',
                            'fields'    =>  '
                                id          int PRIMARY KEY,
                                volontario  varchar(16),
                                appartenenza varchar(16),
                                comitato    varchar(16),
                                motivo varchar(255),
                                info varchar(255),
                                tConferma    varchar(64),
                                pConferma varchar(16),
                                INDEX (volontario),
                                INDEX (comitato),
                                INDEX (appartenenza)
                            '
                        ],
                        [
                            'name'      =>  'commenti',
                            'fields'    =>  '
                                id          int PRIMARY KEY,
                                attivita  varchar(16),
                                commento varchar(255),
                                volontario    varchar(64),
                                tCommenta varchar(16),
                                upCommento varchar(16),
                                INDEX (volontario),
                                INDEX (attivita)
                            '
                        ]
];
