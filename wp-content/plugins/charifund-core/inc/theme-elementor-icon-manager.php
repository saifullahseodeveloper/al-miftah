<?php
namespace Charifund;
use Elementor\Core\Files\Assets\Svg\Svg_Handler;
use Elementor\Utils;

class Charifund_elementor_icon_manager extends \Elementor\Icons_Manager{

    private static function render_icon_html( $icon, $attributes = [], $tag = 'i' ) {
        $icon_types = self::get_icon_manager_tabs();
        if ( isset( $icon_types[ $icon['library'] ]['render_callback'] ) && is_callable( $icon_types[ $icon['library'] ]['render_callback'] ) ) {
            return call_user_func_array( $icon_types[ $icon['library'] ]['render_callback'], [ $icon, $attributes, $tag ] );
        }

        if ( empty( $attributes['class'] ) ) {
            $attributes['class'] = $icon['value'];
        } else {
            if ( is_array( $attributes['class'] ) ) {
                $attributes['class'][] = $icon['value'];
            } else {
                $attributes['class'] .= ' ' . $icon['value'];
            }
        }
        return '<' . $tag . ' ' . Utils::render_html_attributes( $attributes ) . '></' . $tag . '>';
    }

    private static function render_svg_icon( $value ) {
        if ( ! isset( $value['id'] ) ) {
            return '';
        }

        return Svg_Handler::get_inline_svg( $value['id'] );
    }
    /**
     * Render Icon
     *
     * Used to render Icon for \Elementor\Controls_Manager::ICONS
     * @param array $icon             Icon Type, Icon value
     * @param array $attributes       Icon HTML Attributes
     * @param string $tag             Icon HTML tag, defaults to <i>
     *
     * @return mixed|string
     */
    public static function render_icon( $icon, $attributes = [], $tag = 'i' ) {
        if ( empty( $icon['library'] ) ) {
            return false;
        }
        $output = '';
        // handler SVG Icon
        if ( 'svg' === $icon['library'] ) {
            $output = self::render_svg_icon( $icon['value'] );
        } else {
            $output = self::render_icon_html( $icon, $attributes, $tag );
        }

        return $output;
    }
}


?>