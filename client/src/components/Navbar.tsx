import Logo from '../assets/images/bag-smile-svgrepo-com.svg'
export default function Navbar() {
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
                    <div>
                        <a href="#"
                           className="inline-block text-sm px-4 py-2 leading-none border rounded text-black border-white hover:border-transparent hover:text-green-700  mt-4 lg:mt-0">
                            Cart
                        </a>
                    </div>
                </div>
            </nav>
        </>
    )
}