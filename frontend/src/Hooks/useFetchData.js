import { useState, useEffect } from "react";
const backendApiUrl = process.env.NEXT_PUBLIC_BACKEND_API;

const useFetchData = () => {
  // State variables to manage data fetching
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // Getting token and guard from local storage
  const token =
    typeof window !== "undefined" ? localStorage.getItem("access_token") : "";
  const guard =
    typeof window !== "undefined" ? localStorage.getItem("guard") : "";

  // Setting custom headers for the API request
  const customHeaders = {
    Authorization: `Bearer ${token}`,
    Accept: "application/json",
  };

  useEffect(() => {
    // fetching data
    const fetchData = async () => {
      await fetch(`${backendApiUrl}/hasPermissions?guard=${guard}`, {
        method: "GET",
        headers: customHeaders,
      })
        .then((response) => {
          return response.json(); // Parse the response JSON
        })
        .then((data) => {
          // console.log(data);
          setData(data.permissions);
        })
        .catch((error) => {
          setData(error);
        });
    };
    fetchData();
  }, [backendApiUrl]);
  return { data, error };
};

export default useFetchData;
