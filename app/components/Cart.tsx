import React, { useContext } from "react";
import { CartContext } from "../context/CartContext";

const Cart: React.FC = () => {
  const cartContext = useContext(CartContext);

  if (!cartContext) {
    return null;
  }

  const { cartItems, removeFromCart } = cartContext;

  const total = cartItems.reduce((sum, item) => sum + item.price, 0);

  return (
    <div style={{ border: "1px solid black", padding: "1rem" }}>
      <h2>Your Cart</h2>
      {cartItems.length === 0 && <p>Cart is empty</p>}
      {cartItems.map((item) => (
        <div key={item.id} style={{ marginBottom: "0.5rem" }}>
          <span>
            {item.name} - ${item.price.toFixed(2)}
          </span>
          <button
            onClick={() => removeFromCart(item.id)}
            style={{ marginLeft: "1rem" }}
          >
            Remove
          </button>
        </div>
      ))}
      <hr />
      <h3>Total: ${total.toFixed(2)}</h3>
    </div>
  );
};

export default Cart;
