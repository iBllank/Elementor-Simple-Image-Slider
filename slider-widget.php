<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use WP_Query;

class SliderWidget extends Widget_Base {

    public function get_name() {
        return 'slider-widget';
    }

    public function get_title() {
        return 'Image Slider Widget';
    }

    public function get_icon() {
        return 'eicon-photo-library';
    }

    public function get_keywords() {
        return ['ah', 'image', 'slider'];
    }

    public function get_categories() {
        return [ 'ah-category' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'blur_slides',
            [
                'label' => __( 'Slides', 'elementor' ),
            ]
        );

        $this->add_control( 'ah-slides', [
            'label' => __( 'Add your slides', 'my-listing' ),
            'type' => Controls_Manager::REPEATER,
            'fields' =>
                [
                    [
                        'name' => 'slide-img',
                        'label' => __( 'Image', 'ah-theme' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'options' => [],
                    ],
                ],
            'default' => [],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if( !empty($settings['ah-slides']) ): ?>

        <!-- Swiper -->
        <div class="image-slider-cu">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php foreach ( $settings['ah-slides'] as $k => $slide ): ?>
                        <div class="swiper-slide">
                            <img src="<?=$slide['slide-img']['url']?>" alt="">
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="arrows-div-cu">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <script>
            jQuery(document).ready(function($) {
                var swiper = new Swiper(".mySwiper", {
                    navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                    },
                    autoplay: {
                        delay: 1300,
                      },
                });
            });
        </script>

        <?php
    }

    protected function _content_template() {

    }
}
