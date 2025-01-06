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

const CartWithAuth = ValidationAuth(Contact);

function App() {

  return (
    <div className="bg-[#F5F5F3]">
      <BrowserRouter>
        <Routes>
          <Route path="/" index element={<Home />} />
          <Route path="/shop" index element={<Shop />} />
          <Route path="/about" index element={<About />} />
          <Route path="/cart" index element={<Cart />} />
          <Route path="/contact" index element={<CartWithAuth />} />
          <Route path="/product" index element={<Product />} />
          <Route path="/signup" index element={<SignUp />} />
          <Route path="/signin" index element={<SignIn />} />
          <Route path="*" element={<NotFound />} />
        </Routes>
      </BrowserRouter>
    </div>
  )
}

export default App
