export default function Cart(){
    return(
        <>
        <div
            className="absolute right-0 z-10 mt-2 w-80 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabIndex="-1">
            <div className="py-1" role="none">
                <div className="px-4 py-2 flex items-center space-x-2">
                    <span className="text-xs text-gray-900 font-bold">My Bag</span>
                    <span className="text-xs text-gray-900" >   3 Items</span>
                </div>
            </div>
            <div className="py-1" role="none">


                <div className="py-1" role="none">
                    <div className="max-w-full w-full lg:max-w-full lg:flex">
                        <div
                            className="w-full lg:w-2/4  rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                            <div className="mb-1 flex justify-between leading-normal ">
                                <p className="text-sm text-gray-600 flex items-center lg:w-3/4">
                                    Running Short
                                </p>
                                <button className='border-black text-[10px] border w-4 h-4'>+</button>
                            </div>

                            <div className="text-gray-900 font-bold text-xs mb-2">
                                $ value
                            </div>


                            <div className="mb-1 flex justify-between leading-normal ">
                                <p className="text-xs text-gray-600 flex items-center lg:w-3/4">
                                    Size:
                                </p>
                                <p className="text-xs text-gray-600 flex  lg:w-4/4 ">1
                                </p>
                            </div>

                            <div className=" flex leading-normal space-x-0.5 ">
                                <button className='border-black text-[10px] border w-4'>XS</button>
                                <button className='border-black text-[10px] border w-4'>S</button>
                                <button className='border-black text-[10px] border w-4'>M</button>
                                <button className='border-black text-[10px] border w-4'>L</button>
                            </div>

                            <div className="text-gray-900 text-xs mb-2">
                                Color:
                            </div>

                            <div className="flex justify-between leading-normal ">
                                <div className="flex leading-normal space-x-0.5 ">
                                    <button className='border-black text-[10px] border w-4'>XS</button>
                                    <button className='border-black text-[10px] border w-4'>S</button>
                                    <button className='border-black text-[10px] border w-4'>M</button>
                                    <button className='border-black text-[10px] border w-4'>L</button>
                                </div>
                                <button className='border-black text-[10px] border w-4'>-</button>
                            </div>


                        </div>
                        <div
                            className="h-20 lg:h-auto lg:w-2/4 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden"
                            style={{backgroundImage: `url('https://www.svgrepo.com/show/526777/bag-smile.svg')`}}
                        >
                        </div>
                    </div>

                </div>


            </div>




            <div
                className="w-full rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                <div className="mb-1 flex justify-between leading-normal ">
                    <p className="text-sm text-black flex items-center lg:w-3/4">
                        Total
                    </p>
                    <p className="text-sm font-bold text-gray-600 flex items-center ">
                        Value $
                    </p>
                </div>
            </div>


            <div
                className="w-full rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                <button className="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4">
                    Place Order
                </button>
            </div>
        </div>
        </>
    )
}