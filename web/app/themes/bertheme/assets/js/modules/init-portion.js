const initPoritonModule = (baseURL) => {
  const $portionContainer = document.querySelector('.recipe__portionContainer');

  if ($portionContainer) {
    const $btnLessPortion = document.getElementById('btnLessPortion');
    const $btnMorePortion = document.getElementById('btnMorePortion');
    const $portionValue = document.getElementById('portionValue');
    const $ingredients = document.querySelectorAll('.recipe__quantity');

    import(baseURL + 'portion.js').then((portionModule) => {
      portionModule.default({
        $btnLessPortion,
        $btnMorePortion,
        $portionValue,
        $ingredients,
      });
    });
  }
};

export default initPoritonModule;
