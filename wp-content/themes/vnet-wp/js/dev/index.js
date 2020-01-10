import { DOM } from "./DOM/DOM.js";
import { React } from "./DOM/domReact";

window.dom = new DOM;

import "@babel/polyfill";



import "../../css/dev/main.less";

import { domSlider } from "./DOM/domSlider";

const dinamicFunctions = wrap => {
  let sliders = domSlider(wrap, {
    animationIn: ['flipInY', 'bounceIn', 'bounceInDown', 'bounceInUp'],
    animationOut: ['flipOutY', 'bounceOut', 'bounceOutDown', 'bounceOutUp'],
  });

  let slider = sliders.getSliderById('firstSlider');

  // slider.update({
  //   slidesToShow: 1,
  //   slidesToScroll: 1,
  //   // dots: false,
  //   // arrows: false,
  //   // draggable: false
  // });

  // setTimeout(() => {
  //   slider.update({
  //     slidesToShow: 1,
  //     slidesToScroll: 1,
  //     dots: false,
  //     arrows: false,
  //     draggable: true
  //   });
  // }, 1000);


  // setTimeout(() => {
  //   let slide = `
  //     <div class="slider-item">
  //       <div class="bg slider-animate" data-slider-out="fadeOut" data-slider-in="fadeIn"></div>
  //       <div class="title slider-animate" data-slider-in="bounceInUp, rotateIn, lightSpeedIn, bounceInDown" data-slider-out="bounceOutUp" data-slider-delayin="500">slide <?= $i + 1; ?></div>
  //     </div>
  //   `;
  //   slider.addSlide(slide);
  // }, 1000);

  // setTimeout(() => {
  //   slider.rmSlide(0);
  //   setTimeout(() => {
  //     slider.rmSlide(0);
  //     setTimeout(() => {
  //       slider.rmSlide(0);
  //       setTimeout(() => {
  //         slider.rmSlide(0);
  //       }, 500);
  //     }, 500);
  //   }, 500);
  // }, 1000);

  let sets = {};

  let slidesToShow = dom.findFirst('#slidesToShow');
  slidesToShow.addEventListener('change', e => {
    sets.slidesToShow = slidesToShow.value;
    slider.update(sets);
  });

  let slidesToScroll = dom.findFirst('#slidesToScroll');
  slidesToScroll.addEventListener('change', e => {
    sets.slidesToScroll = slidesToScroll.value;
    slider.update(sets);
  });

  let infinite = dom.findFirst('#infinite');
  infinite.addEventListener('change', e => {
    sets.infinite = infinite.checked;
    slider.update(sets);
  });

  let arrows = dom.findFirst('#arrows');
  arrows.addEventListener('change', e => {
    sets.arrows = arrows.checked;
    slider.update(sets);
  });

  let dots = dom.findFirst('#dots');
  dots.addEventListener('change', e => {
    sets.dots = dots.checked;
    slider.update(sets);
  });

  let draggable = dom.findFirst('#draggable');
  draggable.addEventListener('change', e => {
    sets.draggable = draggable.checked;
    slider.update(sets);
  });

  let swipe = dom.findFirst('#swipe');
  swipe.addEventListener('change', e => {
    sets.swipe = swipe.checked;
    slider.update(sets);
  });

  let autoplay = dom.findFirst('#autoplay');
  autoplay.addEventListener('change', e => {
    sets.autoplay = autoplay.checked;
    slider.update(sets);
  });

  let pauseOnHover = dom.findFirst('#pauseOnHover');
  pauseOnHover.addEventListener('change', e => {
    sets.pauseOnHover = pauseOnHover.checked;
    slider.update(sets);
  });

  let autoplaySpeed = dom.findFirst('#autoplaySpeed');
  autoplaySpeed.addEventListener('change', e => {
    sets.autoplaySpeed = autoplaySpeed.value;
    slider.update(sets);
  });

  let speed = dom.findFirst('#speed');
  speed.addEventListener('change', e => {
    sets.speed = speed.value;
    slider.update(sets);
  });

  let animation = dom.findFirst('#animation');
  animation.addEventListener('change', e => {
    sets.animation = animation.value;
    slider.update(sets);
  });

  let addSlide = dom.findFirst('#addSlide');
  addSlide.addEventListener('click', e => {
    let slide = `
      <div class="slider-item">
        <div class="bg slider-animate" data-slider-out="fadeOut" data-slider-in="fadeIn"></div>
        <div class="title slider-animate" data-slider-in="bounceInUp, rotateIn, lightSpeedIn, bounceInDown" data-slider-out="bounceOutUp" data-slider-delayin="500">slide <?= $i + 1; ?></div>
      </div>
    `;
    slider.addSlide(slide);
  });


  let rmSlide = dom.findFirst('#rmSlide');
  rmSlide.addEventListener('click', e => {
    slider.rmSlide(0);
  });
}



const staticFunctions = wrap => {
  // let slides = dom.findAll('.dom-slider');
  // let firstChilds = dom.firstChild(slides);
  // dom.addCss(firstChilds, { opacity: '.4' });
  // dom.removeClass(firstChilds, 'draggable');
  // dom.addClass(firstChilds, 'some class-name');
  // let allChilds = dom.childs(firstChilds);
  // let current = dom.findAll('.slider-item', allChilds);
  // dom.remove(current);
  // console.log(current);
}




dinamicFunctions();
staticFunctions();