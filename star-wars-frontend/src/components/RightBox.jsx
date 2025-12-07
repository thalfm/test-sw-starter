import ResultContent from "./ResultContent";
import "./RightBox.css";

export default function RightBox({ loading, results, onSelectCharacter }) {
  return (
    <div className="box right-box">
      <h2 className="results-title">Results</h2>
      <div className="results-divider"></div>

      <ResultContent 
        loading={loading} 
        onSelectCharacter={onSelectCharacter}
        results={results} />
    </div>
  );
}
