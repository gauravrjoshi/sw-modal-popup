<?php

/**
 * Plugin Name: SW Modal Popup
 * Plugin URI: https://statelyworld.com/plugins/sw-modal-popup/
 * Description: Add any type of content in awesome modal popup
 * Version: 1.10.3
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Gaurav Joshi
 * Author URI: https://statelyworld.com/gauravj
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI: https://statelyworld.com/plugins/sw-modal-popup/
 * Text Domain: sw-modal-popup
 * Domain Path: /languages
 */

define('SW_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SW_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Proper way to enqueue scripts and styles.
 */
function wpdocs_theme_name_scripts()
{
    wp_enqueue_style('sw-modal-popup-style', SW_PLUGIN_URL . 'css/style.css', array(), '0.1.9', 'all');
    wp_enqueue_script('sw-modal-popup-script', SW_PLUGIN_URL . 'js/script.js', array('jquery'), '1.1.9', true);
}
add_action('wp_enqueue_scripts', 'wpdocs_theme_name_scripts');


//[sw_modal_popup src="https://www.youtube.com/embed/c1YmChaP01g" title="My Video Title"]
function sw_modal_popup_func($atts)
{
    if (isset($atts['video_src'])) {
        $src = $atts['video_src'];
    } else {
        $src = $atts['src'];
    }
    $atts['src'];
    ob_start();
?>
    <div class="video_wrapper">
        <!-- Trigger/Open The Modal -->
        <p class="video_title"><i class="fa fa-video-camera" aria-hidden="true"></i>
            <?php echo $atts['title']; ?></p>

        <!-- The Modal -->
        <div class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="sw-popup-container">
                    <iframe width="560" height="315" class="responsive-iframe" src="<?php echo $src; ?>" title="<?php echo $atts['title']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    <?php //echo json_encode($atts);
                    ?>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('sw_modal_popup', 'sw_modal_popup_func');


//[foobar]
function sw_comm_skills_func($atts)
{
    $args = array(
        'post_type' => 'sw-comm-skills',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $loop = new WP_Query($args);
    $html = '<div class="row">';
    $sno = 0;
    while ($loop->have_posts()) : $loop->the_post();
        $sno++;
        $id = get_the_ID();
        $title = get_the_title();
        $html .= '<div class="video_wrapper">
                        <h2 class="video_title">#' . $sno . ' ' . $title . '</h2> 
                        <!-- The Modal -->
                        <div class="modal">
                            <!-- Modal content -->
                            <div class="modal-content">
                            <span class="close">&times;</span>
                                <iframe width="1520" height="577" title="YouTube video player" src="' . get_field("video_url", $id) . '"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <div><a href="' . get_post_permalink() . '">Learn More</a></div>
                            </div>
                        </div>
                  </div>';
    endwhile;
    wp_reset_postdata();

    return $html;;
}
add_shortcode('sw_comm_skills', 'sw_comm_skills_func');
