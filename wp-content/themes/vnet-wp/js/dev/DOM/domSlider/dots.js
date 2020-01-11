import { appendControls, getTotalSteps, getSlidesByStep, setCurrentSlides, setStep, getStep } from "./functions.js";
import { React } from "../domReact";
import { changeSliderTo } from "./changeSlider.js";


export const dots = ({ obj }) => {
  if (!obj.sets.dots) return;

  let dots;
  if (obj.sets.dotsHTML === 'default') {
    dots = (<div className="slider-dots"></div>);
  } else {
    if (typeof obj.sets.dotsHTML === 'string') {
      dots = dom.strToDom(obj.sets.dotsHTML);
    } else {
      dots = obj.sets.dotsHTML;
    }
  }
  obj.dots = dots;
  let totalSteps = getTotalSteps({ obj });

  if (obj.sets.dotsHTML === 'default') {
    for (let i = 1; i <= totalSteps; i++) {
      obj.dots.appendChild(<button type="button" className="slide-dot" data-step={i}></button>);
    }
  }

  appendControls({ item: obj.dots, wrap: obj.sets.appendDots, slider: obj.slider });

  dom.addClass(obj.slider, 'has-dots');

  let step = getStep({ obj });
  addActiveDotClass({ step, obj });
  initDots({ obj });
}


const initDots = ({ obj }) => {
  obj.dots.addEventListener('click', e => {
    e.preventDefault();
    if (!e.target.hasAttribute('data-step')) return;
    let step = parseInt(e.target.dataset.step);
    changeSliderTo({ step, obj });
  });
}



export const dotsDestroy = ({ obj }) => {
  if (obj.dots) dom.remove(obj.dots);
}




export const rmActiveDotsClass = ({ obj }) => {
  dom.removeClass(dom.findAll('.slide-dot', obj.dots), 'active-dot');
}


export const addActiveDotClass = ({ step, obj }) => {
  let dot = dom.findFirst(`*[data-step="${step}"]`, obj.dots);
  if (dot) {
    dom.addClass(dot, 'active-dot');
  }
}


const findDots = ({ slider, sets }) => {
  let dots;
  if (sets.appendDots === 'slider') {
    return dom.findFirst('.slider-dots', slider);
  }
  if (dom.isDomEl(sets.appendDots)) {
    return dom.findFirst('.slider-dots', sets.appendDots);
  }
  let wrap = dom.findFirst(sets.appendDots);
  return dom.findFirst('.slider-dots', wrap);
}


