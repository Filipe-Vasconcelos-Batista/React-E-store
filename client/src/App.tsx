import {
    Route,
    createBrowserRouter,
    createRoutesFromElements,
    RouterProvider,
    useLocation
} from 'react-router-dom'

import Homepage from './views/Homepage.tsx'
import MainLayout from "./layouts/MainLayout.tsx";
import Individual from './views/Individual.tsx'
import NotFound from './views/NotFound.tsx'

const router= createBrowserRouter(
    createRoutesFromElements(
        <Route path='/' element={<MainLayout />}>
            <Route index element={<Homepage />} />
            <Route path='/:id' element={<Individual />} />
            <Route path='*' element={<NotFound />} />
        </Route>
    )
);

const App= () =>{
    return <RouterProvider router={router} />;
}

export default App


