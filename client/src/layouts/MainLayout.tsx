import  {useState} from 'react'

import Navbar from "../components/Navbar.tsx";
import {Outlet} from "react-router-dom";
import '../index.css';


export default function MainLayout(){
    const [isMenuOpen, setIsMenuOpen ]=useState(false);
    const toggleMenu=()=>{
        setIsMenuOpen(!isMenuOpen);
    }
    return(
        <>
            <Navbar toggleMenu={toggleMenu} isMenuOpen={isMenuOpen} />
            <div className={`outlet-container ${isMenuOpen ? 'dark-filter' : ''}`}>
                <Outlet />
            </div>
        </>
    )
}