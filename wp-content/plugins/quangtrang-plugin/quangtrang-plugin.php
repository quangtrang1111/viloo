<?php
/*
Plugin Name: QuangTrang Plugin
Description: Site specific code changes for quangtrang
/* Start Adding Functions Below this Line */

    add_action('after_setup_theme', 'remove_admin_bar');

    function remove_admin_bar() {
        if (current_user_can('subscriber')) {
            show_admin_bar(false);
        }
    }

/* Stop Adding Functions Below this Line */
?>