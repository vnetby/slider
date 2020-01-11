import { DOM } from "./DOM/DOM.js";
import { React } from "./DOM/domReact";

window.dom = new DOM;

import "@babel/polyfill";



import "../../css/dev/main.less";

import { domSlider } from "./DOM/domSlider";
// import { DomTabs } from "./DOM/DomTabs";

import { sliderConstructor } from "./sliderConstructor";

import { customTabs } from "./customTabs";

const dinamicFunctions = wrap => {


  let constructorEditor;

  dom.findAll('.highlight-code').map(item => {
    let cm = CodeMirror.fromTextArea(item, {
      value: item.value,
      lineNumbers: true,
      mode: item.dataset.mode || 'htmlmixed',
      theme: 'material-darker',
      indentWithTabs: true,
      scrollbarStyle: 'overlay',
      matchTags: { bothTags: true },
      extraKeys: { "Ctrl-J": "toMatchingTag" },
      matchBrackets: true
    });
    cm.execCommand('selectAll');
    cm.execCommand('indentAuto');
    cm.execCommand('goDocStart');
    if (item.classList.contains('constructor-editor')) constructorEditor = cm;
  });

  // new DomTabs(wrap);


  let sliders = domSlider(wrap, {
    animationIn: ['flipInY', 'bounceIn', 'bounceInDown', 'bounceInUp'],
    animationOut: ['flipOutY', 'bounceOut', 'bounceOutDown', 'bounceOutUp'],
  });

  let slider = sliders.getSliderById('testSlider');

  sliderConstructor({ slider, editor: constructorEditor });

  customTabs();

}



const staticFunctions = wrap => {
}




dinamicFunctions();
staticFunctions();
