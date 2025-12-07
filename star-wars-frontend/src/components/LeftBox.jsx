import SearchForm from "./SearchForm";
import "./LeftBox.css";

export default function LeftBox({ onSearch }) {
  return (
    <div className="box left-box">
      <SearchForm onSearch={onSearch} />
    </div>
  );
}
