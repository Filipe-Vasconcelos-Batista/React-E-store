import Card from "../components/Card.tsx";
import {useLocation} from "react-router-dom";
import {useEffect, useState} from "react";

export default function index() {
    const location:any = useLocation()
    const searchParams:URLSearchParams = new URLSearchParams(location.search);
    const category:string = searchParams.get("category");

    const [products, setProducts] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(()=>{
        const fetchProducts = async()=>{
            try {
                setLoading(true);
                const response = await fetch('http://localhost:8080/Api/GraphQL.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        query: `query GetProducts($category: String) {
                            products(category: $category) {
                                id
                                description
                                inStock
                                price
                                category {
                                    id
                                    name
                                }
                                brand {
                                    id
                                    name
                                }
                                attributes {
                                    id
                                    name
                                    value
                                }
                            }
                        }`,
                        variables: {
                            category: category || 'all'
                        }
                    })
                });

                const data = await response.json();
                setProducts(data.data.products);
                setLoading(false);
            } catch (error) {
                console.error("Failed to fetch products", error);
                setLoading(false);
            }
        }
        fetchProducts();
    },[category])

    if (loading) return <div>Loading...</div>;

    return (
        <>
            <div className={`content ${false ? 'dark-filter' : ''}`}>
                <div className="flex flex-wrap mb-4">
                    {products.map((product)=>(
                        <div key={product.id} className={"w-1/3 p-2 h-12"}>
                            <Card
                                title={product.description}
                                image={product.attributes.find(attr => attr.name === 'image')?.value || 'default-image-url'}
                                value={product.price.toString()}
                            />
                        </div>
                    ))}
                </div>
            </div>
        </>
    )
}