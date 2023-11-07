import React, { useEffect, useState } from "react";
import useCan from "../src/Hooks/useCan";

export default function Index() {
  const [backendUrl, setBackendUrl] = useState("");

  useEffect(() => {
    useCan();
  }, []);

  return (
    <div>
      <h1>{backendUrl}</h1>
    </div>
  );
}
