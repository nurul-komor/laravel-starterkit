import React, { useEffect, useState } from "react";
import useCan from "../src/useCan";

export default function Index() {
  const [backendUrl, setBackendUrl] = useState("");
  // console.log(useCan("user view"));
  return (
    <div>
      {useCan("user view") ? (
        <h1>You have permission</h1>
      ) : (
        "You don't have permission"
      )}
      {useCan("user view") ? (
        <h1>You have permission</h1>
      ) : (
        "You don't have permission"
      )}
    </div>
  );
}
