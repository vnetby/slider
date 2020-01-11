export const customTabs = () => {
  dom.findAll('.has-tabs').forEach(tabContainer => {
    let tabs = dom.findAll('.tab', tabContainer);
    let links = dom.findAll('.tab-link', tabContainer);

    tabs.forEach(item => dom.addCss(item, { display: 'none' }));

    links.forEach(link => {
      if (link.classList.contains('active')) {
        let id = link.getAttribute('href');
        tabs.map(item => {
          if ('#' + item.getAttribute('id') === id) {
            dom.css(item, { display: 'block' });
          }
        });
      }
    })
    dom.onClick(links, e => {
      e.preventDefault();
      tabs.forEach(item => dom.addCss(item, { display: 'none' }));
      links.forEach(item => dom.removeClass(item, 'active'));
      dom.addClass(e.target, 'active');
      let id = e.target.getAttribute('href');
      tabs.map(item => {
        if ('#' + item.getAttribute('id') === id) {
          dom.css(item, { display: 'block' });
        }
      });
    }, tabContainer);
  });
}