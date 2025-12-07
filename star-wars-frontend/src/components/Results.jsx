import React from 'react';
import './Results.css';

export default function Results({
  items = [],
  onSelect = () => {},
  renderItem,
  emptyMessage = 'No matches found',
}) {
  if (!items || items.length === 0) {
    return <div className="results-empty">{emptyMessage}</div>;
  }

  return (
    <div className="results" role="list">
      {items.map((item, idx) => {
        const key = item?.id ?? item?.url ?? idx;
        const content = renderItem ? (
          renderItem(item)
        ) : (
          <>
            <div className="result-title">{item?.title ?? item?.name ?? 'Untitled'}</div>
            {item?.subtitle || item?.description ? (
              <div className="result-sub">{item.subtitle || item.description}</div>
            ) : null}
          </>
        );

        return (
          <button
            key={key}
            type="button"
            className="result-item"
            onClick={() => onSelect(item)}
            role="listitem"
          >
            {content}
          </button>
        );
      })}
    </div>
  );
}
