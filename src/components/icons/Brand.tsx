import React from "react";
import styles from "../../styles/icons.module.css";

type BrandIconProps = {
  className?: string;
};

const BrandIcon: React.FC<BrandIconProps> = ({ className }) => {
  return (
    <i
      className={`flex-shrink-0 flex-grow-0 size-40 bg-gray ${styles.brand} ${className}`}
    />
  );
};

export default BrandIcon;
