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
      'speed' => 1000,
      'dots' => true
    ];
    ?>
    <div class="dom-slider" id="slider1" data-slider-sets='<?= json_encode($sets); ?>'>
      <?php
      for ($i = 0; $i < 5; $i++) {
      ?>
        <div class="slider-item over-hide">
          <div class="bg slider-animate" data-slider-in="fadeIn" data-slider-out="fadeOut">
            <img src="<?= CURRENT_SRC; ?>img/slider1/0<?= $i + 1; ?>.jpg" alt="background">
          </div>
          <div class="content">
            <div class="up-title over-hide">
              <span class="text slider-animate inline-block" data-slider-in="slideInUp" data-slider-out="slideOutDown" data-slider-delayin="500" data-slider-delayout="0">
                uptitle text
              </span>
            </div>
            <h2 class="page-title slider-animate" data-slider-in="bounceIn, bounceInLeft, bounceInRight" data-slider-out="bounceOut, bounceOutRight, bounceOutLeft" data-slider-delayin="100" data-slider-delayout="100">
              Around the world
            </h2>
            <h5 class="page-subtitle slider-animate inline-block" data-slider-in="zoomIn, flipInX, flipInY" data-slider-out="zoomOut, flipOutX, flipOutY">
              some desription...
            </h5>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>


  <div class="test-slider">

    <div class="dom-slider animate-dom-slider" id="firstSlider">
      <?php
      for ($i = 0; $i < 8; $i++) {
      ?>
        <div class="slider-item">
          <div class="bg slider-animate" data-slider-out="fadeOut" data-slider-in="fadeIn" data-duration-in="3000" data-duration-out="1000"></div>
          <div class="title slider-animate" data-slider-in="bounceInUp, rotateIn, lightSpeedIn, bounceInDown" data-slider-out="bounceOutUp, bounceOut, bounceOutDown, fadeOutDown, rotateOut" data-slider-delayin="500">slide <?= $i + 1; ?></div>
        </div>
      <?php
      }
      ?>
    </div>

    <div class="sets-slider">

      <label for="slidesToShow">
        <span class="label">Slides to Show:</span>
        <input type="number" name="slidesToShow" id="slidesToShow" min="1" value="1" />
      </label>

      <label for="slidesToScroll">
        <span class="label">Slides to scroll:</span>
        <input type="number" name="slidesToScroll" id="slidesToScroll" min="1" value="1" />
      </label>

      <label for="speed">
        <span class="label">Speed:</span>
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
        <span class="label">Autoplay speed:</span>
        <input type="number" name="autoplaySpeed" id="autoplaySpeed" min="1" value="3000" />
      </label>

      <label for="pauseOnHover">
        <span class="label">Pause on hover:</span>
        <input type="checkbox" name="pauseOnHover" id="pauseOnHover" checked />
      </label>

      <label for="animation">
        <span class="label">Animation:</span>
        <select value="" name="animation" id="animation">
          <option value="slider">slider</option>
          <option value="fade">fade</option>
          <option value="animate">animate</option>
          <option value="data-animate">data-animate</option>
        </select>
      </label>


      <label for="addSlide">
        <span class="label">Add slide:</span>
        <input type="button" name="addSlide" id="addSlide" value="+" />
      </label>

      <label for="rmSlide">
        <span class="label">Remove slide:</span>
        <input type="button" name="rmSlide" id="rmSlide" value="-" />
      </label>

    </div>

  </div>






</div>
<?php

get_footer();
