import { useEffect , useState } from "react"

type CategorieType =  {
    id_ca: number,
    Name: string,
    img: string
}

function Categories() {
  const [categories , setcategories] = useState<CategorieType[]>();
  useEffect(()=>{
    const url = import.meta.env.VITE_APP_API_URL;
    fetch(`${url}/getcategories`)
    .then(res=>res.json())
    .then(data=>{
        setcategories(data);
        console.log(data)
    })
  },[])
  return (
    <div className="">
      <div className="font-semibold text-xl ">Shop by Category</div>
      <div className="mt-4">
            <div className="py-2 cursor-pointer">
                <span className="text-gray-900 font-semibold">All</span>
                <hr />
            </div>
        {categories && categories.map((item : CategorieType)=>(
            <div className="py-2 cursor-pointer">
                <span className="text-gray-500 mb-1 hover:text-gray-900">{item?.Name}</span>
                <hr />
            </div>
        ))}
      </div>
    </div>
  )
}

export default Categories