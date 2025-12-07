import React from 'react';
import './SWStarter.css';

export default function SWStarter({ size = 36, children = 'SW', onClick = () => {} }) {
  const style = { width: size, height: size, fontSize: Math.round(size / 2.5) };

  return (
    <div className="sw-starter" style={style} onClick={onClick} role="img" aria-label="Star Wars logo">
      {children}
    </div>
  );
}
