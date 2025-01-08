import { useEffect, useState } from "react"
import Header from "../Components/Header.tsx"
import { useNavigate, useSearchParams } from 'react-router-dom';
import CartPanel from '../Components/CartPanel'
import { AddToPanier } from "../Redux/Slices/Order.tsx";
import { useDispatch  } from "react-redux";

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


function Product() {
  const navigator = useNavigate()
  const dispatch = useDispatch();
  const [Product , setProduct] = useState<ProductType | undefined>();
  const [searchParams] = useSearchParams();
  useEffect(()=>{
    const getProduct = () =>{
      const url = import.meta.env.VITE_APP_API_URL ;
        fetch(`${url}/getproducts?id=${searchParams.get('product_id')}`)
        .then(res=>res.json())
        .then(data=>{
          if(data==null)
            navigator('/shop');
            setProduct(data)
        })
    }
    getProduct();
     
  },[]);
  const AddToPanier_ = () =>{
    if (Product) {
      dispatch(AddToPanier(Product!));
      navigator('/cart');
    } else {
      console.error("Product is undefined. Cannot add to panier.");
    }
  }
  return (
    <div>
      <Header />
      <CartPanel />

      <div className="m-2 bg-white">
        {Product ? 
        <>
         <div className="grid grid-cols-2 bg-[#F5F5F3]">
            <div className="h-full flex justify-center items-center ">
              <img className="w-[70%] h-[70%] rounded-md shadow-lg object-cover" src={Product?.img} alt="" />
            </div>
          <div className="h-full w-full  xl:p-14 flex flex-col gap-6 justify-center">
            <div className="flex flex-col gap-5">
              <h2 className="text-4xl font-semibold">
               {Product?.name}
              </h2>
              <p className="text-xl font-semibold">{Product?.price}</p>
              <p className="text-base text-gray-600">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic excepturi quibusdam odio deleniti reprehenderit facilis.</p>
              <p className="text-sm">Be the first to leave a review.</p>
              <p className="font-medium text-lg">
                <span className="font-normal">Colors:</span>
                Blank and White
              </p>
              <button
              onClick={AddToPanier_}
              className="w-full py-4 bg-slate-900 hover:bg-black duration-300 text-white text-lg font-titleFont">
                Add to Cart
              </button>
              <p className="font-normal text-sm">
                <span className="text-base font-medium">
                  Categories:</span> {Product?.categoriename}
              </p>
            </div>
          </div>
        </div>
        </>
        :
        
        <>
       
            <div className="p-4 mx-auto animate-pulse space-y-4 h-[80vh]">
              <div className=" grid grid-cols-2 h-full">
                <div className="h-full flex justify-center items-center ">
                    <div className="bg-slate-300 w-[70%] h-[70%] rounded-md shadow-lg object-cover"></div>
                  </div>
                <div className="h-full grid items-center gap-10">
                    <div className="flex flex-col gap-24">
                      <div className="">
                        <div className="h-10 bg-slate-300 rounded-md w-2/4 "></div>
                        <div className="h-6 bg-slate-300 rounded w-3/4 mt-2"></div>
                        <div className="h-4 bg-slate-300 rounded w-1/2"></div>
                      </div>
                      <div className="h-10 bg-slate-300 rounded-md w-full"></div>
                      <div className="h-4 bg-slate-300 rounded w-1/3"></div>
                    </div>
                  </div>
                </div>
              </div>
            

        </>}
       
      </div>
    </div>
  )
}

export default Product