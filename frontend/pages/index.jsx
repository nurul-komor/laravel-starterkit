import React, { useEffect, useState } from "react";
import useCan from "../src/Hooks/useCan";

export default function Index() {
  const [backendUrl, setBackendUrl] = useState("");

  return (
    <div>
      {typeof useCan("user view") != "undefined" ? (
        <h1>You have permission</h1>
      ) : (
        "You don't have permission"
      )}
    </div>
  );
}
