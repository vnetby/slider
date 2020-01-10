export const getRealDomEl = (el) => {
  if (typeof el !== 'object') return false;
  if (el.tagName) return el;
  let div = dom.create('div');
  div.appendChild(el);
  el = dom.firstChild(div);
  return el.tagName ? el : false;
}





export const appendControls = ({ item, wrap, slider }) => {
  if (dom.isDomEl(wrap)) {
    wrap.appendChild(item);
  } else {
    if (wrap === 'slider') {
      slider.appendChild(item);
    } else {
      try {
        let el = dom.findFirst(wrap);
        el.appendChild(item);
      } catch (err) {
        slider.appendChild(item);
      }
    }
  }
}




export const getTotalSlides = ({ obj }) => {
  return parseInt(obj.totalSlides);
  // return parseInt(obj.slider.dataset.total);
}
export const setTotalSlides = ({ obj, total }) => {
  obj.totalSlides = total;
  // obj.slider.setAttribute('data-total', total);
}

export const setCurrentSlides = ({ obj }) => {
  let step = getStep({ obj });
  let slides = getSlidesByStep({ obj, step });
  let prevSlides;
  if (!obj.currentSlides) {
    let prevStep = getPrevStep({ obj });
    prevSlides = getSlidesByStep({ obj, step: prevStep });
  } else {
    prevSlides = [...obj.currentSlides];
  }
  obj.prevSlides = prevSlides;
  obj.currentSlides = slides;
  return slides;
}

export const getCurrentSlides = ({ obj }) => {
  return obj.currentSlides;
  return obj.slider.dataset.currentSlides.split(',').map(item => parseInt(item));
}


export const getPrevSlides = ({ obj }) => {
  return obj.prevSlides;
}




export const setSteps = ({ obj, total }) => {
  total = total - obj.sets.slidesToShow;
  let steps = Math.ceil(total / obj.sets.slidesToScroll) + 1;
  obj.totalSteps = steps;
  // obj.slider.dataset.steps = steps;
}

export const setStep = ({ obj, step }) => {
  obj.currentStep = step;
  // obj.slider.setAttribute('data-current-step', step);
}

export const getStep = ({ obj }) => {
  return parseInt(obj.currentStep);
  // return parseInt(obj.slider.getAttribute('data-current-step'));
}

export const getTotalSteps = ({ obj }) => {
  return parseInt(obj.totalSteps);
  // return parseInt(obj.slider.getAttribute('data-steps'));
}



export const getSlidesByStep = ({ obj, step }) => {
  let res = [];
  let slidesToShow = parseInt(obj.sets.slidesToShow);
  let slidesToScroll = parseFloat(obj.sets.slidesToScroll);

  if (step === 1) {
    for (let i = 0; i < slidesToShow; i++) {
      res.push(i);
    }
    return res;
  }

  step = step - 1;
  let total = getTotalSlides({ obj });

  let firstIndex = step * slidesToScroll + slidesToShow - slidesToScroll;
  if (slidesToScroll < slidesToShow) {
    let diffSlides = slidesToShow - slidesToScroll;
    firstIndex = firstIndex - diffSlides;
  }
  if (firstIndex + slidesToScroll > total - 1 && slidesToScroll < slidesToShow) {
    firstIndex = total - 1 - slidesToScroll;
  }
  let lastIndex = firstIndex + slidesToShow > total ? total : firstIndex + slidesToShow;


  for (let i = firstIndex; i < lastIndex; i++) {
    res.push(i);
  }
  return res;
}



export const getNextStep = ({ obj }) => {
  let step = getStep({ obj });
  let totalSteps = getTotalSteps({ obj });
  if (step + 1 <= totalSteps) return step + 1;
  if (!obj.sets.infinite) return step;
  return 1;
}


export const getPrevStep = ({ obj }) => {
  let step = getStep({ obj });
  let totalSteps = getTotalSteps({ obj });
  if (step - 1 > 0) return step - 1;
  if (!obj.sets.infinite) return step;
  return totalSteps;
}



export const setOutherSpeed = ({ obj }) => {
  if (obj.sets.animation === 'slider') {
    dom.addCss(obj.outher, { 'transition-duration': `${parseFloat(obj.sets.speed) / 1000}s` });
    return;
  }
  if (obj.sets.animation === 'fade') {
    let speed = parseFloat(obj.sets.speed) / 2 / 1000;
    dom.addCss(obj.outher, { 'transition-duration': `${speed}s` });
    return;
  }
  dom.addCss(obj.outher, { 'transition-duration': `${0}s` });
}




export const setElementsAnimation = ({ obj }) => {
  if (obj.sets.animation === 'animate') {
    obj.slides.map(item => dom.addCss(item, { 'animation-duration': `${obj.sets.speed / 2 / 1000}s` }));
    return;
  }
  if (obj.sets.animation === 'data-animate') {
    let animate = dom.findAll('.slider-animate', obj.slides);
    if (!animate || !animate.length) return;
    let duration = obj.sets.speed / 2 / 1000;
    obj.animate = animate.map(el => {
      el.style.animationDuration = duration + 's';
      return {
        el: el,
        delayIn: el.dataset.sliderDelayin ? parseFloat(el.dataset.sliderDelayin) : 0,
        delayOut: el.dataset.sliderDelayout ? parseFloat(el.dataset.sliderDelayout) : 0,
        animateIn: el.dataset.sliderIn ? el.dataset.sliderIn.split(',').map(item => item.replace(/ /g, '')) : [],
        animateOut: el.dataset.sliderIn ? el.dataset.sliderOut.split(',').map(item => item.replace(/ /g, '')) : []
        // animations: []
      }
    });
    return;
  }
}




export const rmSlidesActiveClass = ({ obj }) => {
  dom.removeClass(obj.slides, 'current-slide');
}


export const addSlidesActiveClass = ({ slidesIds, obj }) => {
  slidesIds.forEach(id => {
    dom.addClass(obj.slides[id], 'current-slide');
  })
}




export const setResponsiveSets = ({ obj }) => {

  let width = window.innerWidth;
  let breakpoints = Object.keys(obj.responsive).map(key => key !== 'def' && parseFloat(key)).sort((a, b) => b < a);
  let current = 'def';

  for (let i = 0; i < breakpoints.length; i++) {
    if (width <= breakpoints[i]) {
      current = breakpoints[i].toString();
      break
    }
  }

  if (current === 'def') {
    obj.sets = { ...obj.defSets }
  } else {
    obj.sets = { ...obj.defSets, ...obj.responsive[current] }
  }
}





export const getTranslate = ({ obj }) => {
  return obj.outher.dataset.translate ? parseFloat(obj.outher.dataset.translate) : 0;
}