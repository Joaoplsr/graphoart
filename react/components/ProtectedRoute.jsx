import { Navigate, Outlet } from 'react-router-dom';
import { useStateContext } from '../contexts/ContextProvider';

export default function ProtectedRoute({ allowedRoles }) {
  const { user, token } = useStateContext();

  if (!token) return <Navigate to="/login" replace />;
  if (!allowedRoles.includes(user?.role)) return <Navigate to="/unauthorized" replace />;

  return <Outlet />;
}
