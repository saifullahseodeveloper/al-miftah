<?php
namespace IMAddons\Admin\Layouts;

use \IMAddons\Helpers\Utils as Utils;

defined('ABSPATH')||exit;

class Ajax{

    public function __construct(){
        if(!defined('WP_DEBUG') || WP_DEBUG == false){
            error_reporting(0);
        }
        add_action('wp_ajax_imaddons_get_layouts', [$this, 'get_layouts']);
        if(defined('ELEMENTOR_VERSION') && version_compare( ELEMENTOR_VERSION, '2.2.8', '>' )){
            add_action('elementor/ajax/register_actions', array($this, 'register_ajax_actions'), 20);
        }else{
            add_action('wp_ajax_elementor_get_template_data', array($this, 'get_template_data'), -1);
        }
    }

    public function get_layouts(){
        isset($_GET['tab'])||exit();
        $query = array_merge(
            [
                'action' => 'get_layouts',
                'tab' => (empty($_GET['tab']) ? 'imaddons_page' : $_GET['tab']),
            ]
        );
        $request_url = IMADDONS_API_SERVER_URL. '?' .http_build_query($query);

        $response = wp_remote_get(
            $request_url,
            [
                'timeout'=>120,
                'httpversion'=>'1.1'
            ]
        );

        if($response['body'] != ''){
            echo Utils::kses($response['body']);
            exit;
        }
    }
    public function get_layout_data(){
        $actions =! isset($_POST['actions']) ? '' : $_POST['actions'];
        $actions = json_decode(stripslashes($actions), true);
        $template_data = reset($actions);
        $query = array_merge(
            [
                'action' => 'get_layout_data',
                'id' => $template_data['data']['template_id'],
            ]
        );
        $request_url = IMADDONS_API_SERVER_URL. '?' .http_build_query($query);
        $response = wp_remote_get(
            $request_url,
            [
                'timeout'=>120,
                'httpversion'=>'1.1'
            ]
        );
        $content = json_decode($response['body'], true);
        $content = $this->prepare_layout_ids($content);
        $content = $this->prepare_layout_content($content, 'on_import');
        return $content;
    }
    public function register_ajax_actions($ajax){
        if(!isset($_POST['actions'])){
            return;
        }
        $actions = json_decode(stripslashes($_REQUEST['actions']), true);
        if( !$actions){
            return;
        }
        $data = false;
        foreach($actions as $id => $action_data){
            if(!isset($action_data['get_template_data'])){
                $data = $action_data;
            }
        }

        if( !$data ||
            !isset($data['data']) ||
            !isset($data['data']['source'])){
            return;
        }
        $source=$data['data']['source'];
        if( !in_array($source, IMADDONS_API_SOURCE)){
            return;
        }
        $ajax->register_ajax_action('get_template_data',function($data){
            return $this->get_layout_data();
        });
    }
    protected function prepare_layout_ids($content){
        return \Elementor\Plugin::$instance->db->iterate_data($content,function($element){
            $element['id']=\Elementor\Utils::generate_random_string();
            return $element;
        });
    }
    protected function prepare_layout_content($content,$method){
        return \Elementor\Plugin::$instance->db->iterate_data($content,function($element_data)use($method){
            $element=\Elementor\Plugin::$instance->elements_manager->create_element_instance($element_data);
            if(!$element){
                return null;
            }
            return $this->prepare_layout_element($element,$method);
        });
    }
    protected function prepare_layout_element($element,$method){
        $element_data = $element->get_data();
        if(method_exists($element,$method)){
            $element_data = $element->{$method}($element_data);
        }

        foreach($element->get_controls()as $control){
            $control_class = \ELementor\Plugin::$instance->controls_manager->get_control($control['type']);
            if(!$control_class){
                return $element_data;
            }
            if(method_exists($control_class, $method)){
                $element_data['settings'][$control['name']] = $control_class->{$method}($element->get_settings($control['name']),$control);
            }
        }
        return $element_data;
    }
}