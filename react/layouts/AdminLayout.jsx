import { Outlet } from "react-router-dom";

export default function AdminLayout() {
  return (
    <>
      <h1>AdminLayout</h1>
      <Outlet />
    </>
  );
}