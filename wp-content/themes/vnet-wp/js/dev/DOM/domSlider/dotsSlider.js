
export const dotsSlider = ({ obj }) => {
  if (!obj.sets.dotsSlider || !obj.sets.dots || !obj.dots || !obj.dotsBtns || !obj.dotsBtns.length) return;
  // setTimeout(() => {
  console.log(obj.sets.dotsSliderSets);
  let domSlider = obj.domSlider(obj.dots, {
    ...obj.sets.dotsSliderSets, ...{
      arrows: false,
      dots: false
    }
  }, true);
  // }, 20);
}




export const dotsSliderDestroy = ({ obj }) => {
  console.log('destory dots slider');
}