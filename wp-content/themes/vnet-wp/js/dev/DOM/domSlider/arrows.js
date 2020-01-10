import { getRealDomEl, appendControls, getCurrent,  getTotalSlides, getSlidesByStep, getStep, setStep, getTotalSteps } from "./functions.js";
import { getNextStep, getPrevStep, setCurrentSlides, getCurrentSlides } from "./functions";

import { changeSlider, changeSliderTo } from "./changeSlider";

import { React } from "../domReact.js";

export const arrows = ({ obj }) => {
  if (!obj.sets.arrows) return;

  let prev, next;

  if (obj.sets.prevArrow === 'default') {
    prev = prevArrowHTML();
  } else {
    prev = getRealDomEl(dom.isDomEl(obj.sets.prevArrow) ? obj.sets.prevArrow : dom.strToDom(obj.sets.prevArrow));
  }
  if (obj.sets.nextArrow === 'default') {
    next = nextArrowHTML();
  } else {
    next = getRealDomEl(dom.isDomEl(obj.sets.nextArrow) ? obj.sets.nextArrow : dom.strToDom(obj.sets.nextArrow));
  }

  if (!prev || !next) return;

  appendControls({ item: prev, wrap: obj.sets.appendArrows, slider: obj.slider });
  appendControls({ item: next, wrap: obj.sets.appendArrows, slider: obj.slider });

  obj.prevArrow = prev;
  obj.nextArrow = next;

  initPrevArrow({ obj });
  initNextArrow({ obj });

  dom.addClass(obj.slider, 'has-arrows');
}





const initPrevArrow = ({ obj }) => {
  checkDisableArrows({ obj });
  obj.prevArrow.addEventListener('click', e => {
    e.preventDefault();
    changeSliderTo({ step: getPrevStep({ obj }), obj });
    checkDisableArrows({ obj });
  });
}



const initNextArrow = ({ obj }) => {
  checkDisableArrows({ obj });
  obj.nextArrow.addEventListener('click', e => {
    e.preventDefault();
    changeSliderTo({ step: getNextStep({ obj }), obj });
    checkDisableArrows({ obj });
  });
}



const checkDisableArrows = ({ obj }) => {
  if (obj.sets.infinite) return;
  let current = getCurrentSlides({ obj });
  let totalSlides = getTotalSlides({ obj });

  if (current[0] === 0) {
    dom.addClass(obj.prev, 'disabled');
  } else {
    dom.removeClass(obj.prev, 'disabled');
  }

  if (current[current.length - 1] === totalSlides - 1) {
    dom.addClass(obj.next, 'disabled');
  } else {
    dom.removeClass(obj.next, 'disabled');
  }
}




export const arrowsDestroy = ({ obj }) => {
  if (obj.nextArrow) dom.remove(obj.nextArrow);
  if (obj.prevArrow) dom.remove(obj.prevArrow);
}





const prevArrowHTML = () => {
  return (
    <button type="button" className="slider-arrow prev-arrow">
    </button>
  );
}




const nextArrowHTML = () => {
  return (
    <button type="button" className="slider-arrow next-arrow">
    </button>
  );
}


