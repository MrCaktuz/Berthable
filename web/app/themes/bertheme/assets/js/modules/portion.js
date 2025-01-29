const portionModule = ({
  $btnLessPortion,
  $btnMorePortion,
  $portionValue,
  $ingredients,
}) => {
  const formatQuantity = (iValue) => {
    return iValue % 1 === 0 ? iValue.toString() : parseFloat(iValue.toFixed(2));
  };

  const onUpdatePoriton = (iNewValue) => {
    const iRatio = iNewValue / parseInt($portionValue.dataset.base);
    $portionValue.innerHTML = iNewValue;

    Array.from($ingredients).forEach(($ingredient) => {
      const iNewQuantity = parseFloat($ingredient.dataset.base) * iRatio;
      $ingredient.innerHTML = formatQuantity(iNewQuantity);
    });
  };

  const onMorePortion = (currentValue) => {
    onUpdatePoriton(currentValue + 1);
  };

  const onLessPortion = (currentValue) => {
    if (parseInt($portionValue.innerHTML) > 0) {
      onUpdatePoriton(currentValue - 1);
    }
  };

  $btnLessPortion.addEventListener('click', () =>
    onLessPortion(parseInt($portionValue.innerHTML))
  );

  $btnMorePortion.addEventListener('click', () =>
    onMorePortion(parseInt($portionValue.innerHTML))
  );
};

export default portionModule;
