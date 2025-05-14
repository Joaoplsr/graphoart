import { createBrowserRouter, Navigate } from "react-router-dom";
import { useAuth } from "../contexts/AuthContext";
import LoginForm from "../components/LoginForm";
import NotFound from "../pages/NotFound";
import AdminLayout from "../layouts/AdminLayout";

// Componente de proteção
const RoleProtectedRoute = ({ allowedRoles, element }) => {
    const { user } = useAuth();

    if (!user) return <Navigate to="/login" replace />;
    if (!allowedRoles.includes(user.role)) return <Navigate to="/unauthorized" replace />;

    return element;
};

// Roteador
export const router = createBrowserRouter([
    {
        path: "/login",
        element: <LoginForm />,
    },
    {
        path: "*",
        element: <NotFound />,
    },
    {
        path: "/admin",
        element: (
            <RoleProtectedRoute allowedRoles={["admin"]} element={<AdminLayout />} />
        ),
        children: [
            {
                path: "nadaaver",
                index: true,
                element: <h1>Nada a ver</h1>
            },
        ]
    },
]);

export default router;
