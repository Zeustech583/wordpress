import React, { useState, useEffect } from "react";
import Graph from "./component/graph";

const App = () => {
  const [range, setRange] = useState(7);
  const [data, setData] = useState([]);

  useEffect(() => {
    const getRange = async () => {
      const ranges = await fetch(
        `${window.location.origin}/wordpress/wp-json/api/v1/rankmath`,
        {
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
          },
          method: "POST",
          body: JSON.stringify({ range: range }),
        }
      );

      try {
        const res = await ranges.json();
        console.log("res", res);
        const graph = res.map((item) => ({
          name: item.time,
          price: item.price,
        }));
        setData(graph);
      } catch (error) {
        console.error(error);
      }
    };
    getRange();
  }, [range]);

  return (
    <div>
      <div className="container-widget">
        <div>
          <h4 className="app-title">Graph Widget</h4>
        </div>
        <div>
          <select
            onChange={(e) => {
              setRange(e.target.value);
            }}
          >
            <option value={7}>7 days</option>
            <option value={15}>15 days</option>
            <option value={30}>1 month</option>
          </select>
        </div>
      </div>

      <hr />
      <Graph data={data} />
    </div>
  );
};

export default App;
