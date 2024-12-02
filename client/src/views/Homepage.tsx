import Card from "../components/Card.tsx";

export default function index() {
    return (
        <>
            <div className={"content ${isMenuOpen ? 'dark-filter' : ''}"}>
            <div className="flex mb-4">
                <div className="w-1/3 h-12">
                    <Card title='newTitle' image='https://refactoring.guru/images/content-public/logos/logo-new.png?id=97d554614702483f31e38b32e82d8e34' value='12.99' />
                </div>
                <div className="w-1/3  h-12">
                    <Card title='newTitle' image='https://refactoring.guru/images/content-public/logos/logo-new.png?id=97d554614702483f31e38b32e82d8e34' value='12.99' />
                </div>
                <div className="w-1/3  h-12">
                    <Card title='newTitle' image='https://refactoring.guru/images/content-public/logos/logo-new.png?id=97d554614702483f31e38b32e82d8e34' value='12.99' />
                </div>
            </div>
            </div>
        </>
    )
}