import { BrowserRouter , Routes , Route } from "react-router";
import Home from './pages/Home'
import Shop from './pages/Shop'
import About from './pages/About'
import Contact from './pages/Contact'
import Cart from './pages/Cart'
import Product from './pages/Product'
import SignIn from './pages/SignIn'
import SignUp from './pages/SignUp'
import NotFound from './pages/NotFound'
import ValidationAuth from './Middleware/ValidationAuth'
import './index.css'
const HomeWithAuth = ValidationAuth(Home);
const ShopWithAuth = ValidationAuth(Shop);
const AboutWithAuth = ValidationAuth(About);
const ProductWithAuth = ValidationAuth(Product);
const CartWithAuth = ValidationAuth(Cart);
const ContactWithAuth = ValidationAuth(Contact);

function App() {
  return (
    <div className="container bg-[#F5F5F3]">
      <BrowserRouter>

        <Routes>
          <Route path="/" index element={<HomeWithAuth />} />
          <Route path="/shop" index element={<ShopWithAuth />} />
          <Route path="/about" index element={<AboutWithAuth />} />
          <Route path="/cart" index element={<CartWithAuth />} />
          <Route path="/contact" index element={<ContactWithAuth />} />
          <Route path="/product" index element={<ProductWithAuth />} />
          <Route path="/signup" index element={<SignUp />} />
          <Route path="/signin" index element={<SignIn />} />
          <Route path="*" element={<NotFound />} />
        </Routes>
      </BrowserRouter>
    </div>
  )
}

export default App
