import { useEffect, useState } from "react"
import Cookies from 'js-cookie'

type ProductType = {
    id_command: number, 
    img: string,
    name: string,
    prix: number, 
    quantité: number, 
    Status: number, 
}

function Orderspanel() {
    const [comands, setCommands] = useState<{ id_command: number; price: number ,  Validestatus: number ,  products: ProductType[] }[]>([]);
    useEffect(() => {
        const FetchCommand = () => {
          const url = import.meta.env.VITE_APP_API_URL;
          const authToken = Cookies.get("auth-token");
    
          fetch(`${url}/getcommand`, {
            method: "GET",
            headers: {
              Authorization: `Bearer ${authToken}`,
              "Content-Type": "application/json",
            },
          })
            .then((res) => res.json())
            .then((data) => {
              if (!Array.isArray(data) || data.length === 0) {
                setCommands([]); // If data is invalid, set an empty array
                return;
              }
    
              const groupedCommands = data.reduce(
                (
                  acc: Record<number, { id_command: number; price: number; Validestatus: number; products: ProductType[] }>,
                  item: ProductType
                ) => {
                  const key = item.id_command;
    
                  if (!acc[key]) {
                    acc[key] = {
                      id_command: key,
                      price: 0,
                      Validestatus : 0 ,
                      products: [],
                    };
                  }
                  acc[key].price += item.prix * item.quantité;
                  acc[key].products.push(item);
                
                  if(item.Status == 1)
                    {
                      acc[key].Validestatus = acc[key].Validestatus + 1 
                      }

                  return acc;
                },
                {} 
              );
              console.log(groupedCommands)
              setCommands(Object.values(groupedCommands));
            })
            .catch((err) => console.error("Error fetching commands:", err));
        };
    
        FetchCommand();
      }, []);
    return (
        <div>
            <div className="bg-[#F5F7F7]">
                <ul className="grid grid-cols-[10%,50%,20%,20%] py-5 px-10 font-semibold text-ld  ">
                    <li>CommandId</li>
                    <li>Products</li>
                    <li>Sub Total</li>
                    <li>Status</li>
                </ul>
            </div>
            <div className="">
                        {comands.length > 0 ? 
                            <>
                                   {comands && comands.map((item) => (
                                        <>
                                        <div className={`grid grid-cols-[10%,50%,20%,20%] items-center py-5 px-10 ${comands?.length < 0 && 'min-h-24'} border-[1px] mt-2`}>
                                                <div className="">
                                                {item.id_command}
                                                </div>
                                                <div  className="flex items-center -space-x-2 overflow-hidden">
                                                    {item && Array.from(item.products).map((pr:any)=>(
                                                        <>
                                                            <img className="border-[3px] inline-block size-14 rounded-full ring-2 ring-white" src={pr?.img} alt="" />
                                                        </>
                                                    ))}
                                                </div>
                                                <div className="">
                                                    $ {item.price}
                                                </div>
                                                <div className="">
                                                    <span className="bg-blue-400 px-4 py-1 rounded-md text-center h-auto">{item.Validestatus}/{item.products.length} Order Confirmed</span>
                                                </div>
                                         </div>       
                                        </>
                                    ))}  
                            </>
                        :
                        <div className="col-span-4 py-20">
                            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" className="animate-spin text-center justify-self-center will-change-transform" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
                        </div>
                        }
            

            </div>

        </div>
    )
}

export default Orderspanel