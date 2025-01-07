import { FaCartShopping } from "react-icons/fa6";
import { useNavigate } from "react-router-dom";

function CartPanel() {
    const navigate = useNavigate();

  return (
    <div className="fixed right-5 top-[15%] bg-white shadow-md p-3 rounded-md cursor-pointer">
    <div onClick={()=>{
        navigate('/cart')
    }}> 
        <div className="relative transition-all group">
        <div className="flex items-center gap-3">
          <FaCartShopping className="transition-transform translate-x-2 group-hover:translate-x-0" size={20} />
          <span className="opacity-0 transition-opacity group-hover:opacity-100">0</span>
        </div>
        <span className="absolute top-[-17px] right-[-14.7px] flex h-3 w-3">
          <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-gray-600 opacity-75"></span>
          <span className="relative inline-flex rounded-full h-3 w-3 bg-gray-600"></span>
        </span>
      </div>
  </div>
</div>
  )
}

export default CartPanel