import { useState, useEffect } from "react";
import useFetchData from "./Hooks/useFetchData";

const useCan = (permission) => {
  // State variables for 'can' and other fetching states
  const [can, setCan] = useState(false);
  const { data, error } = useFetchData();

  useEffect(() => {
    if (data != null) {
      if (data[0].includes(permission)) {
        setCan(true);
      }
    }
  }, [data]);

  return can;
};

export default useCan;
