<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vnet-theme
 */

get_header();

?>
<div class="main-content">
  <?php
  the_page_template();
  ?>


  <div class="slider1-container">
    <?php
    $sets = [
      'arrows' => false,
      'dots' => false,
      'autoplay' => false,
      'autoplaySpeed' => 3000,
      'pauseOnHover' => false,
      'animation' => 'data-animate',
      'draggable' => true,
      'infinite' => true,
      'speed' => 1500,
      'dots' => true
    ];
    ob_start();
    ?>
    <div class="dom-slider" id="slider1" data-slider-sets='<?= json_encode($sets); ?>'>
      <?php
      for ($i = 0; $i < 5; $i++) {
      ?>
        <div class="slider-item over-hide">
          <div class="bg slider-animate" data-animation-in="fadeIn" data-animation-out="fadeOut" data-animation-duration="500" data-animation-delay="100">
            <img src="<?= CURRENT_SRC; ?>img/slider1/0<?= $i + 1; ?>.jpg" alt="background">
          </div>
          <div class="content">
            <div class="up-title over-hide">
              <span class="text slider-animate inline-block" data-animation-in="slideInUp" data-animation-out="slideOutDown" data-animation-duration="300">
                uptitle text
              </span>
            </div>
            <h2 class="page-title slider-animate" data-animation-duration="500" data-animation-in="bounceIn, bounceInLeft, bounceInRight" data-animation-out="bounceOut, bounceOutRight, bounceOutLeft" data-animation-delay-in="0" data-animation-delay-out="300">
              Around the world
            </h2>
            <h5 class="page-subtitle slider-animate inline-block" data-animation-in="zoomIn, flipInX, flipInY" data-animation-out="zoomOut, flipOutX, flipOutY" data-animation-duration="300">
              some desription...
            </h5>
          </div>
        </div>
      <?php
      }
      ?>
    </div>

    <?php
    $slider = ob_get_clean();
    $sliderJs = <<< EOL
    let sliders = domSlider();
    EOL;
    $sliderLess = '';
    $sliderLess .= file_get_contents(CURRENT_PATH . 'css/dev/sliders/common.less');
    $sliderLess .= "\r\n\r\n\r\n";
    $sliderLess .= file_get_contents(CURRENT_PATH . 'css/dev/sliders/slider1.less');
    echo $slider;
    ?>

    <div class="code-editor has-tabs">
      <div class="code-controls">
        <a href="#slider1Html" class="tab-link active">HTML</a>
        <a href="#slider1Js" class="tab-link">JS</a>
        <a href="#slider1Less" class="tab-link">LESS</a>
      </div>
      <div class="code-tabs">
        <div id="slider1Html" class="tab">
          <textarea class="html-tab html highlight-code" name="" id="" cols="30" rows="10"><?= $slider; ?></textarea>
        </div>
        <div id="slider1Js" class="tab">
          <textarea class="html-tab html highlight-code" data-mode="javascript" name="" id="" cols="30" rows="10"><?= $sliderJs; ?></textarea>
        </div>
        <div id="slider1Less" class="tab">
          <textarea class="html-tab html highlight-code" data-mode="text/x-less" name="" id="" cols="30" rows="10"><?= $sliderLess; ?></textarea>
        </div>
      </div>
    </div>
  </div>











  <div class="preview-slider" id="previewSlider">
    <?php
    ob_start();
    ?>
    <div class="preview-dots" id="previewDots">
      <?php
      for ($i = 0; $i < 4; $i++) {
      ?>
        <div class="preview-dot" data-step="<?= $i + 1; ?>">
          <img src="<?= CURRENT_SRC; ?>img/previewSlider/0<?= $i + 1; ?>-thumb.jpg" alt="thumbnail">
        </div>
      <?php
      }
      ?>
    </div>
    <?php
    $dots = ob_get_clean();
    $sets = [
      'dots' => true,
      // 'dotsHTML' => preg_replace("/[\s]+/u", " ", $dots),
      'dotsHTML' => '#previewDots',
      'animation' => 'fade',
      'arrows' => false,
      'infinite' => true
    ];
    ob_start();

    ?>
    <div class="dom-slider" data-slider-sets='<?= json_encode($sets); ?>'>
      <?php

      for ($i = 0; $i < 4; $i++) {
      ?>
        <div class="slider-item">
          <img src="<?= CURRENT_SRC; ?>img/previewSlider/0<?= $i + 1; ?>.jpg" alt="fullimage">
        </div>
      <?php
      }

      ?>
    </div>

    <?php

    echo $dots;

    $slider = ob_get_clean();

    $sliderJs = <<< EOL
    let sliders = domSlider({
      dots: true,
      dotsHTML: '#previewDots',
      arrows: false,
      infinite: true
    });
    EOL;
    $sliderLess = '';
    $sliderLess .= file_get_contents(CURRENT_PATH . 'css/dev/sliders/common.less');
    $sliderLess .= "\r\n\r\n\r\n";
    $sliderLess .= file_get_contents(CURRENT_PATH . 'css/dev/sliders/previewSlider.less');

    echo $slider;

    ?>

    <div class="code-editor has-tabs">
      <div class="code-controls">
        <a href="#previewSliderHtml" class="tab-link active">HTML</a>
        <a href="#previewSliderJs" class="tab-link">JS</a>
        <a href="#previewSliderLess" class="tab-link">LESS</a>
      </div>
      <div class="code-tabs">
        <div id="previewSliderHtml" class="tab">
          <textarea class="html-tab html highlight-code" name="" id="" cols="30" rows="10"><?= preg_replace("/[\s]*data-slider-sets=\'[^\']+\'/u", "", $slider); ?></textarea>
        </div>
        <div id="previewSliderJs" class="tab">
          <textarea class="html-tab html highlight-code" data-mode="javascript" name="" id="" cols="30" rows="10"><?= $sliderJs; ?></textarea>
        </div>
        <div id="previewSliderLess" class="tab">
          <textarea class="html-tab html highlight-code" data-mode="text/x-less" name="" id="" cols="30" rows="10"><?= $sliderLess; ?></textarea>
        </div>
      </div>
    </div>

  </div>






  <div class="test-slider" id="testSlider">

    <div class="dom-slider animate-dom-slider" id="testSlider">
      <?php
      for ($i = 0; $i < 8; $i++) {
      ?>
        <div class="slider-item">
          <div class="bg slider-animate" data-animation-out="fadeOut" data-animation-in="fadeIn" data-duration-in="3000" data-duration-out="1000"></div>
          <div class="title slider-animate" data-animation-in="bounceInUp, rotateIn, lightSpeedIn, bounceInDown" data-animation-out="bounceOutUp, bounceOut, bounceOutDown, fadeOutDown, rotateOut" data-animation-delayin="500">slide <?= $i + 1; ?></div>
        </div>
      <?php
      }
      ?>
    </div>

    <div class="sets-slider">

      <div class="col">
        <label for="slidesToShow">
          <span class="label block">Slides to Show:</span>
          <input type="number" name="slidesToShow" id="slidesToShow" min="1" value="1" />
        </label>
        <label for="slidesToScroll">
          <span class="label block">Slides to scroll:</span>
          <input type="number" name="slidesToScroll" id="slidesToScroll" min="1" value="1" />
        </label>
        <label for="animation">
          <span class="label block">Animation:</span>
          <select value="" name="animation" id="animation">
            <option value="slider">slider</option>
            <option value="fade">fade</option>
            <option value="animate">animate</option>
            <option value="data-animate">data-animate</option>
          </select>
        </label>
      </div>

      <div class="col">
        <label for="speed">
          <span class="label block">Speed:</span>
          <input type="number" name="speed" id="speed" min="1" value="600" />
        </label>
        <label for="infinite">
          <span class="label">Infinite:</span>
          <input type="checkbox" name="infinite" id="infinite" />
        </label>
        <label for="arrows">
          <span class="label">Arrows:</span>
          <input type="checkbox" name="arrows" id="arrows" checked />
        </label>
        <label for="dots">
          <span class="label">Dots:</span>
          <input type="checkbox" name="dots" id="dots" />
        </label>
        <label for="pauseOnHover">
          <span class="label">Pause on hover:</span>
          <input type="checkbox" name="pauseOnHover" id="pauseOnHover" />
        </label>
      </div>

      <div class="col">
        <label for="draggable">
          <span class="label">Draggable:</span>
          <input type="checkbox" name="draggable" id="draggable" checked />
        </label>
        <label for="swipe">
          <span class="label">Swipe:</span>
          <input type="checkbox" name="swipe" id="swipe" checked />
        </label>
        <label for="autoplay">
          <span class="label">Autoplay:</span>
          <input type="checkbox" name="autoplay" id="autoplay" />
        </label>

        <label for="autoplaySpeed">
          <span class="label block">Autoplay speed:</span>
          <input type="number" name="autoplaySpeed" id="autoplaySpeed" min="1" value="3000" />
        </label>

        <div class="db-input">
          <label for="addSlide">
            <input type="button" name="addSlide" id="addSlide" value="+ Add slide" />
          </label>

          <label for="rmSlide">
            <input type="button" name="rmSlide" id="rmSlide" value="- Remove slide" />
          </label>
        </div>

      </div>

    </div>

    <div class="code-editor has-tabs">
      <?php
      $sliderJs = <<< EOL
    let sliders = domSlider();
    EOL;
      ?>
      <div class="code-controls">
        <a href="#testSliderJs" class="tab-link active">JS</a>
      </div>
      <div class="code-tabs">
        <div id="testSliderJs" class="tab">
          <textarea class="html-tab html highlight-code constructor-editor" data-mode="javascript" name="" id="" cols="30" rows="10"><?= $sliderJs; ?></textarea>
        </div>
      </div>
    </div>

  </div>
















</div>
<?php

get_footer();
