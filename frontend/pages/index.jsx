import React, { useEffect, useState } from "react";
import useCan from "../src/Hooks/useCan";

export default function Index() {
  const [backendUrl, setBackendUrl] = useState("");

  useEffect(() => {
    // async function fetchData() {
    // const url = await useCan("user", "user create");
    // setBackendUrl(url);
    // console.log(backendUrl);
    // }
    // fetchData();
    console.log(
      useCan("user", "user create")
        .then((e) => {
          console.log(e);
        })
        .catch((e) => {
          console.log(e);
        })
    );
  }, []);

  return (
    <div>
      <h1>{backendUrl}</h1>
    </div>
  );
}
