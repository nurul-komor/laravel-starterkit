import React, { useState } from "react";
const backendApiUrl = process.env.NEXT_PUBLIC_BACKEND_API;

const useCan = async (guard, permission) => {
  const token =
    typeof window !== "undefined" ? localStorage.getItem("access_token") : "";
  const customHeaders = {
    Authorization: `Bearer ${token}`,
    Accept: "application/json",
  };
  await fetch(
    `${backendApiUrl}/checkPermission?guard=${guard}&permission=${permission}`,
    {
      method: "GET",
      headers: customHeaders,
    }
  )
    .then((response) => {
      return response.json(); // Parse the response JSON
      // console.log(response);
    })
    .then((data) => {
      // Handle the data from the API
      // console.log(data);
      return data.json();
    })
    .catch((error) => {
      return error;
    });
};

export default useCan;
