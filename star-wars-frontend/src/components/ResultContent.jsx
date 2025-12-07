import "./ResultContent.css";
import { fetchCharacterById } from "../services/api";

export default function ResultContent({ loading, results, onSelectCharacter }) {
  const hasResults = results && results.length > 0;

  if (!loading && !hasResults) {
    return (
      <div className="result-content empty">
        <p>There are zero matches.</p>
        <p>Use the form to search for People or Movies.</p>
      </div>
    );
  }

  if (loading) {
    return (
      <div className="result-content loading">
        Searching...
      </div>
    );
  }

  return (
    <div className="result-content list">
      {results.map((item, index) => (
        <div key={index} className="result-item">
          <div className="result-row">
            <span className="result-name">{item.name}</span>
            <button
              type="button"
              className="btn-details"
              onClick={async () => {
                const details = await fetchCharacterById(item.id);
                onSelectCharacter(details);
              }}
            >
              See Details
            </button>
          </div>
          <div className="result-divider"></div>
        </div>
      ))}
    </div>
  );
}
