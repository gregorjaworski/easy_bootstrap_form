<?php
register_activation_hook( __FILE__, 'boj_myplugin_activate' );
function boj_myplugin_activate() {
// Rejestracja funkcji odinstalowania.
register_uninstall_hook( __FILE__, 'boj_myplugin_uninstaller' );
}
function boj_myplugin_uninstaller() {
// Usunięcie wszelkich opcji, tabel itd. utworzonych przez wtyczkę.
delete_option( 'boj_myplugin_options' );
}
