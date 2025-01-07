import { useEffect, useState } from "react";
import { TfiLayoutLineSolid } from "react-icons/tfi";
import { Link } from "react-router-dom";

type NavItemType = {
    name : string , url : string
}

function Header() {
    const [NavItem , setNavItem] = useState<NavItemType[]>();
    useEffect(()=>{
        const fillData = ()=>{
            setNavItem([
                {name : 'Home' , url : '/'} ,
                {name : 'Shop' , url : '/shop'} ,
                {name : 'About' , url : '/about'} ,
                {name : 'Contact' , url : '/contact'} ,
            ]);
        }
        fillData();
    },[])
  return (
    <div className="w-full h-20 bg-white sticky top-0 z-50 border-b-[1px] border-b-gray-200">
        <nav className="h-full px-4 max-w-container mx-auto relative">
                <div className="h-full flex justify-between items-center">
                    <span>AmineStore</span>
                    <div className="grid grid-cols-8 gap-5 items-center">
                        {NavItem && NavItem.map((item : NavItemType , i :number)=>(
                            <>
                                <Link to={item.url}>
                                    <span key={i} className="transition-all hover:font-semibold hover:underline w-10 cursor-pointer">{item?.name}</span>
                                </Link>
                                {NavItem.length > i+1 && (<TfiLayoutLineSolid height={1} className="rotate-90 text-gray-400 " />) }
                            </>
                        ))}
                     
                    </div>
                </div>
        </nav>
    </div>
  )
}

export default Header