import { useState } from "react";
import "./SearchForm.css";

export default function SearchForm({ onSearch }) {
  const [option, setOption] = useState("");
  const [text, setText] = useState("");
  const [loading, setLoading] = useState(false);

  const isButtonActive = option !== "" && text.length > 1;

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!isButtonActive) return;

    setLoading(true);

    await onSearch(option, text);   // <-- App vai rodar fetchPeople(text)

    setLoading(false);
  };

  return (
    <form className="form" onSubmit={handleSubmit}>
      <div className="radio-row">
        <label className="radio-label">
          <input
            type="radio"
            name="searchType"
            value="people"
            checked={option === "people"}
            onChange={(e) => setOption(e.target.value)}
            className="radio"
          />
          People
        </label>

        <label className="radio-label">
          <input
            type="radio"
            name="searchType"
            value="movies"
            checked={option === "movies"}
            onChange={(e) => setOption(e.target.value)}
            className="radio"
          />
          Movies
        </label>
      </div>

      <input
        type="text"
        placeholder="e.g. Luke Skywalker"
        value={text}
        onChange={(e) => setText(e.target.value)}
        className="text-input"
      />

      <button
        type="submit"
        disabled={!isButtonActive || loading}
        className={`btn-search ${isButtonActive ? "active" : ""}`}
      >
        {loading ? "SEARCHING..." : "SEARCH"}
      </button>
    </form>
  );
}
