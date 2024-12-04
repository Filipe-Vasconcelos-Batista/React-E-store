import Logo from '../assets/images/bag-smile-svgrepo-com.svg'
import Cart from './Cart.tsx'
import  {useState, useEffect,} from 'react'
import {Link, useNavigate} from 'react-router-dom'

export default function Navbar({ toggleMenu, isMenuOpen }) {
    const capitalizeFirstLetter = (str: string) => str.charAt(0).toUpperCase() + str.slice(1);
    const navigate= useNavigate();
    const handleCategoryClick=(categoryName)=>{
        navigate(`/?category=${categoryName}`);
    }
    const [categories, setCategories] = useState([]);
    useEffect(()=>{
        const fetchCategories= async()=>{
            const response= await fetch('http://localhost:8080/Api/GraphQL.php',{
                method:'POST',
                headers:{
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    query:`{
                        categories{
                            id
                            name
                        }
                    }`
                })
            })
            const result=await response.json();
            setCategories(result.data.categories);
        }
        fetchCategories();
    },[]);
    return(
        <>
            <nav className="flex items-center justify-between flex-wrap  p-6">
                <div className="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
                    <div className="text-sm lg:flex-grow">
                        {categories.map(category=>(
                            <button className="block mt-4 lg:inline-block lg:mt-0 text-black hover:text-green-700 mr-4" key={category.id}
                            onClick={()=>handleCategoryClick(category.name)}>
                                {capitalizeFirstLetter(category.name)}
                            </button>
                        ))}
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