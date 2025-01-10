import Header from "../Components/Header.tsx"
import CartPanel from '../Components/CartPanel'
import Footer from '../pages/Footer.tsx'

function About() {
  return (
    <div className="grid grid-rows-[auto,1fr,auto] h-full">
    <Header />
    <CartPanel />
    <span>About</span>
    <Footer/>
  </div>
  )
}

export default About