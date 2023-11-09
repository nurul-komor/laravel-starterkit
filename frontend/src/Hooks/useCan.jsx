import { useState, useEffect } from "react";
import useFetchData from "./useFetchData";

const useCan = (permission) => {
  // State variables for 'can' and other fetching states
  const [can, setCan] = useState(null);
  const { data, error } = useFetchData();

  useEffect(() => {
    if (data != null) {
      if (data[0].includes(permission)) {
        setCan(true);
      } else {
        setCan(false);
      }
    }
  }, [data]);
  if (can != null) {
    return can;
  }
};

export default useCan;
