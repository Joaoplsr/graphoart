import { createBrowserRouter, Navigate } from 'react-router-dom';
import PublicLayout from '../layouts/PublicLayout';
import AdminLayout from '../layouts/AdminLayout';
import EditorLayout from '../layouts/EditorLayout';
import ReviewerLayout from '../layouts/ReviewerLayout';
import NotFound from '../pages/NotFound';
import LoginForm from '../components/LoginForm';
import ProtectedRoute from '../components/ProtectedRoute';

const router = createBrowserRouter([
  {
    path: '/',
    element: <PublicLayout />,
    children: [
      {
        index: true,
        element: <Navigate to="/login" />,
      },
      {
        path: 'login',
        element: <LoginForm />,
      },
    ],
  },
  {
    path: '/admin',
    element: <ProtectedRoute allowedRoles={['admin']} />,
    children: [
      {
        index: true,
        element: <AdminLayout />,
      },
    ],
  },
  {
    path: '/editor',
    element: <ProtectedRoute allowedRoles={['editor']} />,
    children: [
      {
        index: true,
        element: <EditorLayout />,
      },
    ],
  },
  {
    path: '/reviewer',
    element: <ProtectedRoute allowedRoles={['reviewer']} />,
    children: [
      {
        index: true,
        element: <ReviewerLayout />,
      },
    ],
  },
  {
    path: '*',
    element: <NotFound />,
  },
]);

export default router;
