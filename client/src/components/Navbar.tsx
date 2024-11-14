import Logo from '../assets/images/bag-smile-svgrepo-com.svg'
import Cart from './Cart.tsx'
import  {useState} from 'react'

export default function Navbar() {
    const [isMenuOpen, setIsMenuOpen] = useState(false);
    const toggleMenu = ():void => { setIsMenuOpen(!isMenuOpen); };
    return(
        <>
            <nav className="flex items-center justify-between flex-wrap  p-6">
                <div className="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
                    <div className="text-sm lg:flex-grow">
                        <a href="#responsive-header"
                           className="block mt-4 lg:inline-block lg:mt-0 text-black hover:text-green-700 mr-4">
                            Women
                        </a>
                        <a href="#responsive-header"
                           className="block mt-4 lg:inline-block lg:mt-0 text-black-200 hover:text-green-700 mr-4">
                            Men
                        </a>
                        <a href="#responsive-header"
                           className="block mt-4 lg:inline-block lg:mt-0 text-black-200 hover:text-green-700">
                            Kids
                        </a>
                    </div>
                    <div className="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
                        <img
                            className="block mt-3 lg:inline-block lg:mt-0" src={Logo} alt="Logo"/>
                    </div>
                    <div className="relative inline-block text-left">
                        <div>
                            <button type="button"
                                    className="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                    id="menu-button"
                                    aria-expanded="true"
                                    aria-haspopup="true"
                                    onClick={toggleMenu}>
                               Cart
                            </button>
                        </div>
                        {isMenuOpen && (
                            <Cart/>
                        )}
                    </div>
                </div>
            </nav>
        </>
)
}