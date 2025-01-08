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
                    <div className={`grid grid-cols-8 gap-5 items-center `}>
                        {NavItem ?  NavItem.map((item : NavItemType , i :number)=>(
                            <>
                                <Link to={item.url}>
                                
                                        <span key={i} className="transition-all hover:font-semibold hover:underline w-10 cursor-pointer">{item?.name}</span>
                                </Link>
                                {NavItem.length > i+1 && (<TfiLayoutLineSolid height={1} className="rotate-90 text-gray-400 " />) }
                            </>
                        )) :
                        
                        <>
                             <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" className="animate-spin text-center justify-self-center will-change-transform" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
                        </>
                        }
                     
                    </div>
                </div>
        </nav>
    </div>
  )
}

export default Header