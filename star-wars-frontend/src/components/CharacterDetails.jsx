import "./CharacterDetails.css";

export default function CharacterDetails({ character, onBack, onSelectMovie }) {
  if (!character) return null;

  const {
    name = "Unknown",
    birth_year = "Unknown",
    gender = "Unknown",
    height = "Unknown",
    mass = "Unknown",
    movies = []
  } = character;

  return (
    <div className="details-wrapper">

      <div className="box details-box">

        <h1 className="character-name">{name}</h1>

        <div className="details-grid">

          <div className="details-section">
            <h2 className="section-title">Details</h2>
            <div className="section-divider"></div>

            <div className="info-list">
              <p><strong>Birth Year:</strong> {birth_year}</p>
              <p><strong>Gender:</strong> {gender}</p>
              <p><strong>Height:</strong> {height}</p>
              <p><strong>Mass:</strong> {mass}</p>
            </div>
          </div>

          <div className="details-section">
            <h2 className="section-title">Movies</h2>
            <div className="section-divider"></div>

            {movies.length === 0 ? (
              <p>No movies found.</p>
            ) : (
              <ul className="movie-list">
                {movies.map((movie, index) => (
                  <li key={index}>
                    <a
                        href="#"
                        className="movie-link"
                        onClick={(e) => {
                            e.preventDefault();
                            onSelectMovie(movie.id);  
                        }}>
                        {movie.name}
                    </a>    
                  </li>
                ))}
              </ul>
            )}
          </div>

        </div>

        <button className="btn-back" onClick={onBack}>
          BACK TO SEARCH
        </button>

      </div>
    </div>
  );
}
