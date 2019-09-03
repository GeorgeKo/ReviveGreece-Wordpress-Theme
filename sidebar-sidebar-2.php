<?php
echo ("Runs");
ob_start();
dynamic_sidebar( 'my-sidebar-id' );
$sidebar_output = ob_get_clean();
echo apply_filters( 'my_sidebar_output', $sidebar_output );