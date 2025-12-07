const API_URL = "http://localhost:8000/api";

export async function fetchPeople(searchTerm) {
  const url = `${API_URL}/people?name=${encodeURIComponent(searchTerm)}`;

  const response = await fetch(url);

  if (!response.ok) {
    throw new Error("Erro ao buscar people");
  }

  return await response.json();
}

export async function fetchCharacterById(id) {
  const url = `${API_URL}/people/${id}`;
  const response = await fetch(url);

  if (!response.ok) {
    throw new Error("Erro ao buscar people");
  }

  return response.json();
}

export async function fetchMovie(movieId) {
  const url = `${API_URL}/films/${movieId}`;
  const response = await fetch(url);

   if (!response.ok) {
    throw new Error("Erro ao buscar people");
  }

  return response.json();
}
