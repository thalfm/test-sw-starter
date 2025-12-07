import React from 'react';
import './MatchesBG.css';
import Results from './Results';

const items = [{ id: 1, title: 'Luke Skywalker', subtitle: 'Person' }];


export default function MatchesBG({
  children,
  background = 'var(--matches-bg, #f7f7f7)',
  padding = 12,
  radius = 4,
  className = '',
}) {
  const style = {
    background,
    padding: typeof padding === 'number' ? `${padding}px` : padding,
    borderRadius: typeof radius === 'number' ? `${radius}px` : radius,
  };

  return (
    <div className={`matches-bg ${className}`} style={style}>
      <Results items={items} onSelect={(item) => console.log(item)} />
    </div>
  );
}
