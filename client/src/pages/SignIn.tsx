import { useEffect, useState } from "react"
import Cookies from 'js-cookie';

type ImageCoverType ={
    img : string,
    colorbg : string
}
function SignIn() {
    
    const [RoundomImageCover] = useState<ImageCoverType[]>([
        {
            img : 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/store-card-40-watch-s10-202409?wid=800&hei=1000&fmt=jpeg&qlt=90&.v=1724095131742',
            colorbg : '#C4C4C4'
        },
        {
            img : 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/store-card-40-iphone-16-pro-202409_GEO_US?wid=800&hei=1000&fmt=jpeg&qlt=90&.v=1726165763260',
            colorbg : '#C4C4C4'
        },
        {
            img : 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/store-card-40-macbook-pro-202410?wid=800&hei=1000&fmt=p-jpg&qlt=95&.v=1728342374593',
            colorbg : '#C4C4C4'
        },
        {
            img : 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/store-card-40-iphone-16-202409_GEO_US?wid=800&hei=1000&fmt=jpeg&qlt=90&.v=1725661572513',
            colorbg : '#C4C4C4'
        },
        {
            img : 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/store-card-40-ipad-air-202405?wid=800&hei=1000&fmt=jpeg&qlt=90&.v=1713308272877',
            colorbg : '#C4C4C4'
        },
        {
            img : 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/store-card-40-ipad-pro-202405?wid=800&hei=1000&fmt=p-jpg&qlt=95&.v=1713308272816',
            colorbg : '#C4C4C4'
        },
        {
            img : 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/store-card-40-imac-202410?wid=800&hei=1000&fmt=p-jpg&qlt=95&.v=1728341291219',
            colorbg : '#C4C4C4'
        },
        {
            img : 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/store-card-40-vision-pro-202401?wid=800&hei=1000&fmt=jpeg&qlt=90&.v=1705097770616',
            colorbg : '#C4C4C4'
        },
        {
            img : 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/store-card-40-vision-pro-202401?wid=800&hei=1000&fmt=jpeg&qlt=90&.v=1705097770616',
            colorbg : '#C4C4C4'
        },
        {
            img : 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/store-card-40-macbook-air-202402?wid=800&hei=1000&fmt=p-jpg&qlt=95&.v=1707259289595',
            colorbg : '#C4C4C4'
        }
    ]);
    const [loading , isloading ] = useState({
        message: '' ,
        status: null,
        isloading : false
    });
    const [randomImage, setRandomImage] = useState<ImageCoverType | null>(null);
 
    useEffect(() => {
        const getRandomImage = () => {
          const randomIndex = Math.floor(Math.random() * RoundomImageCover.length);
          return RoundomImageCover[randomIndex];
        };
    
        setRandomImage(getRandomImage());
      }, [RoundomImageCover]);
    
    const HandleSignIn = (e: React.FormEvent) =>
    {
        e.preventDefault();
        isloading((prev)=>({
            ...prev ,
            isloading : true
        }));

        const form = e.target as HTMLFormElement;
        const formData = new FormData(form);


        fetch("http://localhost:8484/signin", {
            method: "POST",
            body: formData,
        })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Failed to sign in");
          }
          return response.json();
        })
        .then((data) => {
            if(data.status){
                Cookies.set('auth-token', data.token)

            }
            isloading((prev)=>({
                ...prev ,
                message : data.message ,
                status : data.status
            }));
        })
        .catch((error) => {
            isloading((prev)=>({
                ...prev ,
                message : error
            }));
        })
        .finally(() => {
            isloading((prev)=>({
                ...prev ,
                isloading : false
            }));
        });
    }
    return (
    <div>
        <div className="font-[sans-serif]">
      <div className="min-h-screen flex flex-col items-center justify-center">
        <div className="grid md:grid-cols-2 items-center gap-4 max-md:gap-8 max-w-6xl max-md:max-w-lg w-full p-4 rounded-md">
          <div className="md:max-w-md w-full px-4 py-4">
          <form onSubmit={HandleSignIn}>
                <div className="mb-6">
                <h3 className="text-gray-800 text-3xl font-extrabold">Sign in to your account
                </h3>
                <p className="text-sm mt-2 text-gray-800">Don't have an account <a href="javascript:void(0);" className="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap">Register here</a></p>
              </div>

              <div>
                <label className="text-gray-800 text-xs block mb-2">Email</label>
                <div className="relative flex items-center">
                  <input name="email" type="text"  className="w-full text-gray-800 text-sm border-b border-gray-300 focus:border-blue-600 pl-2 pr-8 py-3 outline-none" placeholder="Enter email" />
                </div>
              </div>

              <div className="mt-8">
                <label className="text-gray-800 text-xs block mb-2">Password</label>
                <div className="relative flex items-center">
                  <input name="password" type="password"  className="w-full text-gray-800 text-sm border-b border-gray-300 focus:border-blue-600 pl-2 pr-8 py-3 outline-none" placeholder="Enter password" />
                </div>
              </div>

              <div className="flex flex-wrap items-center justify-between gap-4 mt-6">
                <div className="flex items-center">
                  <input id="remember-me" name="remember-me" type="checkbox" className="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                  <label className="ml-3 block text-sm text-gray-800">
                    Remember me
                  </label>
                </div>
                <div>
                  <a href="jajvascript:void(0);" className="text-blue-600 font-semibold text-sm hover:underline">
                    Forgot Password?
                  </a>
                </div>
              </div>
              {(loading.message != '') && 
              (
                <div className={`mt-5 flex items-center p-3  text-sm ${loading.status ? 'bg-green-200': 'bg-red-100'} rounded-lg bg-red-50  ${loading.status ? 'dark:text-green-700': 'dark:text-red-400'}`} role="alert">
                    <svg className="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span className="sr-only">Info</span>
                    <div>
                        <span className="font-medium">{loading?.message}.</span>
                    </div>
                    </div>
              )}
              <div className="mt-5">
                <button type="submit" className="w-full shadow-xl py-2.5 px-4 text-sm tracking-wide rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                  {loading.isloading ? (
                    <svg aria-hidden="true" role="status" className="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                  ) : (
                      <span>Sign in</span>
                  )}
                </button>
                
              </div>

              <div className="my-4 grid grid-cols-[30%,1fr,30%] items-center ">
                <hr className="w-full border-gray-300" />
                <p className="text-sm text-gray-800 text-center">Or continue with</p>
                <hr className="w-full border-gray-300" />
              </div>

              <div className="space-x-6 flex justify-center shadow-md border-gray-300 border-[1px] py-2">
                <button type="button"
                  className="border-none outline-none">
                  <svg xmlns="http://www.w3.org/2000/svg" className="w-7 h-7 inline" viewBox="0 0 512 512">
                    <path fill="#fbbd00"
                      d="M120 256c0-25.367 6.989-49.13 19.131-69.477v-86.308H52.823C18.568 144.703 0 198.922 0 256s18.568 111.297 52.823 155.785h86.308v-86.308C126.989 305.13 120 281.367 120 256z"
                      data-original="#fbbd00" />
                    <path fill="#0f9d58"
                      d="m256 392-60 60 60 60c57.079 0 111.297-18.568 155.785-52.823v-86.216h-86.216C305.044 385.147 281.181 392 256 392z"
                      data-original="#0f9d58" />
                    <path fill="#31aa52"
                      d="m139.131 325.477-86.308 86.308a260.085 260.085 0 0 0 22.158 25.235C123.333 485.371 187.62 512 256 512V392c-49.624 0-93.117-26.72-116.869-66.523z"
                      data-original="#31aa52" />
                    <path fill="#3c79e6"
                      d="M512 256a258.24 258.24 0 0 0-4.192-46.377l-2.251-12.299H256v120h121.452a135.385 135.385 0 0 1-51.884 55.638l86.216 86.216a260.085 260.085 0 0 0 25.235-22.158C485.371 388.667 512 324.38 512 256z"
                      data-original="#3c79e6" />
                    <path fill="#cf2d48"
                      d="m352.167 159.833 10.606 10.606 84.853-84.852-10.606-10.606C388.668 26.629 324.381 0 256 0l-60 60 60 60c36.326 0 70.479 14.146 96.167 39.833z"
                      data-original="#cf2d48" />
                    <path fill="#eb4132"
                      d="M256 120V0C187.62 0 123.333 26.629 74.98 74.98a259.849 259.849 0 0 0-22.158 25.235l86.308 86.308C162.883 146.72 206.376 120 256 120z"
                      data-original="#eb4132" />
                  </svg>
                  <span className="ml-3">google</span>
                </button>
              </div>
            </form>
          </div>

          <div className="w-auto h-auto flex items-center bg-gray-300 rounded-xl ">
            <img 
            src={randomImage?.img}
            className="w-[100%] h-[90vh] object-cover rounded-md shadow-md" alt="login-image" />
          </div>
        </div>
      </div>
    </div>
    </div>
  )
}

export default SignIn