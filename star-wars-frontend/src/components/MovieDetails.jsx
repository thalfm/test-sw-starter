import "./MovieDetails.css";

export default function MovieDetails({ movie, onBack, onSelectCharacter }) {
  if (!movie) return null;

  return (
    <div className="details-wrapper">
      <div className="box movie-details-box">

        {/* TÍTULO DO FILME (À DIREITA) */}
        <h1 className="movie-title">{movie.name}</h1>

        {/* GRID: OPENING CRAWL | CHARACTERS */}
        <div className="movie-grid">

          {/* OPENING CRAWL (esquerda) */}
          <div className="movie-section">
            <h2 className="section-title">Opening Crawl</h2>
            <div className="section-divider"></div>
            <p className="opening-crawl">{movie.opening_crawl}</p>
          </div>

          {/* CHARACTERS (direita) */}
          <div className="movie-section">
            <h2 className="section-title">Characters</h2>
            <div className="section-divider"></div>

            <p className="character-list">
              {movie.characters.map((char, index) => (
                <span key={char.id}>
                  <a
                    href="#"
                    className="movie-char-link"
                    onClick={(e) => {
                      e.preventDefault();
                      onSelectCharacter(char.id); // carrega o personagem
                    }}
                  >
                    {char.name}
                  </a>

                  {/* adicionar vírgula exceto no último */}
                  {index < movie.characters.length - 1 && ", "}
                </span>
              ))}
            </p>
          </div>

        </div>

        {/* BOTÃO VOLTAR */}
        <button className="btn-back" onClick={onBack}>
          BACK TO SEARCH
        </button>

      </div>
    </div>
  );
}
