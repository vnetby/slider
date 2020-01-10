import {DOM} from './DOM';


export class DomTabs extends DOM {


  constructor ( container ) {
    super ();
    this.container = this.getContainer ( container );
    if ( !this.getElements () ) return;
    this.transition = 500;
    this.init();
  }


  getElements ()  {
    this.links = this.findAll('.tab-link');
    if ( !this.links || !this.links.length ) return false;

    this.tabs = [];

    this.links.forEach ( (link, i) => {
      let active = link.classList.contains('active');
      let tab    = this.getTab( link );
      if ( active ) {
        this.current = i;
        if ( tab ) {
          this.addClass(tab, 'active');
        }
      }
      this.tabs[i] = tab;
    });

    return true;
  }


  init () {
    this.links.forEach ( (link, i) => {
      link.addEventListener('click', e => {
        e.preventDefault();
        this.initLink( link, i );
      });
    });
  }

  initLink ( link, i ) {
    if ( i === this.current ) return;
    if ( !this.tabs[i] ) return false;
    if ( this.animation ) return false;
    this.animation = true;
    this.changeActiveLink( link );
    this.hideCurrentTab()
    .then ( () => {
      this.current = i;
      this.displayCurrentTab();
      this.animation = false;
    });
  }



  hideCurrentTab() {
    return new Promise ( ( resolve, reject ) => {
      let tab = this.tabs[this.current];
      this.addClass(tab, 'fadeIn animated faster');
      this.addClass(tab, 'fadeOut faster animated');
      setTimeout( () => {
        this.removeClass(tab, 'fadeOut faster animated active');
        resolve();
      }, this.transition);
    });
  }


  displayCurrentTab () {
    let tab = this.tabs[this.current];
    this.addClass(tab, 'active fadeIn animated faster');
  }

  

  changeActiveLink ( newLink ) {
    this.links.forEach ( link => {
      if ( link === newLink ) {
        this.addClass(link, 'active');
      } else {
        this.removeClass(link, 'active');
      }
    });
  }


  getTab ( link ) {
    let href = link.getAttribute('href');
    let el;
    try {
      el = document.querySelector(href);
    } catch ( e ) {
      console.error( e );
    }
    return el;
  }

}
