const baseURL = new URL('./modules/', import.meta.url).href;

const initScripts = () => {
  // header module
  import(baseURL + 'init-header.js').then((initHeaderModule) => {
    initHeaderModule.default(baseURL);
  });
};
const test = () => {
  // header module
  import(baseURL + 'init-header.js').then((initHeaderModule) => {
    initHeaderModule.default(baseURL);
  });
};

window.addEventListener('load', initScripts);
window.addEventListener('load', test);
