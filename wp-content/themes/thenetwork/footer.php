<?php

/**

 * The template for displaying the footer.

 *

 * Contains the closing of the #content div and all content after

 *

 * @package understrap

 */

//$setting = new Setting(15);
if(!hideCTA()) { ?>
<div class="become-a-member-wrapper">
    <?=do_shortcode('[member_cta]')?>
</div>
<?php
}
?>
<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <h3>Links</h3>
                <?php wp_nav_menu(

                    array(

                        'theme_location'  => 'footer-menu',

                        'container_class' => 'footer-menu-wrapper',

                        'container_id'    => '',

                        'menu_class'      => '',

                        'fallback_cb'     => '',

                        'menu_id'         => 'footer-menu',

                        'walker'          => new understrap_WP_Bootstrap_Navwalker(),

                    )

                ); ?>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-5 contact-details-col">
                <h3>Contact</h3>
                <ul class="contacts">
                    <li><span class="fa fa-envelope"></span><a href="mailto:<?=get_option('email')?>"><?=get_option('email')?></a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 social-media-col">
                <h3>Follow Us</h3>
                <?=socialMediaMenu()?>
            </div>
        </div>
    </div>
</section>
<section id="copyright">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                Copyright <?=get_bloginfo('name')?>. <span>Website by <a href="https://www.designgarage.co.nz/" target="_blank">Design Garage</a></span>
            </div>
        </div>
    </div>
</section>
<?php wp_footer(); ?>
</body>
</html>