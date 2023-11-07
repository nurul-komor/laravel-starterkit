import React from "react";
import fetchPermissions from "../Hooks/fetchPermissions";
export default function useCan() {
  const [can, setCan] = React.useState(false);
  const permissions = fetchPermissions();
  console.log(permissions);
}
