<? php

// Tiré de https://gist.github.com/1809044
// Disponible sur https://gist.github.com/nichtich/5290675#file-deploy-php

$ TITLE    = 'Hamster de déploiement Git' ;
$ VERSION = '0,11' ;

echo <<< EOT
<! DOCTYPE HTML>
<html lang = "en-US">
<head>
	<meta charset = "UTF-8">
	<title> $ TITLE </title>
</head>
<body style = "background-color: # 000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
<pre>
  oo $ TITLE
 / \\ "/ \ v $ VERSION
(`= * = ') 
 ^ --- ^ `-.
EOT ;

// Vérifier si le client est autorisé à déclencher une mise à jour

$ allowed_ips = tableau (
	«207.97.227.» , " 50 .57.128." , «108.171.174.» , « 50 .57.231.» , «204.232.175.» , «192.30.252.» , // GitHub
	«195.37.139.» , «193.174.»  // VZG
);
$ autorisé = faux ;

$ headers = apache_request_headers ();

if (@ $ headers [ "X-Forwarded-For" ]) {
    $ ips = exploser ( "," , $ headers [ "X-Forwarded-For" ]);
    $ ip   = $ ips [ 0 ];
} else {
    $ ip = $ _SERVER [ 'REMOTE_ADDR' ];
}

foreach ( $ allowed_ips  comme  $ allow ) {
    if ( stripos ( $ ip , $ allow )! == false ) {
        $ autorisé = vrai ;
        pause ;
    }
}

si (! $ autorisé ) {
	en-tête ( 'HTTP / 1.1 403 interdit' );
 	echo  "<span style = \" color: # ff0000 \ "> Désolé, pas de hamster - mieux vaut convaincre tes parents! </span> \ n" ;
    echo  "</pre> \ n </body> \ n </html>" ;
    sortie;
}

flush ();

// Lancer la mise à jour en fait

$ commandes = tableau (
	'echo $ PWD' ,
	'whoami' ,
	'git pull' ,
	'git status' ,
	'git submodule sync' ,
	'mise à jour du sous-module git' ,
	'état du sous-module git' ,
    'test -e / usr / share / update-notifier / notifier-reboot-required && echo "redémarrage du système requis"' ,
);

$ sortie = "\ n" ;

$ log = "#######" . date ( 'Ymd H: i: s' ). "####### \ n" ;

foreach ( $ commandes  AS  $ commande ) {
    // Exécuter
    $ tmp = shell_exec ( "$ commande 2> & 1" );
    // Production
    $ output . = "<span style = \" color: # 6BE234; \ "> \ $ </span> <span style = \" color: # 729FCF; \ "> {$ command} \ n </span>" ;
    $ output . = htmlentities ( trim ( $ tmp )). "\ n" ;

    $ log   . = "\ $ $ commande \ n" . trim ( $ tmp ). "\ n" ;
}

$ log . = "\ n" ;

file_put_contents ( 'deploy-log.txt' , $ log , FILE_APPEND );

echo  $ sortie ;

?>
</ pré >
</ corps >
</ html >