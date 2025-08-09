import React, { useContext } from "react";
import { CartContext, type Product } from "../context/CartContext";
import ProductCard from "./ProductCard";

const sampleProducts: Product[] = [
  { id: 1, name: "Laptop", price: 999.99 },
  { id: 2, name: "Smartphone", price: 499.99 },
  { id: 3, name: "Headphones", price: 199.99 },
];

const ProductList: React.FC = () => {
  const cartContext = useContext(CartContext);
  
  if (!cartContext) {
    return null;
  }

  const { addToCart } = cartContext;

  return (
    <div>
      {sampleProducts.map((product) => (
        <ProductCard key={product.id} product={product} onAdd={addToCart} />
      ))}
    </div>
  );
};

export default ProductList;
