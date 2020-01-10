const RESPONSIVE = {
  MOBILE: 'mobile',
  TABLET: 'tablet',
  DESKTOP: 'desktop',
  LARGE: 'large-screen'
}


export const setWindowResponsive = () => {
  
  window.isMobile = () => {
    return window.innerWidth < window.responsive.mobile;
  }
  
  window.isTablet = () => {
    return window.innerWidth >= window.responsive.mobile && window.innerWidth < window.responsive.tablet;
  }
  
  window.isDesktop = () => {
    return window.innerWidth >= window.responsive.tablet && window.innerWidth < window.responsive.desktop;
  }
  
  window.isLargeScreen = () => {
    return window.innerWidth >= window.responsive.desktop;
  }
  
  window.getScreen = () => {
    if (window.isMobile()) {
      return RESPONSIVE.MOBILE;
    }
    if (window.isTablet()) {
      return RESPONSIVE.TABLET;
    }
    if (window.isDesktop()) {
      return RESPONSIVE.DESKTOP;
    }
    if (window.isLargeScreen()) {
      return RESPONSIVE.LARGE;
    }
  }

}