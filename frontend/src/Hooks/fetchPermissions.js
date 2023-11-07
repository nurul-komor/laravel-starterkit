import React, { useState } from "react";
const backendApiUrl = process.env.NEXT_PUBLIC_BACKEND_API;

const fetchPermissions = async () => {
  const token =
    typeof window !== "undefined" ? localStorage.getItem("access_token") : "";
  const guard =
    typeof window !== "undefined" ? localStorage.getItem("guard") : "";
  const customHeaders = {
    Authorization: `Bearer ${token}`,
    Accept: "application/json",
  };
  await fetch(`${backendApiUrl}/checkPermission?guard=${guard}`, {
    method: "GET",
    headers: customHeaders,
  })
    .then((response) => {
      return response.json(); // Parse the response JSON
    })
    .then((data) => {
      // Handle the data from the API
      // console.log(data);
      // console.log(data);
      return data.json();
    })
    .catch((error) => {
      return error;
    });
};

export default fetchPermissions;
