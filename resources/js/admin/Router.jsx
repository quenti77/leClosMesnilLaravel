import { Routes, Route, Navigate } from 'react-router-dom'
import AdminLayout from './pages/Layout.jsx'

import Dashboard from './pages/Dashboard.jsx'
import Blog from './pages/Blog.jsx'

export default function Router() {
    return (
        <Routes>
            <Route path="/admin" element={<AdminLayout />}>
                <Route index element={<Dashboard />} />
                <Route path="blog" element={<Blog />} />
            </Route>
            <Route path="*" element={<Navigate to="/admin" />} />
        </Routes>
    )
}
