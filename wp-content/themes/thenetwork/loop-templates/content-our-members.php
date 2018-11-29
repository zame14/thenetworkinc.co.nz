<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/23/2018
 * Time: 12:51 PM
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="section yellow">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <h1><?=get_the_title($post_id)?></h1>
                    <div class="page-intro"><?=the_content()?></div>
                </div>
            </div>
        </div>
    </div>
    <?=do_shortcode('[wpv-view name="search-members"]')?>
</article>
