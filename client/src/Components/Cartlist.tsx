import { ImCross } from "react-icons/im";
import { useDispatch, useSelector } from "react-redux";
import { MoreQuaniter, LessQaniter } from "../Redux/Slices/Order";
import { RootState } from "../Redux/store";
import { Link } from "react-router-dom";

type ProductType  =  {
  id_p: number,
  name: string,
  price: number,
  subtotal: number,
  description: string,
  quantité: number,
  img: string,
  categoriename: string 
}
function Cartlist() {
  const dispatch = useDispatch();
    const productsStore = useSelector((state : RootState) => state.panier);
  const AddQantiter = (id:number) =>{
    dispatch(MoreQuaniter({id_p : id}))
  }
  const MinusQantiter = (id:number) =>{
    dispatch(LessQaniter({id_p : id}))
  }
  return (
    <div>
        
        <div className="bg-[#F5F7F7]">
          <ul className="grid grid-cols-[40%,20%,20%,20%] py-5 px-10 font-semibold text-ld  ">
            <li>Product</li>
            <li>Price</li>
            <li>Qantity</li>
            <li>Sub Total</li>
          </ul>
        </div>

        {productsStore.length > 0 ? (
            productsStore.map((item: ProductType)=>(
              <>
                  <div className="">
                    
                    <div className="mt-5">
                    <div className="w-full grid grid-cols-[40%,20%,20%,20%] items-center mb-4 border">
                        {/* start row */}
                      <div className="flex items-center gap-4 ml-4">
                        <ImCross className="text-primeColor hover:text-red-500 duration-300 cursor-pointer" />
                        <img className="w-32 h-32" src={item.img} alt="productImage" />
                        <h1 className="font-titleFont font-semibold">{item.name}</h1>
                      </div>
                        <div className="flex items-center text-lg font-semibold">
                          ${item?.price}
                        </div>
                        <div className="flex items-center gap-6 text-lg">
                          <span
                            onClick={()=>{
                              MinusQantiter(item?.id_p);
                            }}
                            className="select-none w-6 h-6 bg-gray-100 text-2xl flex items-center justify-center hover:bg-gray-300 cursor-pointer duration-300 border-[1px] border-gray-300 hover:border-gray-300"
                          >
                            -
                          </span>
                          <p>{item?.quantité}</p>
                          <span
                            onClick={()=>{
                              AddQantiter(item?.id_p)
                            }}
                            className="select-none w-6 h-6 bg-gray-100 text-2xl flex items-center justify-center hover:bg-gray-300 cursor-pointer duration-300 border-[1px] border-gray-300 hover:border-gray-300"
                          >
                            +
                          </span>
                        </div>
                        <div className="flex items-center font-titleFont font-bold text-lg">
                          <p>$ {item?.subtotal}</p>
                        </div>
                    </div>
                    </div>
                  </div>
              </>
          ))
        ) : (
          <>
            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" className="animate-spin text-center justify-self-center will-change-transform" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
          </>
        )}
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
  )
}

export default Cartlist