<?php
/* 
Plugin Name: Hello There
Author: Paweł Kwieciński
*/

function twardowska_get_lyric() {
	/** These are the lyrics to Hello Dolly */
	$lyrics = "Jedzą, piją, lulki palą,
    Tańce, hulanka, swawola;
    Ledwie karczmy nie rozwalą,
    Cha cha, chi chi, hejza, hola!
    Twardowski siadł w końcu stoła.
    Podparł się w boki jak basza;
    Hulaj dusza! hulaj! - woła,
    Śmieszy, tumani, przestrasza.
    Żołnierzowi, co grał zucha,
    Wszystkich łaje i potrąca,
    Świsnął szablą koło ucha,
    Już z żołnierza masz zająca.
    Na patrona z trybunału,
    Co milczkiem wypróżniał rondel,
    Zadzwonił kieską pomału,
    Z patrona robi się kondel.
    Szewcu w nos wyciął trzy szczutki,
    Do łba przymknął trzy rureczki,
    Cmoknął, cmok, i gdańskiej wódki
    Wytoczył ze łba pół beczki.";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function twardowska() {
	$chosen = twardowska_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="dolly"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Quote from Hello Dolly song, by Jerry Herman:', 'hello-dolly' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'twardowska' );

// We need some CSS to position the paragraph.
function dolly_css() {
	echo "
	<style type='text/css'>
	#dolly {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #dolly {
		float: left;
	}
	.block-editor-page #dolly {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#dolly,
		.rtl #dolly {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'dolly_css' );



?>