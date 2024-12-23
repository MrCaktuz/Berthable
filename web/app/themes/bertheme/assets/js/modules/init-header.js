const initHeaderModule = (baseURL) => {
  const $header = document.querySelector('header.header');

  if ($header) {
    import(baseURL + 'header.js').then((headerModule) => {
      headerModule.default({ $header });
    });
  }
};

export default initHeaderModule;
