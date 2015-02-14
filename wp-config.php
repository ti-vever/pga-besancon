<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */
define('ENVIRONNEMENT','development');

switch(ENVIRONNEMENT){
	case "development":
		$db_name = 'pgabesancon';
		$db_user = 'root';
		$db_password = '';
		$db_host = 'localhost';
	break;

	case "production":
		$db_name = 'pgabesanpproot';
		$db_user = 'pgabesanpproot';
		$db_password = 'sAx02T3on6';
		$db_host = 'pgabesanpproot.mysql.db';

	break;
}
// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', $db_name);

/** Utilisateur de la base de données MySQL. */
define('DB_USER', $db_user);

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', $db_password);

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', $db_host);

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'eGw,4t4= [sl ^l|z$ H9YMv?~z6k)WZI%`1]++0R/|y9[/7|^N9){*@,-[f3X)h');
define('SECURE_AUTH_KEY',  'Z7mvZ)U+xW1^,vU (%0|a,M-0jX(>I|E7SJVAyT-RFq|%bU+0MJJG-Q&X~m~iXU%');
define('LOGGED_IN_KEY',    '6:2,_RgF)y^>|+-&Pn+@ZjK+YTOZa ,2-kEP?G){~-C_ -n_r7|pt-qmA+{pe+|>');
define('NONCE_KEY',        'o}q TJ|oYcmbTJ}+%sPi0=Sj|#wCblmdL6LpZFT6JtRNx{1-Q7:3!GtK;YQV/VRF');
define('AUTH_SALT',        '|7fq,)M*<|-@KU5I7Hd)A,RjX1sw+-<VlZzV{6rsXZp5{!&aud!4i]L:)V~hRskS');
define('SECURE_AUTH_SALT', 'GC-~_{LgH/PP>V*UOG[&$M3aYQ8_]Jur0D$Pgz59oKnuMK=f|YX+OD-szSEeg|xu');
define('LOGGED_IN_SALT',   '[U-K2M yC1|S^cgnK`NY(.RiI IA1P1lJ)Zu<g_|:GrY(6kvj+Gm:=xhR/]9-!h`');
define('NONCE_SALT',       'Fq]5L,J.+2jtE&=+l/><gb72nJnTKTl&I/ G%wLOB7=a+41}*!3m~zTuzuKAP69M');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', true);


define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'www.pga-besancon.eu');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');