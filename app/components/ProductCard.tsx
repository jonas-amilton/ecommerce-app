import React from "react";
import type { Product } from "~/context/CartContext";

interface Props {
  product: Product;
  onAdd: (product: Product) => void;
}

const ProductCard: React.FC<Props> = ({ product, onAdd }) => {
  return (
    <div
      style={{
        border: "1px solid gray",
        padding: "1rem",
        marginBottom: "1rem",
      }}
    >
      <h3>{product.name}</h3>
      <p>Preço: ${product.price.toFixed(2)}</p>
      <button onClick={() => onAdd(product)}>Adicionar ao carrinho</button>
    </div>
  );
};

export default ProductCard;
