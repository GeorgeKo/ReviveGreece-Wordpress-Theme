        </main>

        </div>

        <footer>
            <div class="footer-container">
                <h3>Quick Menu</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-navigation',
                    'container'      => 'div',
                    'menu_class'     => 'footer-navigation',
                    'menu_id'        => 'footer-navigation'
                ));
                ?>
            </div>
            <p class="footer-copyright">
                &copy; <?php echo date("Y");
                        echo " ";
                        echo bloginfo('name'); ?>
                <?php printf(__('| Developed by %1$s', 'Giko'), '<a href="https//giko.gr" title="GiKo Personal Site"> George Koryllos</a>'); ?>
            </p>
        </footer>

        <?php wp_footer(); ?>
        </div>
        <!--page-container-->
        </body>

        </html>