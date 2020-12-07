<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

define('FS_METHOD', 'direct');

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'reservistaativobd_site' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'diegocordeiro' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', 'd12345678d' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ',t[}:wbD$VZh%k;:jOk:2{Wt-acPIxR3Kb!8BAI!eTwuw~$O %SeE5py/nOA/<o-' );
define( 'SECURE_AUTH_KEY',  '@%7Y<>Eq(i4yrQJQ g_ =o]ol[iB6NKPu(Os1)Zj`fp0(v$9uLoqA*=q{= .tqoD' );
define( 'LOGGED_IN_KEY',    '2?c8s1d1GU(RsV$$.nCU2b3 3L.woC}o4/^$I;#|[Oyg]SSF?W~;b,Z )ZJQDj>g' );
define( 'NONCE_KEY',        'Jn>V#wq-nhMu#5ajJg7Dha[WlFR<-!(EQ/P=8&U^26cv*dSi<]i)|OaCOwlJa3rY' );
define( 'AUTH_SALT',        'pq-?CIpF+-E]B;C}sbK|n6L**csz.Q;3`sD8,=7~GDB=P*i.`S[SRLVX%8wnej>R' );
define( 'SECURE_AUTH_SALT', '%XU*aI[;Xn1>=N)QdMvhzt(,Hx.TDEEUZB<tONnC(x0OI16ZFro|J$78/7/E!iB?' );
define( 'LOGGED_IN_SALT',   'y~{[6AEY.mMQs _mM0aU[Mf3&rcYX1JO?1mU/XqNwj+YErwONNazwj5cw2zEuH&h' );
define( 'NONCE_SALT',       'jbm&8Jsg>zGp`)OMOuJth^zIEYFT=%d~W#g?!<{AtZ0~FsLOey@&{OQSQ:,Iz0Y-' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
