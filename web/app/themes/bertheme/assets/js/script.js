const baseURL = new URL('./modules/', import.meta.url).href;

const initScripts = () => {
  // header module
  import(baseURL + 'init-header.js').then((initHeaderModule) => {
    initHeaderModule.default(baseURL);
  });
  // portion module
  import(baseURL + 'init-portion.js').then((initPortionModule) => {
    initPortionModule.default(baseURL);
  });
};

window.addEventListener('load', initScripts);
