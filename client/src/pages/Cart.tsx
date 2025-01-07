import React, { useEffect, useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { Link } from "react-router-dom";
import { HiOutlineChevronRight } from "react-icons/hi";
import Header from '../Components/Header'
import { ImCross } from "react-icons/im";

const Cart = () => {
  const dispatch = useDispatch();
  const productsStore = useSelector((state) => state.Orderinfo.panier);
console.log(productsStore)
  // const [totalAmt, setTotalAmt] = useState("");
  // const [shippingCharge, setShippingCharge] = useState("");
  // useEffect(() => {
  //   let price = 0;
  //   products.map((item) => {
  //     price += item.price * item.quantity;
  //     return price;
  //   });
  //   // setTotalAmt(price);
  // }, [products]);
  // useEffect(() => {
  //   if (totalAmt <= 200) {
  //     setShippingCharge(30);
  //   } else if (totalAmt <= 400) {
  //     setShippingCharge(25);
  //   } else if (totalAmt > 401) {
  //     setShippingCharge(20);
  //   }
  // }, [totalAmt]);
  return (
    <div className="">
      <Header />
      <div className="max-w-container mx-auto px-4 bg-white">
        <div className="w-full py-10 xl:py-10 flex flex-col gap-3">
            <h1 className="text-5xl text-primeColor font-titleFont font-bold">
              Cart
            </h1>
            <p className="text-sm font-normal text-lightText capitalize flex items-center">
              <span>Home</span>

              <span className="px-1">
                <HiOutlineChevronRight />
              </span>
              <span className="capitalize font-semibold text-primeColor">
                locationPath
              </span>
            </p>
          </div>
        <div className="bg-[#F5F7F7]">
          <ul className="grid grid-cols-[40%,20%,20%,20%] py-5 px-10 font-semibold text-ld  ">
            <li>Product</li>
            <li>Price</li>
            <li>Qantity</li>
            <li>Sub Total</li>
          </ul>
        </div>
        {productsStore.length > 0 ? (
          productsStore && productsStore.map((item)=>(
            <>
            <div className="pb-20">
           
           <div className="mt-5">
           <div className="w-full grid grid-cols-[40%,20%,20%,20%] items-center mb-4 border">
             <div className="flex items-center gap-4 ml-4">
               {/* ImCross */}
               <ImCross className="text-primeColor hover:text-red-500 duration-300 cursor-pointer" />
                
               <img className="w-32 h-32" src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/mac-card-40-macbook-air-202410?wid=680&hei=528&fmt=p-jpg&qlt=95&.v=1731974970795" alt="productImage" />
               <h1 className="font-titleFont font-semibold">{item.name}</h1>
             </div>
               <div className="flex items-center text-lg font-semibold">
                 ${item?.prix}
               </div>
               <div className="flex items-center gap-6 text-lg">
                 <span
                   className="w-6 h-6 bg-gray-100 text-2xl flex items-center justify-center hover:bg-gray-300 cursor-pointer duration-300 border-[1px] border-gray-300 hover:border-gray-300"
                 >
                   -
                 </span>
                 <p>1</p>
                 <span
                   className="w-6 h-6 bg-gray-100 text-2xl flex items-center justify-center hover:bg-gray-300 cursor-pointer duration-300 border-[1px] border-gray-300 hover:border-gray-300"
                 >
                   +
                 </span>
               </div>
               <div className="flex items-center font-titleFont font-bold text-lg">
                 <p>$1520</p>
               </div>
           </div>
           </div>

           <div className="max-w-7xl gap-4 flex justify-end mt-4">
             <div className="w-96 flex flex-col gap-4">
               <h1 className="text-2xl font-semibold text-right">Cart totals</h1>
               <div>
                 <p className="flex items-center justify-between border-[1px] border-gray-400 border-b-0 py-1.5 text-lg px-4 font-medium">
                   Subtotal
                   <span className="font-semibold tracking-wide font-titleFont">
                     totalAmt
                   </span>
                 </p>
                 <p className="flex items-center justify-between border-[1px] border-gray-400 border-b-0 py-1.5 text-lg px-4 font-medium">
                   Shipping Charge
                   <span className="font-semibold tracking-wide font-titleFont">
                     shippingCharge
                   </span>
                 </p>
                 <p className="flex items-center justify-between border-[1px] border-gray-400 py-1.5 text-lg px-4 font-medium">
                   Total
                   <span className="font-bold tracking-wide text-lg font-titleFont">
                     $624615
                   </span>
                 </p>
               </div>
               <div className="flex justify-end">
                 <Link to="/paymentgateway">
                   <button className="w-52 h-10 bg-black text-white hover:bg-black duration-300">
                     Proceed to Checkout
                   </button>
                 </Link>
               </div>
             </div>
           </div>
         </div>
            </>
          ))
        ) : (
          <>
          non
          </>
        )}
      </div>
    </div>
  );
};

export default Cart;