<?php

/* 
 * Tabella di esempio
 * 
 * utilizzare sqlite per accedere al database idenficato da $dbpath
 * utilizzare smarty per il render della pagina, utilizzare il file templates/index.tpl
 * visualizzare il contenuto della tabella tbl_sedi con i seguenti criteri
 *   - realizzare una tabella responsive. La pagina deve essere leggibile da uno smartphone, è consentito l'uso di scroll orizzontali
 *   - la tabella deve essere paginata e ricercabile, si possono utilizzare librerie js
 *   - visualizzare solo i campi numero_iscrizine_int, tipo_sede, comune_sede, provincia_sede, cap_sede, indirizzo_sede
 *   - utilizzare come intestazione i nomi dei campi senza underscore
 *
*/

// librerie
require(__DIR__.'/vendor/autoload.php');


// lettura database
$dbpath=__DIR__.'/testdb.sqlite3';
$sqlcon=new SQLite3($dbpath);
/*
 * eseguire la query e salvare l'array dei risultati in $risultati
*/
$r=$sqlcon->query("select * from tbl_sedi");
$risultati=array();
while($rec=$r->fetchArray(1))
    array_push($risultati,$rec);
$sqlcon->close();


// inizializzazione smarty
$smarty = new Smarty();
$smarty->setTemplateDir('templates');
$smarty->setConfigDir('var/config');
$smarty->setCompileDir('var/compile');
$smarty->setCacheDir('var/cache');


$smarty->assign('risultati', $risultati);
//$smarty->assign('rarray',var_dump($risultati));
$smarty->display('index.tpl');

