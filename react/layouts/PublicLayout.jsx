import { Outlet } from 'react-router-dom';
import { useStateContext } from '../contexts/ContextProvider';

export default function PublicLayout() {

  return (
    <>
      <h1>Public Layout</h1>
      <Outlet />
    </>
  );
}