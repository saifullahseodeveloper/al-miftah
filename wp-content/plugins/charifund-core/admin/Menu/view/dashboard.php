<?php

namespace IMAddons\Admin\Menu;

use IMAddons\Admin\WidgetsMap\Init as Init;

use \IMAddons\Admin\WidgetsMap\Basic as Basic;
use \IMAddons\Admin\WidgetsMap\Advanced as Advanced;
use \IMAddons\Admin\WidgetsMap\Form as Form;
use \IMAddons\Admin\WidgetsMap\Site as Site;
use \IMAddons\Admin\WidgetsMap\Woo as Woo;
use IMAddons\Helpers\Utils as Utils;
/**
 * Dashboard widgets tab template
 */

defined( 'ABSPATH' ) || die();


$active_widgets = Init::active_widgets();
$widget_filters = Init::widget_filters();
$all_widgets = array_merge(
    Basic::widgets_map(), 
    Advanced::widgets_map(), 
    Form::widgets_map(), 
    Site::widgets_map(), 
    Woo::widgets_map()
); ?>
<div class="imaddons-wrapper">
    <div class="imaddons-dashboard-panel">
        <div class="shortcode_list">
            <div class="shortcode_tab">
                <form action="" method="POST" id="imaddons-admin-action-form" enctype="multipart/form-data">
                    <ul class="shortcode_tab_button_group">
                        <li class="shortcode_tab_button">
                            <a class="selected" href="#">Dashboard</a>
                        </li>
                        <li class="shortcode_tab_button">
                            <a  href="#">Widget</a>
                        </li>
                        <li class="shortcode_tab_button">
                            <a href="#">Integration</a>
                        </li>
                    </ul>

                    <div  class="shortcode_tab_container">
                        <div class="shortcode_tab_info selected">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="block_box box_1">
                                        <h3>Welcome,</h3>
                                        <p>Lorem ipsum dolor sit amet, conse ctetur adipiscing tempor incidiunt ut labore et dolor magna aliqua.
                                            Ut ad minim veniam, quis nostrud exe rcitation ullamco aliquip ex ea com modo et dolor magna aliqua. Ut ad minim veniam.</p>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="block_box box_2">
                                        <h3>Learn Element</h3>
                                        <p>Lorem ipsum dolor sit amet, conse ctetur adipiscing tempor incidiunt ut labore et dolor magna aliqua.
                                            Ut ad minim veniam, quis nostrud exe rcitation ullamco aliquip.</p>

                                        <div class="button"><a href="#">Go Knowledge Page</a></div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="block_box box_3">
                                        <h3>Video Tutorial</h3>
                                        <p>Lorem ipsum dolor sit amet, conse ctetur adipiscing tempor</p>
                                        <ul class="vdo_listing">
                                            <li><a href="#">Lorem ipsum dolor sit amet</a></li>
                                            <li><a href="#">Consectetur adipiscing tempor</a></li>
                                            <li><a href="#">Incidiunt ut labore et dolor</a></li>
                                            <li><a href="#">Magna aliqua ut ad minim</a></li>
                                        </ul>
                                        <div class="video_button">
                                            <a class="fancybox-media" href="http://www.youtube.com/watch?v=opj24KnzrWo"><i class="ion-ios-play"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="block_box box_4">
                                        <h3>System Requirement</h3>
                                        <ul class="system_listing">
                                            <li>
                                                PHP Version: <span class="value">7 . 0 . 1</span>
                                                <div class="switch">
                                                    <input type="checkbox">
                                                    <div class="shutter">
                                                        <span class="lbl-off"><i class="ion-ios-close-empty"></i></span>
                                                        <span class="lbl-on"><i class="ion-ios-checkmark-empty"></i></span>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                Memory Limit: <span class="value">300M</span>
                                                <div class="switch">
                                                    <input type="checkbox">
                                                    <div class="shutter">
                                                        <span class="lbl-off"><i class="ion-ios-close-empty"></i></span>
                                                        <span class="lbl-on"><i class="ion-ios-checkmark-empty"></i></span>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                Max Post Limit: <span class="value">100M</span>
                                                <div class="switch">
                                                    <input type="checkbox">
                                                    <div class="shutter">
                                                        <span class="lbl-off"><i class="ion-ios-close-empty"></i></span>
                                                        <span class="lbl-on"><i class="ion-ios-checkmark-empty"></i></span>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                Max Execution: <span class="value">1000</span>
                                                <div class="switch">
                                                    <input type="checkbox">
                                                    <div class="shutter">
                                                        <span class="lbl-off"><i class="ion-ios-close-empty"></i></span>
                                                        <span class="lbl-on"><i class="ion-ios-checkmark-empty"></i></span>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                PHP Version: <span class="value">7 . 0 . 1</span>
                                                <div class="switch">
                                                    <input type="checkbox">
                                                    <div class="shutter">
                                                        <span class="lbl-off"><i class="ion-ios-close-empty"></i></span>
                                                        <span class="lbl-on"><i class="ion-ios-checkmark-empty"></i></span>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                Max File Size: <span class="value">32M</span>
                                                <div class="switch">
                                                    <input type="checkbox">
                                                    <div class="shutter">
                                                        <span class="lbl-off"><i class="ion-ios-close-empty"></i></span>
                                                        <span class="lbl-on"><i class="ion-ios-checkmark-empty"></i></span>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="mode_on">
                                                Debug Mode: <span class="value">Turned On</span>
                                                <div class="switch">
                                                    <input type="checkbox" checked>
                                                    <div class="shutter">
                                                        <span class="lbl-off"><i class="ion-ios-close-empty"></i></span>
                                                        <span class="lbl-on"><i class="ion-ios-checkmark-empty"></i></span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    <div class="block_box box_5">
                                        <h3>Frequently Asked Questions</h3>
                                        <div class="accordion">
                                            <div class="item active">
                                                <div class="accordion_tab">
                                                    <h2 class="accordion_title">Lorem Ipsum dolor sit amet consecturer dis autemn magna aliqua ut?</h2>
                                                </div>
                                                <div class="accordion_info">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing tempor incidiunt labore et dolor magna aliqua.
                                                    Ut ad minim vey quis nostrud exercitation ullamco aliquip consectetur adipiscing tempor incidiunt.
                                                </div>
                                            </div>

                                            <div class="item">
                                                <div class="accordion_tab">
                                                    <h2 class="accordion_title">Lorem Ipsum dolor sit amet consecturer dis autemn magna aliqua ut?</h2>
                                                </div>
                                                <div class="accordion_info">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing tempor incidiunt labore et dolor magna aliqua.
                                                    Ut ad minim vey quis nostrud exercitation ullamco aliquip consectetur adipiscing tempor incidiunt.
                                                </div>
                                            </div>

                                            <div class="item">
                                                <div class="accordion_tab">
                                                    <h2 class="accordion_title">Lorem Ipsum dolor sit amet consecturer dis autemn magna aliqua ut?</h2>
                                                </div>
                                                <div class="accordion_info">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing tempor incidiunt labore et dolor magna aliqua.
                                                    Ut ad minim vey quis nostrud exercitation ullamco aliquip consectetur adipiscing tempor incidiunt.
                                                </div>
                                            </div>

                                            <div class="item">
                                                <div class="accordion_tab">
                                                    <h2 class="accordion_title">Lorem Ipsum dolor sit amet consecturer dis autemn magna aliqua ut?</h2>
                                                </div>
                                                <div class="accordion_info">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing tempor incidiunt labore et dolor magna aliqua.
                                                    Ut ad minim vey quis nostrud exercitation ullamco aliquip consectetur adipiscing tempor incidiunt.
                                                </div>
                                            </div>

                                            <div class="item">
                                                <div class="accordion_tab">
                                                    <h2 class="accordion_title">Lorem Ipsum dolor sit amet consecturer dis autemn magna aliqua ut?</h2>
                                                </div>
                                                <div class="accordion_info">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing tempor incidiunt labore et dolor magna aliqua.
                                                    Ut ad minim vey quis nostrud exercitation ullamco aliquip consectetur adipiscing tempor incidiunt.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="shortcode_tab_info">
                            <div class="filters-button-content">
                                <div class="button-group filters-button-group">
                                    <button class="button is-checked" data-filter="*">All <sup class="filter-count"></sup></button>
                                    <?php foreach($widget_filters as $key=>$value){ ?>
                                        <button class="button" data-filter=".<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?> <sup class="filter-count"></sup></button>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="grid grid-4 gutter-10 clearfix">
                                <div class="grid-sizer"></div>
                                <?php foreach($all_widgets as $key=>$value):

                                    $checked = 'checked="checked"';
                                    if ( !in_array( $key, $active_widgets ) ) {
                                        $checked = '';
                                    } ?>

                                    <div class="grid-item <?php echo esc_attr($value['filter']); ?>">
                                        <div class="shortcode_item">
                                            <div class="shortcode_name">
                                            <span class="icon"><i class="<?php echo $value['icon']; ?>"></i></span><?php echo $value['title']; ?>
                                            </div>

                                            <?php if($value['demo'] != ''){ ?>
                                                <a href="<?php echo esc_url($value['demo']);?>" target="_blank" class="imaddons-demo-link"><?php esc_html_e('Demo', 'imaddons');?></a>
                                            <?php } ?>

                                            <div class="switch">
                                            <input id="imaddons-toggle-<?php echo $key; ?>" <?php echo $checked; ?>
                                                type="checkbox" value="<?php echo $key; ?>"
                                                name="widget_list[]"
                                                value="inactive">
                                                <span class="slider round"></span>
                                            </div>
                                        </div>
                                    </div>


                                <?php endforeach; ?>


                            </div>
                            <button class="imaddons-admin-action-form-submit"><div class="imaddons-spinner"></div><?php esc_html_e('Save Changes', 'imaddons'); ?></button>
                        </div>

                        <div class="shortcode_tab_info">
                            <div class="imaddons-dashboard-integrations">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="imaddons-dashboard-integration-mailchimp">
                                            <?php $mailchimp_api = Utils::get_option('imaddons_options', 'mailchimp_api'); ?>
                                            <h2><?php esc_html_e('Mailchimp Api Key', 'imaddons'); ?></h2>
                                            <?php if($mailchimp_api !=''){ ?><span>Connected</span> <?php }?>
                                            <input type="text" class="mailchimp_api_field" value="<?php echo esc_attr($mailchimp_api); ?>" name="mailchimp_api" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="imaddons-admin-action-form-submit"><div class="imaddons-spinner"></div><?php esc_html_e('Save Changes', 'imaddons'); ?></button>
                        </div>
                    </div>
                </form>    
            </div>
        </div>
    </div>
</div>