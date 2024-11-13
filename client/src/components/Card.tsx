export default function card({title, value, image
}){
return(
    <>
        <div className="max-w-sm  overflow-hidden group">
            <img className="w-full relative" src={image} alt="'image of' . {title}"></img>
            <button className="bg-blue-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full negative-margin absolute hidden group-hover:block">buy</button>
                <div className="px-6 py-4">
                    <div className="text-gray-700 text-base">{title}</div>
                    <p className=" text-xl mb-2">
                        {value} $
                    </p>
                </div>
        </div>
    </>
)
}