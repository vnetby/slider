const DEF_SETS = {
  autoplay: false,
  autoplaySpeed: 3000,

  speed: 600,

  arrows: true,
  appendArrows: 'slider',
  appendDots: 'slider',

  prevArrow: 'default',
  nextArrow: 'default',

  dots: false,

  draggable: true,

  animation: 'slider', // fade

  pauseOnHover: false,
  slidesToShow: 1,
  slidesToScroll: 1,
  swipe: true,

  infinite: false
};


export const sliderConstructor = ({ slider, editor }) => {

  let sets = {};

  let slidesToShow = dom.findFirst('#slidesToShow');
  slidesToShow.addEventListener('change', e => {
    sets.slidesToShow = parseFloat(slidesToShow.value);
    slider.update(sets);
    updateEditor({ sets, editor });
  });

  let slidesToScroll = dom.findFirst('#slidesToScroll');
  slidesToScroll.addEventListener('change', e => {
    sets.slidesToScroll = parseFloat(slidesToScroll.value);
    slider.update(sets);
    updateEditor({ sets, editor });
  });

  let infinite = dom.findFirst('#infinite');
  infinite.addEventListener('change', e => {
    sets.infinite = infinite.checked;
    slider.update(sets);
    updateEditor({ sets, editor });
  });

  let arrows = dom.findFirst('#arrows');
  arrows.addEventListener('change', e => {
    sets.arrows = arrows.checked;
    slider.update(sets);
    updateEditor({ sets, editor });
  });

  let dots = dom.findFirst('#dots');
  dots.addEventListener('change', e => {
    sets.dots = dots.checked;
    slider.update(sets);
    updateEditor({ sets, editor });
  });

  let draggable = dom.findFirst('#draggable');
  draggable.addEventListener('change', e => {
    sets.draggable = draggable.checked;
    slider.update(sets);
    updateEditor({ sets, editor });
  });

  let swipe = dom.findFirst('#swipe');
  swipe.addEventListener('change', e => {
    sets.swipe = swipe.checked;
    slider.update(sets);
    updateEditor({ sets, editor });
  });

  let autoplay = dom.findFirst('#autoplay');
  autoplay.addEventListener('change', e => {
    sets.autoplay = autoplay.checked;
    slider.update(sets);
    updateEditor({ sets, editor });
  });

  let pauseOnHover = dom.findFirst('#pauseOnHover');
  pauseOnHover.addEventListener('change', e => {
    sets.pauseOnHover = pauseOnHover.checked;
    slider.update(sets);
    updateEditor({ sets, editor });
  });

  let autoplaySpeed = dom.findFirst('#autoplaySpeed');
  autoplaySpeed.addEventListener('change', e => {
    sets.autoplaySpeed = parseFloat(autoplaySpeed.value);
    slider.update(sets);
    updateEditor({ sets, editor });
  });

  let speed = dom.findFirst('#speed');
  speed.addEventListener('change', e => {
    sets.speed = parseFloat(speed.value);
    slider.update(sets);
    updateEditor({ sets, editor });
  });

  let animation = dom.findFirst('#animation');
  animation.addEventListener('change', e => {
    sets.animation = animation.value;
    slider.update(sets);
    updateEditor({ sets, editor });
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




const setsTostring = ({ sets }) => {
  sets = getRealSets({ sets });
  let str = `let sliders = domSlide(`;
  let total = Object.keys(sets).length;
  if (!total) {
    str += `);`;
    return str;
  } else {
    str += `{`;
  }
  let count = 0;
  for (let key in sets) {
    count++;
    str += `\r\n\t${key}: ${getSetValue(key, sets[key])}${count === total && sets[key] !== 'animate' ? '' : ','}`;
    if (sets[key] === 'animate') {
      str += `\r\n\tanimationIn: ['flipInY', 'bounceIn', 'bounceInDown', 'bounceInUp'],`;
      str += `\r\n\tanimationOut: ['flipOutY', 'bounceOut', 'bounceOutDown', 'bounceOutUp']${count === total ? '' : ','}`;
    }
  }

  str += `\r\n});`;
  return str;
}



const updateEditor = ({ sets, editor }) => {
  let str = setsTostring({ sets });
  editor.setValue(str);
}




const getSetValue = (key, val) => {
  if (parseFloat(val) || val === true || val === false) return val;
  return `"${val}"`;
}


const getRealSets = ({ sets }) => {
  let res = {};
  for (let key in sets) {
    if (sets[key] === DEF_SETS[key]) continue;
    res[key] = sets[key];
  }
  return res;
}