<?php
require_once('modal/class.Base.php');
require_once('modal/class.Member.php');
require_once('modal/class.Event.php');
require_once('modal/class.Setting.php');
add_action( 'wp_enqueue_scripts', 'p_enqueue_styles');
function p_enqueue_styles() {
    wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/css/bootstrap.min.css?' . filemtime(get_stylesheet_directory() . '/css/bootstrap.min.css'));
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css?' . filemtime(get_stylesheet_directory() . '/css/font-awesome.css'));
    wp_enqueue_style( 'google_font_open_sans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600');
    wp_enqueue_style( 'google_font_lato', 'https://fonts.googleapis.com/css?family=Lato:400,700');
    wp_enqueue_style( 'understrap-theme', get_stylesheet_directory_uri() . '/style.css?' . filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js?' . filemtime(get_stylesheet_directory() . '/js/bootstrap.min.js'), array('jquery'));
    wp_enqueue_script('understap-theme', get_stylesheet_directory_uri() . '/js/theme.js?' . filemtime(get_stylesheet_directory() . '/js/theme.js'), array('jquery'));
}
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php.
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

// image sizes
add_image_size( 'member-home', 180, 210, true);
add_image_size( 'event-home', 430, 285, true);
add_image_size( 'standard', 575, 575, true);

function topMenu() {
    if(is_user_logged_in()) {
        $html = '
        <ul>
            <li><a href="' . get_page_link(147) . '">My account</a></li>
            <li><a href="' . wp_logout_url('/') . '">Log out</a></li>
        </ul>';
    } else {
        $html = '
        <ul>
            <li><a href="' . get_page_link(119) . '">Become a member</a></li>
            <li><a href="' . get_page_link(147) . '">Sign in</a></li>
        </ul>';
    }

    return $html;
}
add_action('init', 'dt_register_menus');
function dt_register_menus() {
    register_nav_menus(
        Array(
            'footer-menu' => __('Footer Menu'),
        )
    );
}
// Remove unwanted theme page templates

function dg_remove_page_templates( $templates ) {

    unset( $templates['page-templates/blank.php'] );

    unset( $templates['page-templates/right-sidebarpage.php'] );

    unset( $templates['page-templates/both-sidebarspage.php'] );

    unset( $templates['page-templates/empty.php'] );

    unset( $templates['page-templates/fullwidthpage.php'] );

    unset( $templates['page-templates/left-sidebarpage.php'] );

    unset( $templates['page-templates/right-sidebarpage.php'] );

    return $templates;

}

add_filter( 'theme_page_templates', 'dg_remove_page_templates' );

add_filter('default_page_template_title', function() {
    return __('Default Inside Page', 'your_text_domain');
});

add_action('admin_init', 'my_general_section');

function my_general_section()
{

    add_settings_section(

        'my_settings_section', // Section ID

        'Custom Website Settings', // Section Title

        'my_section_options_callback', // Callback

        'general' // What Page?  This makes the section show up on the General Settings Page

    );

    add_settings_field( // Option 2

        'email', // Option ID

        'Email', // Label

        'my_textbox_callback', // !important - This is where the args go!

        'general', // Page it will be displayed

        'my_settings_section', // Name of our section (General Settings)

        array( // The $args

            'email' // Should match Option ID

        )

    );
    add_settings_field( // Option 2

        'facebook', // Option ID

        'Facebook Link', // Label

        'my_textbox_callback', // !important - This is where the args go!

        'general', // Page it will be displayed

        'my_settings_section', // Name of our section (General Settings)

        array( // The $args

            'facebook' // Should match Option ID

        )

    );
    add_settings_field( // Option 2

        'instagram', // Option ID

        'Instagram Link', // Label

        'my_textbox_callback', // !important - This is where the args go!

        'general', // Page it will be displayed

        'my_settings_section', // Name of our section (General Settings)

        array( // The $args

            'instagram' // Should match Option ID

        )

    );
    add_settings_field( // Option 2

        'placeholder', // Option ID

        'Profile place holder image', // Label

        'my_textbox_callback', // !important - This is where the args go!

        'general', // Page it will be displayed

        'my_settings_section', // Name of our section (General Settings)

        array( // The $args

            'placeholder' // Should match Option ID

        )

    );

    register_setting('general', 'email', 'esc_attr');

    register_setting('general', 'facebook', 'esc_attr');

    register_setting('general', 'instagram', 'esc_attr');
    register_setting('general', 'placeholder', 'esc_attr');
}
function my_section_options_callback() { // Section Callback

    echo '';

}
function my_textbox_callback($args) {  // Textbox Callback

    $option = get_option($args[0]);

    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';

}
function socialMediaMenu() {
    $html = '

    <ul class="social-media">';
    if(get_option('facebook')) {

        $html .= '<li><a href="' . get_option('facebook') . '" target="_blank" class="fa fa-facebook-square"></a>';

    }
    if(get_option('instagram')) {

        $html .= '<li><a href="' . get_option('instagram') . '" target="_blank" class="fa fa-instagram"></a>';

    }
    $html .= '</ul>';

    return $html;
}
function getMembers() {
    $members = Array();
    $posts_array = get_posts([
        'post_type' => 'member',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'ASC',
        'meta_query' => [
            [
                'key' => 'wpcf-member-approved',
                'value' => 1
            ]
        ]
    ]);
    foreach ($posts_array as $post) {
        $member = new Member($post);
        $members[] = $member;
    }
    return $members;
}
function getMemberByRegistrationID($id) {
    $member = array();
    $posts_array = get_posts([
        'post_type' => 'member',
        'post_status' => 'publish',
        'numberposts' => 1,
        'orderby' => 'ID',
        'order' => 'DESC',
        'meta_query' => [
            [
                'key' => 'wpcf-member-registrationid',
                'value' => $id
            ]
        ]
    ]);
    foreach ($posts_array as $post) {
        $member = new Member($post);
    }
    return $member;
}
function getFeaturedMembers() {
    $members = Array();
    $posts_array = get_posts([
        'post_type' => 'member',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'ASC',
        'meta_query' => [
            [
                'key' => 'wpcf-feature-member',
                'value' => 1,
            ],
            [
                'key' => 'wpcf-member-approved',
                'value' => 1
            ]
        ]
    ]);
    foreach ($posts_array as $post) {
        $member = new Member($post);
        $members[] = $member;
    }
    return $members;
}
function featuredMembers_shortcode() {
    $members = getFeaturedMembers();
    shuffle($members);
    $i = 1;
    $html = '<div class="featured-members-wrapper row justify-content-center">';
    foreach($members as $member) {
        $imageid = getImageID($member->getBioImage());
        $img = wp_get_attachment_image_src($imageid, 'member-home');
        $html .= '
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 inner-wrapper">
            <div class="member-wrapper">
                <div class="flex-item">
                    <div class="image-wrapper"><img src="' . $img[0] . '" alt="' . $member->getTitle() . '" /></div>
                </div>
                <div class="flex-item">
                    <div class="title">' . $member->getTitle() . '</div>
                    ' . $member->getSnippet() . '
                    <a href="' . $member->link() . '">Read More</a>
                </div>
            </div>
        </div>';
        if($i == 3) break;
        $i++;
    }
    $html .= '
    </div>';

    return $html;
}
add_shortcode('feature_members', 'featuredMembers_shortcode');



function getEvents() {
    $events = Array();
    $posts_array = get_posts([
        'post_type' => 'event',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'ASC'
    ]);
    foreach ($posts_array as $post) {
        $event = new Event($post);
        $events[] = $event;
    }
    return $events;
}
function featuredEvents_shortcode() {
    $html = '<div class="featured-members-wrapper row justify-content-center">';
    foreach(getEvents() as $event) {
        $imageid = getImageID($event->getImage());
        $img = wp_get_attachment_image_src($imageid, 'event-home');
        $html .= '
        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
            <div class="event-wrapper">
                <div class="inner-wrapper">            
                     <div class="image-wrapper">
                        <img src="' . $img[0] . '" alt="' . $event->getTitle() . '" />
                    </div>
                    <div class="title">' . $event->getTitle() . '</div>
                    <ul>
                        <li><strong>Location-</strong> ' . $event->getLocation() . '</li>
                        <li><strong>Date-</strong> ' . $event->getDate() . '</li>
                        <li><strong>Time-</strong> ' . $event->getTime() . '</li>
                    </ul>
                    <a href="' . get_page_link(304) . '" class="btn btn-book">book now</a>               
                </div>
            </div>
        </div>';
    }
    $html .= '</div>';

    return $html;
}
add_shortcode('feature_events', 'featuredEvents_shortcode');

function becomeMemberCTA_shortcode() {
    $html = '
    <div class="image-wrapper">
        <img src="' . get_stylesheet_directory_uri(). '/images/become-a-member-banner.jpg" alt="" />
    </div>
    <div class="banner-text">
        <div class="title">Become a member</div>
        <p class="snippet container">Looking for inspiration, collaboration and fun ways to increase your knowledge to improve your business?</p>
        <a href="' . get_page_link(119) . '" class="btn btn-primary">Join now!</a>
    </div>';

    return $html;
}
add_shortcode('member_cta', 'becomeMemberCTA_shortcode');

function getImageID($image_url)
{
    global $wpdb;
    $sql = 'SELECT ID FROM ' . $wpdb->prefix . 'posts WHERE guid = "' . $image_url . '"';
    $result = $wpdb->get_results($sql);

    return $result[0]->ID;
}
function formatPhoneNumber($ph) {

    $ph = str_replace('(', '', $ph);

    $ph = str_replace(')', '', $ph);

    $ph = str_replace(' ', '', $ph);

    $ph = str_replace('+64', '0', $ph);
    return $ph;
}
function formaturl($url) {
    $domainStarts = strpos($url, '://');
    if ($domainStarts !== false) {
        $domainStarts += 4;
    } elseif (strpos($url, 'mailto:') !== false) {
        $domainStarts = 7;
    } elseif (strpos($url, 'skype:') !== false) {
        $domainStarts = 6;
    } else {
        $url = 'http://' . $url;
        $domainStarts = 7;
    }
    if (strpos($url, '/', $domainStarts) === false) $url .= '/';
    return $url;
}
function hideCTA() {
    global $post;
    $setting = new Setting($post->ID);
    if($setting->hideCTA() == 1) {
        return true;
    } else {
        return false;
    }
}
//Remove billing details and additional notes section.
add_action('init','remove_billing_info_and_additional_notes_wc');

function remove_billing_info_and_additional_notes_wc() {
    if (!(is_admin())) {
        //Run this code only in frontend
        global $woocommerce;
        if (is_object($woocommerce)) {

            //WooCommerce Plugin activated
            if (function_exists('WC')) {

                $wc_checkout_instance=WC()->checkout();
                //Remove hooks
                remove_action('woocommerce_checkout_billing', array($wc_checkout_instance, 'checkout_form_billing'));
                remove_action( 'woocommerce_checkout_shipping', array( $wc_checkout_instance,'checkout_form_shipping' ) );
            }

        }
    }
}
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

function custom_override_checkout_fields( $fields ) {
    unset($fields['billing']['billing_first_name']);
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_phone']);
    unset($fields['order']['order_comments']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_email']);
    unset($fields['billing']['billing_city']);
    return $fields;
}
/*
add_action('cred_save_data', 'my_save_data_action',10,2);
function my_save_data_action($post_id, $form_data)
{
    if($form_data['id'] == 130) {
        // user has submitted registration form
        // need to insert firstname, lastname and email into billing field.
        //update_post_meta(192, '_billing_first_name', $_POST['first_name']);
        //update_post_meta(193, '_billing_last_name', $_POST['last_name']);
        //update_post_meta($post_id, '_billing_email', $_POST['email']);
    }
}
*/
add_action('cred_commerce_after_order_completed', 'update_order_info',10,1);
function update_order_info($data)
{
    /************
     * Users registration order is complete.
     * ****/
    if ($data['extra_data'][0]['cred_form_id']==130) {
        $orderid = $data['transaction_id'];
        $userid = get_post_meta($orderid, '_cred_post_id', true);
        $user = get_user_by('id', $userid);
        $registrationid = sha1($user->user_email);
        // update user fields
        update_user_meta($userid, 'wpcf-user-registrationid', $registrationid);
        // need to insert firstname, lastname and email into billing field.
        update_post_meta($orderid, '_billing_first_name', $user->first_name);
        update_post_meta($orderid, '_billing_last_name', $user->last_name);
        update_post_meta($orderid, '_billing_email', $user->email);

        add_action( 'woocommerce_email_before_order_table', 'add_content_specific_email', 20, 4 );
    }
}

add_action('cred_commerce_form_action', 'insert_registered_member',10,4);
function insert_registered_member($action, $form_id, $post_id, $form_data)
{
    if ($form_id == 130) {
        // user has submitted registration form
        // double check this member hasn't already been added to the database. Dont want any double ups.
        $registrationid = sha1($_POST['user_email']);
        $check = getMemberByRegistrationID($registrationid);
        if(count($check) == 0) {
            // create the new member
            $post_name = $_POST['first_name'] . ' ' . $_POST['last_name'];
            //create post object
            $my_post = array(
                'post_title' => wp_strip_all_tags($post_name),
                'post_content' => '',
                'post_status' => 'publish',
                'post_type' => 'member',
                'post_author' => 1
            );
            $new_post_id = wp_insert_post($my_post);

            //update_post_meta($new_post_id, 'wpcf-member-user-id', $post_id);
            update_post_meta($new_post_id, 'wpcf-personal-email', $_POST['user_email']);
            update_post_meta($new_post_id, 'wpcf-personal-phone', $_POST['user_phone']);
            update_post_meta($new_post_id, 'wpcf-personal-address', $_POST['user_address']);
            update_post_meta($new_post_id, 'wpcf-postcode', $_POST['user_postcode']);
            update_post_meta($new_post_id, 'wpcf-member-subscription', $_POST['wpcf-package']);
            update_post_meta($new_post_id, 'wpcf-member-registrationid', $registrationid);
            update_post_meta($new_post_id, 'wpcf-firstname', $_POST['first_name']);
        }
    }
}
function memberProfile_shortcode() {
    // get the post id of the current logged in user
    $user = wp_get_current_user();
    // get post id of member profile associated with this user
    $registrationid = get_user_meta($user->id, 'wpcf-user-registrationid', true);
    $member = getMemberByRegistrationID($registrationid);
    $postid = $member->id();

    echo do_shortcode('[cred_form form=142 post=' . $postid . ']');

}

add_shortcode('member_profile', 'memberProfile_shortcode');

add_action( 'woocommerce_thankyou', 'redirectcustom');

function redirectcustom( $order_id ){
    $order = new WC_Order( $order_id );
    $url = get_page_link(245);

    if ( $order->status != 'failed' ) {
        $order->update_status( 'completed' );
        wp_redirect($url);
        exit;
    }
}
add_action( 'woocommerce_email_before_order_table', 'add_content_specific_email', 20, 4 );

function add_content_specific_email( $order, $sent_to_admin, $plain_text, $email ) {
    if ( $email->id == 'new_order' ) {
        //$userid = get_post_meta($order->id, '_cred_post_id', true);
        //$user = get_user_by('id', $userid);
       // $customer = $user->first_name . ' ' . $user->last_name;
        //echo '<p>You\'ve received a new registration from: ' . $order . '.</p>';
    }
}

