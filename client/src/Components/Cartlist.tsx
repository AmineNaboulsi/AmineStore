import { ImCross } from "react-icons/im";
import { useDispatch, useSelector } from "react-redux";
import { MoreQuaniter, LessQaniter , ClearPanier } from "../Redux/Slices/Order";
import { RootState } from "../Redux/store";
import { useNavigate } from "react-router-dom";
import { useEffect, useState } from "react";
import Cookies from "js-cookie";
type SubTotal = {
  Subtotal: number,
  ShippingCharge :number,
  Total: number,
}
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
type messagecommandtype ={
    status : boolean | null , 
    message : string
}
function Cartlist() {
  const dispatch = useDispatch();
  const navigator = useNavigate();
  const productsStore = useSelector((state : RootState) => state.panier);
  const [GetCommand, isGetCommand] = useState<messagecommandtype>({
    status : null , 
    message : ''
  });
  const [SubTotal, setSubTotal] = useState({
    Subtotal: 0,
    ShippingCharge: 10,
    Total: 0,
  });

  useEffect(() => {
    const newSubtotal = productsStore.reduce(
      (sum: number, item: ProductType) => sum + item.price * item.quantité, 
      0
    );

    setSubTotal({
      Subtotal: newSubtotal,
      ShippingCharge: SubTotal.ShippingCharge, 
      Total: newSubtotal + SubTotal.ShippingCharge,
    });
  }, [productsStore, SubTotal.ShippingCharge]);

  const AddQantiter = (id: number) => {
    dispatch(MoreQuaniter({ id_p: id }));
  };

  const MinusQantiter = (id: number) => {
    dispatch(LessQaniter({ id_p: id }));
  };

  const CommandProducts = async() =>{
    const authtk = Cookies.get('auth-token');
    if(!authtk)
        navigator('/signin');
    const url = import.meta.env.VITE_APP_API_URL;
    const resultat = await fetch(`${url}/command`,{
      method: 'POST',
      body : JSON.stringify(productsStore),
      headers : {
        Authorization : `Bearer ${authtk}`
      }
    })
    const Data = await resultat.json();
    console.log(Data);
    setSubTotal((prev)=>({
      ...prev,
      status : Data.status , 
      message : Data.message
    }))
    dispatch(ClearPanier())
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
            Empty Cart List
          </>
        )}
          <div className="max-w-7xl gap-4 flex justify-between items-center mt-4">
            <div className="">
                {isGetCommand?.status != null && (
                  <>
                    <div className={`bg-red-100 border ${isGetCommand?.status ? 'border-green-400' : 'border-red-400' } ${isGetCommand?.status ? 'text-green-700' : 'text-red-700' } px-4 py-3 rounded relative`} role="alert">
                      <strong className="font-bold">INfo </strong>
                      <span className="block sm:inline">Something seriously bad happened.</span>
                    </div>
                  </>
                )}
            </div>
             <div className="w-96 flex flex-col gap-4">
               <h1 className="text-2xl font-semibold text-right">Cart totals</h1>
               <div>
                 <p className="flex items-center justify-between border-[1px] border-gray-400 border-b-0 py-1.5 text-lg px-4 font-medium">
                   Subtotal
                   <span className="font-semibold tracking-wide font-titleFont">
                   $ {SubTotal.Subtotal}
                   </span>
                 </p>
                 <p className="flex items-center justify-between border-[1px] border-gray-400 border-b-0 py-1.5 text-lg px-4 font-medium">
                   Shipping Charge
                   <span className="font-semibold tracking-wide font-titleFont">
                     $ {SubTotal.ShippingCharge}
                   </span>
                 </p>
                 <p className="flex items-center justify-between border-[1px] border-gray-400 py-1.5 text-lg px-4 font-medium">
                   Total
                   <span className="font-bold tracking-wide text-lg font-titleFont">
                     $ {SubTotal.Total}
                   </span>
                 </p>
               </div>
               <div className="flex justify-end">
                  <button onClick={CommandProducts} className="w-52 h-10 bg-black text-white hover:bg-black duration-300">
                     Proceed to Checkout
                   </button>
               </div>
             </div>
           </div>
    </div>
  )
}

export default Cartlist