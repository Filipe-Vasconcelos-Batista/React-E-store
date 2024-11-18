import {useState, useEffect} from "react";

export default function Individual(){
    return (
        <>
            <div className="inline-flex mx-auto w-3/5">
                <div className="w-1/6 flex flex-wrap justify-center">
                    <div className='p-2'>
                        <img className="w-full h-28" alt='image1'
                             src='https://www.svgrepo.com/show/526777/bag-smile.svg'/>
                    </div>
                    <div className='p-2'>
                        <img className="w-full h-28" alt='image1'
                             src='https://www.svgrepo.com/show/526777/bag-smile.svg'/>
                    </div>
                    <div className='p-2'>
                        <img className="w-full h-28" alt='image1'
                             src='https://www.svgrepo.com/show/526777/bag-smile.svg'/>
                    </div>
                    <div className='p-2'>
                        <img className="w-full h-28" alt='image1'
                             src='https://www.svgrepo.com/show/526777/bag-smile.svg'/>
                    </div>
                    <div className='p-2'>
                        <img className="w-full h-28" alt='image1'
                             src='https://www.svgrepo.com/show/526777/bag-smile.svg'/>
                    </div>
                </div>
                <div className="flex-none">
                    <img alt='image1' className="w-[600px] h-[600px]"
                         src='https://www.svgrepo.com/show/526777/bag-smile.svg'/>
                </div>
                <div className="container inline-block w-2/6 ml-14">
                    <h3 >Running Shorts</h3>
                    <h5 className="mt-2">Size</h5>
                    <div className="inline-flex">
                        <p>S</p> <p>M</p> <p>L</p>
                    </div>
                    <h5 className="mt-2">Color:</h5>
                    <div className="inline-flex">
                        <p>S</p> <p>M</p> <p>L</p>
                    </div>
                    <h5 className="mt-2">Price:</h5>
                    <h4>$Value</h4>
                    <div className=' mt-2 flex items-center justify-center '>
                        <button className="bg-green-500 hover:bg-green-700  text-white font-bold py-2 px-4 w-full">
                            Add To Cart
                        </button>
                    </div>
                    <h5 className="mt-2">Description:</h5>
                    <p className='text-xs'>
                        Short Quick and easy demonstration of the description JUST TO CHECK HOW IT LOOKS WITHOUT NOTHING ELSE ON so if i keep adding this will the margins get larger?
                    </p>
                </div>
            </div>

        </>
    )
}