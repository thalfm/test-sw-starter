import "./App.css";
import { useState, useEffect } from "react";
import Header from "./components/Header";
import LeftBox from "./components/LeftBox";
import RightBox from "./components/RightBox";
import CharacterDetails from "./components/CharacterDetails";
import MovieDetails from "./components/MovieDetails";
import { fetchMovie } from "./services/api";
import { fetchPeople } from "./services/api";

export default function App() {
  const [page, setPage] = useState("search");
  const [loading, setLoading] = useState(false);
  const [results, setResults] = useState([]);
  const [character, setCharacter] = useState(null);
  const [movie, setMovie] = useState(null);

  useEffect(() => {
    console.log("PAGE LOADED or RELOADED");
  }, []);

  const handleSearch = async (option, text) => {
    setLoading(true);

    if (option === "people") {
      const response = await fetchPeople(text);
      setResults(response.data || []);
    }

    setLoading(false);
  };

  const handleSelectCharacter = (charData) => {
    setCharacter(charData.data);
    setPage("details");
  };

  const handleSelectMovie = async (movieId) => {
    const movies = await fetchMovie(movieId);
    setMovie(movies.data);
    setPage("movie-details");
  };

  const handleBack = () => {
    setPage("search");
    setCharacter(null);
  };

  return (
    <>
      <Header title="SW Starter" />

      <main className="content">
        {page === "search" && (
          <>
            <LeftBox onSearch={handleSearch} />
            <RightBox 
              loading={loading}
              results={results}
              onSelectCharacter={handleSelectCharacter}
            />
          </>
        )}

        {page === "details" && (
          <CharacterDetails 
            character={character} 
            onBack={handleBack}
            onSelectMovie={handleSelectMovie}
          />
        )}

        {page === "movie-details" && (
          <MovieDetails
            movie={movie}
            onBack={handleBack}
            onSelectCharacter={handleSelectCharacter}
          />
        )}
      </main>
    </>
  );
}
