import { useState } from "react";
import Cartlist from '../Components/Cartlist'
import Orderspanel from '../Components/Orderspanel'
import { HiOutlineChevronRight } from "react-icons/hi";
import Header from '../Components/Header'
import Footer from '../pages/Footer.tsx'

const Cart = () => {
 const [isCart , setCart] =useState(true);
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
    <div className="grid grid-rows-[auto,1fr,auto] h-full">
      <Header />
      <div className="max-w-container mx-auto px-4 bg-white  w-full">
        <div className="flex justify-between items-end">
          <div className="w-full py-10 xl:py-10 flex flex-col gap-3">
              <h1 className="text-5xl text-primeColor font-titleFont font-bold">
                {isCart ? 'Cart' : 'Orders'}
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
            <div className="mb-8">
                <div className="relative flex gap-[30px] text-center justify-center items-center w-40 border-2 rounded-xl">
                    <div className={`z-[1] absolute transition-all  bg-blue-950 h-full w-[50%] rounded-xl`} style={{left : isCart ? '0px' : '80px'}}></div>
                    <span onClick={
                      ()=>{
                        setCart(true)
                      }
                    } className={`cursor-pointer select-none  p-2 z-[1] text-${isCart ? 'white' : 'black'}`}>Cart</span>
                    <span
                     onClick={
                      ()=>{
                        setCart(false)
                      }}
                      className={`cursor-pointer select-none p-2 z-[1] text-${!isCart ? 'white' : 'black'}`}>Orders</span>
               </div>
            </div>
        </div>
        {isCart ? (
          <Cartlist />
        ) : (
         <Orderspanel />
        )} 
      
      </div>
      <Footer/>

    </div>
  );
};

export default Cart;